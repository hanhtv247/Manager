<?php

namespace App\Http\Controllers\admin;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function list_color(){
        $color = Color::where('status',1)
        ->paginate(5);
        return view('admin.pages.product.color.index',compact('color'));
    }

    public function store_color(Request $req){
        $req->validate(
            [
                'name' => 'required|string|unique:colors',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => 'Tên này đã tồn tại',
            ],
            [
                'name' => 'Tên',
                'status' => 'Trạng thái',
            ]
        );

        Color::create([
            'name'=>$req->input('name'),
            'status'=>$req->input('status'),
        ]);
        
        return redirect()->route('color.list')->with('flash','Thêm thành công');
    }

    public function edit_color($id){
        $color = Color::find($id);

        return view('admin.pages.product.color.edit',compact('color'));
    }

    public function update_color(Request $req, $id){

        $req->validate([
            [
                'name' => 'required|string|unique:colors',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'unique' => 'Tên này đã tồn tại',
            ],
            [
                'name' => 'Tên',
                'status' => 'Trạng thái',
            ]
        ]);

        Color::where('id',$id)
        ->update([
            'name'=>$req->input('name'),
            'status'=>$req->input('status'),
        ]);
        
        return redirect()->route('color.list')->with('flash','Cập nhật thành công');

    }
    public function delete_color($id){

        Color::find($id)
        ->delete();
        return redirect()->route('color.list')->with('flash','Xóa thành công');

    }
}
