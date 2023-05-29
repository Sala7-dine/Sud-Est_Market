<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;



class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::orderBy('id',"desc")->get();
        return view("backend.banner.index" , compact("banners"));
    }


    public function bannerStatus(Request $request)
    {
        if($request->mode == "true"){
            Db::table("banners")->where("id" , $request->id)->update(["status"=>"active"]);
        }else{
            Db::table("banners")->where("id" , $request->id)->update(["status"=>"inactive"]);
        } 
        return response()->json(["msg"=>"status updated succefully" , "status"=>true]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        return view("backend.banner.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->validate($request , [
            "title" => "string|required",
            "description" => "string|nullable",
            "photo" => "required",
            "condition" => "nullable|in:banner,promo",
            "status" => "nullable|in:active,inactive"
        ]);

        $data = $request->all();
        $slug =Str::slug($request->input('title'));
        $slug_count = Banner::where("slug" ,$slug)->count();
        if($slug_count>0)
        {
            $slug = time().'-'.$slug; 
        }
        $data['slug'] = $slug ; 

        $status = Banner::create($data); 
        if($status)
        {
            return redirect()->route('banner.index')->with("success" ,"banner created succefully!");
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
        $banner = Banner::find($id);
        if($banner){
            return view("backend.banner.edit" , compact("banner"));
        }else{
            return back()->with("error" , "data not found");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $banner = Banner::find($id);
        if($banner){
           
            $this->validate($request , [
                "title" => "string|required",
                "description" => "string|nullable",
                "photo" => "required",
                "condition" => "nullable|in:banner,promo",
                "status" => "nullable|in:active,inactive"
            ]);
    
            $data = $request->all();

            $status = $banner->fill($data)->save(); 
            if($status)
            {
                return redirect()->route('banner.index')->with("success" ,"banner updated succefully!");

            }else
            {
                return back()->with('error' , "there is an error ...!");
            }

        }else{
            return back()->with("error" , "data not found");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::find($id)->delete();
        if($banner){
            return redirect()->route("banner.index")->with("success" ,"banner deleted succefully!");
        }else{
            return back()->with("error" , "there is somthing wrong");
        }
    }
}
