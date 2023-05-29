<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(["register"=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Admin Dashboard ------
Route::group(['prefix'=>'admin' , 'middleware'=>"auth"] ,function(){
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

});
