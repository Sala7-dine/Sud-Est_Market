<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "title", 
        "slug", 
        "summary", 
        "description", 
        "stock", 
        "brand_id", 
        "photo", 
        "cat_id", 
        "child_cat_id", 
        "brand_id", 
        "price", 
        "offre_price", 
        "discount", 
        "size", 
        "conditions", 
        "status", 
        "vendor_id" 
    ];


    public function brand()
    {
        return $this->belongsTo("\App\Models\Brand");
    }

    public function rel_prods()
    {
        return $this->hasMany("\App\Models\Product" , 'cat_id' , 'cat_id')->where('status' , 'active')->limit(10);
    }
}
