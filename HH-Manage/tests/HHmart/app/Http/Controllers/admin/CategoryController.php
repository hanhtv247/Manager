<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function list_cat(){
        $cate = Category::paginate(6);

        return view('admin.pages.product.listCate',compact('cate'));
    }

    public function store_cat(Request $req){
        $req->validate(
            [
                'name' => 'required|string',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => 'Độ dài không hợp lệ',
            ],
            [
                'name' => 'Tên',
                'status' => 'Trạng thái',
            ]
        );

        Category::create([
            'name'=>$req->input('name'),
            'status'=>$req->input('status'),
        ]);
        
        return redirect()->route('category.list')->with('flash','Thêm thành công');
    }

    public function edit_cat($id){
        $cate = Category::find($id);

        return view('admin.pages.product.editCate',compact('cate'));
    }

    public function update_cat(Request $req,$id){
        $req->validate(
            [
                'name' => 'required|string',
                'status' => 'required'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => 'Độ dài không hợp lệ',
            ],
            [
                'name' => 'Tên',
                'status' => 'Trạng thái',
            ]
        );

        Category::where('id',$id)
        ->update([
            'name'=>$req->input('name'),
            'status'=>$req->input('status'),
        ]);


        return redirect()->route('category.list')->with('flash','Cập nhật thành công');

    }

    public function delete_cat($id){

        Category::find($id)
        ->delete();
        return redirect()->route('category.list')->with('flash','Xóa thành công');

    }
}
