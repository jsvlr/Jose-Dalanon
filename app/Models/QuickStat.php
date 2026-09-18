<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickStat extends Model
{
    /** @use HasFactory<\Database\Factories\QuickStatFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'in_used',
    ];

    protected $casts = [
        'in_used' => 'boolean'
    ];
}
