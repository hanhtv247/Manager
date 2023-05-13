<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Middleware\checkRole;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $key = '';

        if ($req->input('key')) {
            $key = $req->input('key');
        }

        $user = User::where('users.name', 'LIKE', "%{$key}%")
                    ->orderBy('id','desc')
                    ->paginate(3);

        return view('admin.employee.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $req->validate(
            [
                'name' => 'required|string',
                'email' => 'required',
                'password' => 'required',
                'avartar'=>'required',
                'sex' => 'required',
                'address' => 'required',
                'birthday' => 'required',
                'salary' => 'required',
                'position' => 'required',
                'dateJoinCompany' => 'required',
                'role' => 'required',
                
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên nhân viên',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'avartar' => 'Ảnh đại diện',
                'sex' => 'Giới tính',
                'address'=>'Địa chỉ',
                'birthday'=>'Sinh nhật',
                'salary'=>'Lương',
                'position'=>'Vị trí',
                'dateJoinCompany'=>'Ngày vào công ty',
                'role'=>'Quyền truy cập',
            ]
        );

        

        if ($req->has('avartar')) {
            $file = $req->avartar;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);

        User::create([
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'password'=> Hash::make($req->input('password')),
            'avartar'=>$file_name,
            'sex'=>$req->input('sex'),
            'birthday'=>$req->input('birthday'),
            'address'=>$req->input('address'),
            'salary'=>$req->input('salary'),
            'position'=>$req->input('position'),
            'dateJoinCompany'=>$req->input('dateJoinCompany'),
            'role'=>$req->input('role'),
        ]);

        return redirect()->route('employee.index')->with('flash','Thêm mới nhân viên thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.employee.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $req->validate(
            [
                'name' => 'required|string',
                'email' => 'required',
                'password' => 'required',
                'sex' => 'required',
                'address' => 'required',
                'birthday' => 'required',
                'salary' => 'required',
                'position' => 'required',
                'dateJoinCompany' => 'required',
                'role' => 'required',
                
            ],
            [
                'required' => ':attribute không được để trống',
            ],
            [
                'name' => 'Tên nhân viên',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'sex' => 'Giới tính',
                'address'=>'Địa chỉ',
                'birthday'=>'Sinh nhật',
                'salary'=>'Lương',
                'position'=>'Vị trí',
                'dateJoinCompany'=>'Ngày vào công ty',
                'role'=>'Quyền truy cập',
            ]
        );

        $employeeUpdate = User::find($id);

        if ($req->has('avartar')) {

            // Xóa file cũ
            $isExists = File::exists(public_path('files/' . $employeeUpdate->file));

            if ($isExists) {
                File::delete(public_path('files/' . $employeeUpdate->file));
            }

            $file = $req->avartar;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
            $req->merge(['file_name' => $file_name]);
        }

        $fileUpload = $file_name ?? $employeeUpdate->file;

        User::where('id',$id)
            ->update([
            'name'=>$req->input('name'),
            'email'=>$req->input('email'),
            'password'=> $req->input('password'),
            'avartar'=>$fileUpload,
            'sex'=>$req->input('sex'),
            'birthday'=>$req->input('birthday'),
            'address'=>$req->input('address'),
            'salary'=>$req->input('salary'),
            'position'=>$req->input('position'),
            'dateJoinCompany'=>$req->input('dateJoinCompany'),
            'role'=>$req->input('role'),
        ]);

        return redirect()->route('employee.index')->with('flash','Cập nhật nhân viên thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('employee.index')->with('flash','Xóa thành công');
    }
}
