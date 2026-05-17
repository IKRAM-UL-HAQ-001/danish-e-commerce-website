<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'title',
        'product_id',
        'image',
        'description',
        'price',
        'old_price',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
