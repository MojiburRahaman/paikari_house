<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Vendor extends Authenticatable
{
    use HasFactory;
    protected $table = 'vendors';
    protected $fillable = [
        'shop_name',
        'email',
        'slug',
        'password',
    ];
    protected $hidden = [
        'password',
    ];

    function Product()
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }
    function Cart()
    {
        return $this->hasMany(Cart::class, 'vendor_id');
    }
}
