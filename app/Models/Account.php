<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Override;

class Account extends Model
{
    /** @use HasFactory<\Database\Factories\AccountFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'icon',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    // Clear the cache when the data changes
    #[Override]
    protected static function booted()
    {
        static::saved(fn() => Cache::forget('social-links'));
        static::deleted(fn() => Cache::forget('social-links'));
    }
}
