<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;

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

    public function loginSubmit(Request $request)
    {
        $this->validate($request,[
            "email" => "email|required|exists:users,email",
            "password" => "required|min:4",
        ]);

        if(Auth::attempt(["email"=>$request->email,"password"=>$request->password , "status"=>"active"])){
            Session::put('user', $request->email);

            if(Session::get('url.intended')){
                return Redirect::to(Session::get('url.intended'));
            }else
            {
                return redirect()->route("home")->with("success","Successfully Login");
            }

        }else{
            return back()->with("error" , "Invalid email or password");
        }
    }


    public function registerSubmit(Request $request)
    {
        $this->validate($request , [
            "username" => "nullable|string",
            "full_name" => "required|string",
            "email" => "required|email|unique:users,email",
            "password" => "min:4|required|confirmed"
        ]);

        $data = $request->all();
        $check=$this->create($data);
        Session::put('user' , $data['email']);
        Auth::login($check);
        if($check){
            return redirect()->route("home")->with("success" , "Successfully registred"); ;
        }else{
            return back()->with("error" , "please check your credintials"); 
        }
    }

    private function create(array $data)
    {
        return User::create([
            "username" => $data["username"],
            "full_name" => $data["full_name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"])
        ]);
    }


    public function userLogout(){
        Session::forget("user");
        Auth::logout();
        return redirect()->route('home')->with('success' , "Successfully logout");
    }

}
