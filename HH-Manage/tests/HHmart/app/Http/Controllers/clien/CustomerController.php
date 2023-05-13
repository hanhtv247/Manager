<?php

namespace App\Http\Controllers\clien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
  
    
    public function register(){
        return view('clien.pages.customer.register');
    }

    public function post_register(Request $req){
        $req->validate(
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'address'=>'required',
                'password' => 'required|min:6',
                'repeat_password' => 'required|same:password',
            ],
            [
                'required' => ':attribute không được để trống',
                'email' => ':attribute không đúng định dạng',
                'same' => ':attribute không trùng khớp',
                'min'=>':attribute phải lớn hơn 6 kí tự',
            ],
            [
                'name' => 'Tên',
                'email' => 'Email',
                'address' => 'Địa chỉ',
                'password' => 'Mật khẩu',
                'repeat_password' => 'Nhập lại mật khẩu',
            ]
        );
        Customer::create([
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'address'=>$req->input('address'),
            'password'=> Hash::make($req->input('password')) ,
        ]);

        return redirect()->route('customer.login')->with('flash','Đăng kí tài khoản thành công, xin mời đăng nhập');

    }

    public function login(){
        
        return view('clien.pages.customer.login');
    }

    public function post_login(Request $req){
        $req->validate(
            [
                'email' => 'required|email',

                'password' => 'required|min:6',

            ],
            [
                'required' => ':attribute không được để trống',
                'email' => ':attribute không đúng định dạng',
                'same' => ':attribute không trùng khớp',
                'min'=>':attribute phải lớn hơn 6 kí tự',
            ],
            [
                'email' => 'Email',
                'password' => 'Mật khẩu',
            ]
        );

         Auth::attempt($req->only('email','password'),$req->has('remember'));

        // dd($login);

        
            return redirect()->route('home');
       
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');

    }
}
