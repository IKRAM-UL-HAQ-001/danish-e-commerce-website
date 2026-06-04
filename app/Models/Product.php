<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'sku',
        'description',
        'tags',
        'price',
        'old_price',
        'discount',
        'stock',
        'image_mobile',
        'image_desktop',
        'mobile_banner',
        'laptop_banner',
        'color_name',
        'color_hex',
        'category_id',
        'brand_id',
        'status',
    ];

    // virtual accessor — no `image` column; returns best available image
    public function getImageAttribute()
    {
        return $this->image_desktop ?? $this->image_mobile;
    }

    // views/admin that reference ->image_desktop; proxy to image_desktop
    public function getImageLaptopAttribute()
    {
        return $this->image_desktop ?? $this->image_mobile;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 1)->latest();
    }
}
