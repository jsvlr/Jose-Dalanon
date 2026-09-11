<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Override;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'role_id',
        'excerpt',
        'body',
        'status',
        'url',
        'is_published',
        'start_date',
        'end_date',
        'github_url',
        'live_url',
        'featured_image',
        'project_logo'
    ];

    protected $casts = [
        'status' => \App\Enums\ProjectStatusEnum::class,
        'is_published' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'project_skills');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    #[Override]
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
