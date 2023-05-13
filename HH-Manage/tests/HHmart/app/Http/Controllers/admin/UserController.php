<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function list(Request $req){

        $act = [
            'delete'=>'Xóa tạm thời'
        ];
        if($req->input('status')=='trash'){
            $act = [
                'forceDelete'=>'Xóa vĩnh viễn',
                'restore'=>'khôi phục'
            ];
            $user = User::onlyTrashed()->paginate(6);
        }else{
            $key = '';
            if($req->input('key')){
                $key = $req->input('key') ;
            }
            $user = User::where('name','LIKE',"%{$key}%")->paginate(6);
        }
            $count_active = User::count();
            $count_trash = User::onlyTrashed()->count();

        return view('admin.pages.user.list',compact('user','count_active','count_trash','act'));
    }
    public function add(Request $req){
        return view('admin.pages.user.add');
    }
    // |
    public function store(Request $req){
        $req->validate(
            [
                'name'=>'required|string|max:100',
                'email'=>'required|string|email|max:100|unique:users',
                'password'=> 'required|string|min:8'
            ],
            [
                'required'=>':attribute không được để trống',
                'min'=>'Độ dài không hợp lệ',
                'max'=>'Độ dài không hợp lệ',
                'email'=>'Email không đúng định dạng',
            ],
            [
                'name'=>'Tên',
                'email'=>'Địa chỉ email',
                'password'=>'Mật khẩu',
            ]
        );
        // dd($req->input());
        User::create([
                'name'=>$req->input('name'),
                'email'=>$req->input('email'),
                'password'=> Hash::make( $req->input('password')),   
        ]);

        return redirect()->route('user.list')->with('flash','Thêm thành công');

    }

    public function delete(Request $req, $id){
        if(Auth::id()!= $id){
            $user = User::find($id);
            $user->delete();

            return redirect()->route('user.list')->with('flash','Xóa thành công');
        }else{
            return redirect()->route('user.list')->with('flash','Bạn không thể xóa chính mình');
        }
    }

    public function action(Request $req){
        $list_check = $req->input('list_check');
        // dd($list_check);
        foreach($list_check as $k=>$v){
            if(Auth::id()==$v){
                unset($list_check[$k]);
            }
        }

        if(!empty($list_check)){
            $act = $req->input('act');
            if($act == 'delete'){
                User::destroy($list_check);
                return redirect()->route('user.list')->with('flash','Xóa thành công');
            }

            if($act == 'restore'){
                User::withTrashed()
                ->whereIn('id',$list_check)
                ->restore();
                return redirect()->route('user.list')->with('flash','Khôi phục thành công');
            }

            if($act == 'forceDelete'){
                User::withTrashed()
                ->whereIn('id',$list_check)
                ->forceDelete();
                return redirect()->route('user.list')->with('flash','Xóa vĩnh viễn thành công');
            }
            return redirect()->route('user.list')->with('flash','Bạn không thể xóa chính bạn');
        }else{
            return redirect()->route('user.list')->with('flash','Bạn cần chọn mục thể thực hiện hành động');
        }
    }

    public function edit(Request $req,$id){
        $user = User::find($id);

        return view('admin.pages.user.edit',compact('user'));
    }

    public function update(Request $req,$id){
        $req->validate(
            [
                'name'=>'required|string|max:100',
                'password'=> 'required|string|min:8'
            ],
            [
                'required'=>':attribute không được để trống',
                'min'=>'Độ dài không hợp lệ',
                'max'=>'Độ dài không hợp lệ',
            ],
            [
                'name'=>'Tên',
                'password'=>'Mật khẩu',
            ]
        );

        User::where('id',$id)->update([
            'name'=>$req->input('name'),
            'password'=> Hash::make($req->input('password')), 
        ]);
        return redirect()->route('user.list')->with('flash','Cập nhật thành công');
    }
}
