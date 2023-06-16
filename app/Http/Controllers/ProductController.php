<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 


class ProductController extends Controller
{
    /**
     * 
     * Display a listing of the resource.
     * 
     */
    public function index()
    {
        $products = Product::orderBy('id',"desc")->get();
        return view("backend.product.index" , compact("products"));
    }


    public function productStatus(Request $request)
    {
        if($request->mode == "true"){
            DB::table("products")->where("id" , $request->id)->update(["status"=>"active"]);
        }else{
            Db::table("products")->where("id" , $request->id)->update(["status"=>"inactive"]);
        } 
        return response()->json(["msg"=>"status updated succefully" , "status"=>true]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.product.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "title" => 'string|required',
            "summary" => 'string|required',
            "description" => 'string|nullable',
            "stock" => 'nullable|numeric',
            "price" => 'nullable|numeric',
            "discount" => 'nullable|numeric',
            "photo" => 'required',
            "cat_id" => 'required|exists:categories,id',
            "child_cat_id" => 'nullable|exists:categories,id',
            "size" => "nullable",
            "conditions" => "nullable",
            "status" => "nullable|in:active,inactive",
        ]);

        $data = $request->all();
        $slug =Str::slug($request->input('title'));
        $slug_count = Product::where("slug" ,$slug)->count();
        if($slug_count>0)
        {
            $slug = time().'-'.$slug; 
        }
        $data['slug'] = $slug ;

        $data["offre_price"] = ($request->price - (( $request->price * $request->discount) / 100));

        $status = Product::create($data); 
        if($status)
        {
            return redirect()->route('product.index')->with("success" ,"product created succefully!");
        }else
        {
            return back()->with('error' , "there is an error ...!");
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if($product){
            return view("backend.product.view" , compact(["product"]));
        }else{
            return back()->with("error" , "data not found");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        if($product){
            return view("backend.product.edit" , compact("product"));
        }else{
            return back()->with("error" , "data not found");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if($product){
            $this->validate($request, [
                "title" => 'string|required',
                "summary" => 'string|required',
                "description" => 'string|nullable',
                "stock" => 'nullable|numeric',
                "price" => 'nullable|numeric',
                "discount" => 'nullable|numeric',
                "photo" => 'required',
                "cat_id" => 'required|exists:categories,id',
                "child_cat_id" => 'nullable|exists:categories,id',
                "size" => "nullable",
                "conditions" => "nullable",
                "status" => "nullable|in:active,inactive",
            ]);
    
            $data = $request->all();
            
            
            $data["offre_price"] = ($request->price - (( $request->price * $request->discount) / 100));

    
            $status = $product->fill($data)->save(); 
            if($status)
            {
                return redirect()->route('product.index')->with("success" ,"Product updated succefully!");
            }else
            {
                return back()->with('error' , "there is an error ...!");
            }
        }else{
            return back()->with('error' , "Product not found ! ");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if($product){
            $product->delete();
            return redirect()->route("product.index")->with("success" ,"Product deleted succefully!");
        }else{
            return back()->with("error" , "Data Not Found !!");
        }
    }
}
