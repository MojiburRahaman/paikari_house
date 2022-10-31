<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
