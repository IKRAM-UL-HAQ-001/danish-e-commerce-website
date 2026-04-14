<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['question', 'slug', 'answer', 'status'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($faq) {
            if (empty($faq->slug)) {
                $faq->slug = \Illuminate\Support\Str::slug($faq->question) . '-' . uniqid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
