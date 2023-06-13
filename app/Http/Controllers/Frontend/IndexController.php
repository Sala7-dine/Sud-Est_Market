<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function home(){
        $banners = Banner::where(["status" => "active" , "condition"=> "banner"])->orderBy("id" , "DESC")->limit("5")->get() ;
        $categories  = Category::where(["status" => "active" , "is_parent"=>1])->limit(4)->orderBy("id","DESC")->get();

        return view("frontend.index" , compact(['banners' , 'categories'])); 
    }

    public function productCategory($slug)
    {
        $categories = Category::with('products')->where("slug" , $slug)->first();
        return view("frontend.pages.product-category" , compact("categories")); 
    }


    public function productDetail($slug)
    {
        $product = Product::with('rel_prods')->where('slug' , $slug)->first();
        if($product)
        {
            return view("frontend.pages.product-detail" , compact("product"));
        }else{
            return "Product Detail Not Found" ; 
        }
    }
    

    public function userAuth()
    {
        return view('frontend.auth.auth');
    }
}
