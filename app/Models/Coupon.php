<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 
        'type', 
        'value', 
        'min_order_value', 
        'expiry_date', 
        'usage_limit', 
        'used_count', 
        'status'
    ];
}
