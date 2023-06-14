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
        $categories  = Category::where(["status" => "active" , "is_parent"=>1])->limit(3)->orderBy("id","DESC")->get();

        return view("frontend.index" , compact(['banners' , 'categories'])); 
    }

    public function productCategory(Request $request , $slug)
    {
        $categories = Category::with('products')->where("slug" , $slug)->first();
        $sort = "" ; 

        if($request->sort !=null){
            $sort = $request->sort; 
        }

        if($categories == null){
            return view('errors.404');
        } else {
            if($sort == 'priceAsc'){
                $products =  Product::where(["status"=>"active" , "cat_id"=>$categories->id])->orderBy("offre_price" , "ASC")->paginate(12); 
            }
            elseif($sort == 'priceDesc'){
                $products =  Product::where(["status"=>"active" , "cat_id"=>$categories->id])->orderBy("offre_price" , "DESC")->paginate(12); 
            }
            elseif($sort == 'disceDesc'){
                $products =  Product::where(["status"=>"active" , "cat_id"=>$categories->id])->orderBy("price" , "Asc")->paginate(12); 
            }
            elseif($sort == 'disceDesc'){
                $products =  Product::where(["status"=>"active" , "cat_id"=>$categories->id])->orderBy("price" , "DESC")->paginate(12); 
            }
            elseif($sort == 'titleAsc'){
                $products =  Product::where(["status"=>"active" , "cat_id"=>$categories->id])->orderBy("title" , "ASC")->paginate(12); 
            } 
            elseif($sort == 'titleAsc'){
                $products =  Product::where(["status"=>"active" , "cat_id"=>$categories->id])->orderBy("title" , "DESC")->paginate(12); 
            }else{
                $products =  Product::where(["status"=>"active" , "cat_id"=>$categories->id])->paginate(12); 

            }
        }

        $route='product-cat'; 
        if($request->ajax()){
            $view = view('frontend.layouts._single-product' , compact("products"))->render(); 
            return response()->json(["html"=>$view]);
        }
        return view("frontend.pages.product-category" , compact(["categories" , "route" , "products"])); 
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


    public function userDashboard(){
        $user = Auth::user();
        return view('frontend.user.dashboard' , compact("user"));
    }

    public function userOrder(){
        $user = Auth::user();
        return view('frontend.user.order' , compact("user"));
    }

    public function userAddress(){
        $user = Auth::user();
        return view('frontend.user.address' , compact("user"));
    }

    public function userAccount(){
        $user = Auth::user();
        return view('frontend.user.account' , compact("user"));
    }

}
