<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy('id',"desc")->get();
        return view("backend.user.index" , compact("users"));
    }


    public function userStatus(Request $request)
    {
        if($request->mode == "true"){
            DB::table("users")->where("id" , $request->id)->update(["status"=>"active"]);
        }else{
            Db::table("users")->where("id" , $request->id)->update(["status"=>"inactive"]);
        } 
        return response()->json(["msg"=>"status updated succefully" , "status"=>true]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.user.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            "full_name" => "string|required" , 
            "username" => "string|nullable" , 
            "email" => "email|required|unique:users,email",
            "password"=>"min:4|required",
            "phone" => "string|nullable" , 
            "photo" => "required" , 
            "address" => "string|nullable" , 
            "role" => "required|in:admin,customer,vendor", 
            "status" => "required|in:active,inactive", 
        ]);
        $data = $request->all();

        $data["password"]= Hash::make($request->password);
        $status = User::create($data); 
        if($status)
        {
            return redirect()->route('user.index')->with("success" ,"user created succefully!");
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
        $user = User::find($id);
        if($user){
            return view("backend.user.edit" , compact("user"));
        }else{
            return back()->with("error" , "data not found");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if($user){
            $this->validate($request, [
                "full_name" => "string|required" , 
                "username" => "string|nullable" , 
                "email" => "email|required|exists:users,email",
                "phone" => "string|nullable", 
                "photo" => "required", 
                "address" => "string|nullable" , 
                "role" => "required|in:admin,customer,vendor", 
                "status" => "required|in:active,inactive", 
            ]);
    
            $data = $request->all();
    
            $status = $user->fill($data)->save(); 
            if($status)
            {
                return redirect()->route('user.index')->with("success" ,"user updated succefully!");
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
        $user = User::find($id);
        if($user){
            $user->delete() ; 
            return redirect()->route("user.index")->with("success" ,"user deleted succefully!");
        }else{
            return back()->with("error" , "Data Not Found !!");
        }
    }
}
