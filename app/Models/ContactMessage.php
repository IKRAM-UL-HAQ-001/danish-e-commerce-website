<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'is_read',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($message) {
            if (empty($message->slug)) {
                $message->slug = 'msg-' . uniqid();
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
