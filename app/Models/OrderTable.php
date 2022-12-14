<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTable extends Model
{
    use HasFactory;
    function Product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    function OrderSummary()
    {
        return $this->belongsTo(OrderSummaries::class, 'Order_Summaries_id');
    }
}
