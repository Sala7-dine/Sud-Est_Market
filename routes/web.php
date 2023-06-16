<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\Frontend\IndexController;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Fronten ---- 

// ahuthentication 

Route::get('user/auth' , [\App\Http\Controllers\Frontend\IndexController::class , "userAuth"])->name("user.auth");
Route::post('user/login', [\App\Http\Controllers\Frontend\IndexController::class , "loginSubmit"])->name("login.submit");
Route::post('user/register', [\App\Http\Controllers\Frontend\IndexController::class , "registerSubmit"])->name("register.submit");
Route::get("user/logout" , [\App\Http\Controllers\Frontend\IndexController::class , "userLogout"])->name("user.logout");

Route::get("/" , [App\Http\Controllers\Frontend\IndexController::class , "home"])->name("home"); 

// Product Category 

Route::get("product-cat/{slug}",[App\Http\Controllers\Frontend\IndexController::class , "productCategory"])->name("product.category");

//  Product Detail 

Route::get("product-detail/{slug}",[App\Http\Controllers\Frontend\IndexController::class , "productDetail"])->name("product.detail");

// Cart Section ------

Route::post("cart/store" , [App\Http\Controllers\Frontend\CartController::class , "cartStore"])->name("cart.store");

// End Frontend ------ 

Auth::routes(["register"=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

// Admin Dashboard ------
Route::group(['prefix'=>'admin' , 'middleware'=>["auth" , "admin"]] ,function(){
    Route::get("/" , [AdminController::class, 'admin'])->name("admin");

    // Banner Section 
    Route::resource("/banner" , App\Http\Controllers\BannerController::class);
    Route::post("banner_status" , [App\Http\Controllers\BannerController::class , "bannerStatus"])->name("banner.status");
 
    // Category Section 
    Route::resource("/category" , App\Http\Controllers\CategoryController::class);
    Route::post("category_status" , [App\Http\Controllers\CategoryController::class , "categoryStatus"])->name("category.status");

    Route::post('category/{id}/child' ,[App\Http\Controllers\CategoryController::class , "getChildByParentId"]);

    // Brand Section 
    Route::resource("/brand" , App\Http\Controllers\BrandController::class);
    Route::post("brand_status" , [App\Http\Controllers\BrandController::class , "brandStatus"])->name("brand.status");

    // Product Section 
    Route::resource("/product" , App\Http\Controllers\ProductController::class);
    Route::post("product_status" , [App\Http\Controllers\ProductController::class , "productStatus"])->name("product.status");

    // User Section 
    Route::resource("/user" , App\Http\Controllers\UserController::class);
    Route::post("user_status" , [App\Http\Controllers\UserController::class , "userStatus"])->name("user.status");

});


Route::group(['prefix'=>'seller' , 'middleware'=>["auth" , "seller"]] ,function(){
    Route::get("/" , [AdminController::class, 'admin'])->name("seller");

});


// User Dashboard 

Route::group(["prefix"=>"user"] , function(){
    Route::get("/dashboard" , [\App\Http\Controllers\Frontend\IndexController::class , "userDashboard"])->name("user.dashboard");
    Route::get("/order" , [\App\Http\Controllers\Frontend\IndexController::class , "userOrder"])->name("user.order");
    Route::get("/address" , [\App\Http\Controllers\Frontend\IndexController::class , "userAddress"])->name("user.address");
    Route::get("/account-detail" , [\App\Http\Controllers\Frontend\IndexController::class , "userAccount"])->name("user.account");


    Route::post("/billing/address/{id}" , [\App\Http\Controllers\Frontend\IndexController::class , 'billingAddress'])->name("billing.address");
    Route::post("/shipping/address/{id}" , [\App\Http\Controllers\Frontend\IndexController::class , 'shippingAddress'])->name("shipping.address");

    Route::post("/update/account/{id}" , [\App\Http\Controllers\Frontend\IndexController::class , 'updateAccount'])->name("update.account");
}); 
