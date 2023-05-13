<?php

namespace App\Http\Controllers\clien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Slide;
use App\Post;
use App\Product;
use App\Category;

class HomeController extends Controller
{
    public function home(){
        $slide = Slide::where('status',1)
        ->get();

        $cate = Category::where('status','1')
        ->get();

        $pro = Product::where('status','1')
        ->get();

        $new_pro = Product::where('status','1')
        ->orderby('created_at','desc')
        ->limit(5)
        ->get();

        return view('clien.pages.home.home',compact('slide','cate','pro','new_pro'));
    }
}
