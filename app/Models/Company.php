<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    /** @use HasFactory<\Database\Factories\CompanyFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'url',
        'logo',
        'type',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean'
    ];

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class);
    }
}
