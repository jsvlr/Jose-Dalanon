<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificate extends Model
{
    /** @use HasFactory<\Database\Factories\CertificateFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'company_id',
        'issue_date',
        'expiry_date',
        'credential_id',
        'credential_url',
        'image',
        'is_featured',
        'sort_order'
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
        'is_featured' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
