<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
