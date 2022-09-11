<?php

namespace App\Models;

use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Division;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;
    function Division()
    {
        return $this->belongsTo(Division::class, 'division_name');
    }
    public function District()
    {
        return $this->belongsTo(District::class, 'district_name');
    }
}
