<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    function Gallery()
    {
     return   $this->hasMany(Gallery::class, 'product_id');
    }
    function Cart()
    {
     return   $this->hasMany(Cart::class, 'product_id');
    }
    function Category()
    {
     return   $this->belongsTo(Category::class, 'category_id');
    }
    function Brand()
    {
     return   $this->belongsTo(Brand::class, 'brand_id');
    }
    function Vendor()
    {
     return   $this->belongsTo(Vendor::class, 'vendor_id');
    }
}
