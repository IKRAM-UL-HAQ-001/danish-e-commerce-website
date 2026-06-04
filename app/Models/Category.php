<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image_desktop', 'image_mobile', 'status', 'parent_id'];

    // virtual accessor — prefers mobile image (sidebar/breadcrumb mobile use)
    public function getImageAttribute()
    {
        return $this->image_mobile ?? $this->image_desktop;
    }

    // views reference ->image_desktop for the desktop category slider
    public function getImageLaptopAttribute()
    {
        return $this->image_desktop ?? $this->image_mobile;
    }

    public function getImageDesktopAttribute(?string $value)
    {
        return $value ?? $this->image_mobile;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get parent category.
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Get sub categories.
     */
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
