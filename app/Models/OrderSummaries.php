<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSummaries extends Model
{
    use HasFactory;

    function Order()
    {
        return $this->hasMany(OrderTable::class, 'Order_Summaries_id');
    }
    function billing_details()
    {
        return $this->belongsTo(BillingDetail::class, 'billing_details_id');
    }
}
