<?php

namespace App\Http\Controllers\clien;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class ProController extends Controller
{
    public function product(){

  

        $pro = Product::where('status','1')
        ->orderBy('id','desc')
        ->paginate(16);

        $cate = Category::where('status',1)
        ->get();

        return view('clien.pages.home.product',compact('pro','cate'));
    }

    public function get_pro_by_id($id){
        
        $pro = Product::where('category_id',$id)
        ->get();
        // dd($pro);
        return redirect()->route('product',compact('pro'));
    }
}
