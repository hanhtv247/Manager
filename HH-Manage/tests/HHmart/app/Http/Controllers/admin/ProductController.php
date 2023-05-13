<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductController extends Controller
{
    public function list_pro(Request $req){
        $act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($req->input('status') == 'trash') {
            $act = [
                'forceDelete' => 'Xóa vĩnh viễn',
                'restore' => 'khôi phục'
            ];
            $pro = Product::join('category', 'category.id', '=', 'product.category_id')
            ->select('product.*', 'category.name as cate')
                ->onlyTrashed()
                ->orderBy('id','desc')
                ->paginate(6);
        } else {
        $key = '';
        if ($req->input('key')) {
            $key = $req->input('key');
        }

        $pro = Product::join('category', 'category.id', '=', 'product.category_id')
            ->select('product.*', 'category.name as cate')
            ->where('product.name', 'LIKE', "%{$key}%")
            ->orderBy('id','desc')
            ->paginate(6);
    }
        $count_active = Product::count();
        $count_trash = Product::onlyTrashed()->count();
        return view('admin.pages.product.listPro',compact('pro','act','count_active','count_trash'));
    }

    public function add_pro(){
        $cate = Category::where('status',1)
        ->get();

        return view('admin.pages.product.addPro',compact('cate'));
    }

    public function store_pro(Request $req){

        $req->validate(
            [
                'name' => 'required|string',
                'price' => 'required',
                'sale_price'=>'lt:price|required',
                'status' => 'required',
                'image'=>'required',
                'category_id' => 'required',
                'description' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'lt' => ':attribute phải bé hơn price',
            ],
            [
                'name' => 'Tên sản phẩm',
                'status' => 'Trạng thái',
                'description' => 'Mô tả',
                'image' => 'Ảnh',
                'cat_id' => 'Danh mục',
                'price'=>'Giá',
                'sale_price'=>'Giá khuyến mại',
            ]
        );

        if ($req->has('image')) {
            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);

        Product::create([
            'name'=>$req->input('name'),
            'price'=>$req->input('price'),
            'sale_price'=>$req->input('sale_price'),
            'image'=>$file_name,
            'status'=>$req->input('status'),
            'category_id'=>$req->input('category_id'),
            'description'=>$req->input('description'),
        ]);

        return redirect()->route('product.list')->with('flash','Thêm sản phẩm thành cônng');

    }

    public function edit_pro($id){
        // dd($id);
        $product = Product::find($id);
        // dd($pro);
        $cate = Category::where('status',1)
        ->get();
        // dd($cate);

        return view('admin.pages.product.editPro',compact('product','cate'));
    }

    public function update_pro(Request $req,$id){
        $req->validate(
            [
                'name' => 'required|string',
                'price' => 'required',
                'sale_price'=>'lt:price|required',
                'status' => 'required',
                'image'=>'required',
                'category_id' => 'required',
                'description' => 'required',
            ],
            [
                'required' => ':attribute không được để trống',
                'lt' => ':attribute phải bé hơn price',
            ],
            [
                'name' => 'Tên sản phẩm',
                'status' => 'Trạng thái',
                'description' => 'Mô tả',
                'image' => 'Ảnh',
                'cat_id' => 'Danh mục',
                'price'=>'Giá',
                'sale_price'=>'Giá khuyến mại',
            ]
        );

        if ($req->has('image')) {
            $file = $req->image;
            $file_name = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $file_name);
        }

        $req->merge(['file_name' => $file_name]);

        Product::where('id',$id)
        ->update([
            'name'=>$req->input('name'),
            'price'=>$req->input('price'),
            'sale_price'=>$req->input('sale_price'),
            'image'=>$file_name,
            'status'=>$req->input('status'),
            'category_id'=>$req->input('category_id'),
            'description'=>$req->input('description'),
        ]);

        return redirect()->route('product.list')->with('flash','Cập nhật thành công');
    }
    public function delete_pro($id)
    {
        Product::find($id)
        ->delete();

        return redirect()->route('product.list')->with('flash', 'Xóa thành công');
    }

    public function action(Request $req)
    {
        $list_check = $req->input('list_check');


        if (!empty($list_check)) {
            $act = $req->input('act');
            if ($act == 'delete') {
                Product::destroy($list_check);
                return redirect()->route('product.list')->with('flash', 'Xóa thành công');
            }

            if ($act == 'restore') {
                Product::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                return redirect()->route('product.list')->with('flash', 'Khôi phục thành công');
            }

            if ($act == 'forceDelete') {
                Product::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                return redirect()->route('product.list')->with('flash', 'Xóa vĩnh viễn thành công');
            }
        } else {
            return redirect()->route('product.list')->with('flash', 'Bạn cần chọn mục thể thực hiện hành động');
        }
    }
}
