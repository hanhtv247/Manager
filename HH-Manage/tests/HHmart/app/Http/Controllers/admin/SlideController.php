<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function list_slide(){
        $slide = Slide::paginate(3);
        return view('admin.pages.slide.list',compact('slide'));
    }

    public function store_slide(Request $req){
        $req->validate(
            [
                'image'=>'required',
                'status'=>'required',
            ],
            [
                'required'=>':attribute không được để rỗng',
            ],
            [
                'image'=> 'Ảnh',
                'status'=> 'Trạng thái'
            ]
            );

            if ($req->has('image')) {
                $file = $req->image;
                $file_name = $file->getClientOriginalName();
                $file->move(public_path('slide'), $file_name);
            }
    
            $req->merge(['file_name' => $file_name]);

            Slide::create([
                'image' => $file_name,
                'status' => $req->input('status'),
            ]);

            return redirect()->route('slide.list')->with('flash','Thêm mới thành công');
    }

    public function edit_slide($id){
        $slide = Slide::find($id);

        return view('admin.pages.slide.edit',compact('slide'));
    }

    public function update_slide(Request $req,$id){
        $req->validate(
            [
                'image'=>'required',
                'status'=>'required',
            ],
            [
                'required'=>':attribute không được để rỗng',
            ],
            [
                'image'=> 'Ảnh',
                'status'=> 'Trạng thái'
            ]
            );

            if ($req->has('image')) {
                $file = $req->image;
                $file_name = $file->getClientOriginalName();
                $file->move(public_path('slide'), $file_name);
            }
    
            $req->merge(['file_name' => $file_name]);

            Slide::where('id',$id)
            ->update([
                'image' => $file_name,
                'status' => $req->input('status'),
            ]);
            return redirect()->route('slide.list')->with('flash','Cập nhật thành công');

    }

    public function delete_slide($id){
        Slide::where('id',$id)
         ->delete();
         return redirect()->route('slide.list')->with('flash','Xóa thành công');

    }

}
