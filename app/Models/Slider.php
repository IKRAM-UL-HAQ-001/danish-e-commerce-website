<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'image', 'url', 'status'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($slider) {
            if (empty($slider->slug)) {
                $slider->slug = \Illuminate\Support\Str::slug($slider->title) . '-' . uniqid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
