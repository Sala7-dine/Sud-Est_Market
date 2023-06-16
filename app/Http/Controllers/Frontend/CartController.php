<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartStore(Request $request){
        $product_qty = $request->input("product_qty");
        $product_id = $request->input("product_id");
        $product = Product::getProductByCart($product_id);
        $price = $product[0]["offre_price"];
    }
}
