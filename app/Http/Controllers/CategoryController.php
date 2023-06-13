<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id',"desc")->get();
        return view("backend.category.index" , compact("categories"));
    } 

    public function categoryStatus(Request $request)
    {
        if($request->mode == "true"){
            DB::table("categories")->where("id" , $request->id)->update(["status"=>"active"]);
        }else{
            Db::table("categories")->where("id" , $request->id)->update(["status"=>"inactive"]);
        } 
        return response()->json(["msg"=>"status updated succefully" , "status"=>true]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent_cats = Category::where("is_parent" , 1)->orderBy('title' , "ASC")->get(); 
        return view("backend.category.create" , compact("parent_cats"));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
           
        $this->validate($request , [
            "title" => "string|required",
            "summary" => "string|nullable", 
            "slug" => "string|required|unique:categories,slug",
            "is_parent" => "sometimes|in:1",
            'parent_id'=>'nullable|exists:categories,id',
            "status" => "required|in:active,inactive",
        ]);

        $data = $request->all(); 
        $data['is_parent']=$request->input('is_parent',0);
        $status = Category::create($data); 
        if($status)
        {
            return redirect()->route('category.index')->with("success" ,"category created succefully!");
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        $parent_cats = Category::where("is_parent" , 1)->orderBy('title' , "ASC")->get(); 
        if($category){
            return view("backend.category.edit" , compact(["category","parent_cats"]));
        }else{
            return back()->with("error" , "data not found");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if($category){
            $this->validate($request, [
                "title" => "string|required",
                "summary" => "string|nullable",
                "slug" => "string|required|exists:categories,slug",
                "is_parent" => "sometimes|boolean",
                'parent_id'=>'nullable|exists:categories,id',
                "status" => "required|in:active,inactive",
            ]);
    
            $data = $request->all();
            if($request->is_parent==1)
            {
                $data['parent_id'] = null ;
            }
            
            $data['is_parent'] = $request->input("is_parent" , 0);
    
            $status = $category->fill($data)->save(); 
            if($status)
            {
                return redirect()->route('category.index')->with("success" ,"category updated succefully!");
            }else
            {
                return back()->with('error' , "there is an error ...!");
            }
        }else{
            return back()->with('error' , "Category not found ! ");
        }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $child_cat_id = Category::where("parent_id" , $id)->pluck('id'); 
        if($category){
            $status = $category->delete() ; 
            if($status){
                if(count($child_cat_id)>0){
                    Category::shiftChild($child_cat_id);
                }
                return redirect()->route("category.index")->with("success" ,"category deleted succefully!");
            }else{
            return back()->with("error" , "there is somthing wrong");

            }
        }else{
            return back()->with("error" , "Data Not Found !!");
        }
    }

    public function getChildByParentId(Request $request , $id)
    {
        $category =  Category::find($request->id) ;
        if($category)
        {
            $child_id = Category::getChildByParentId($request->id); 
            if(count($child_id)<=0)
            {
                return response()->json(["status"=>false , 'data'=>null , "msg"=>""]);
            }
            return response()->json(["status"=>true , 'data'=>$child_id , "msg"=>""]);

        }else{
            return response()->json(["status"=>false , 'data'=>null , "msg"=>"Category not found"]);
        }
    }
}
