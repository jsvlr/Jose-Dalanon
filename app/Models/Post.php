<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        "post_category_id",
        "title",
        "slug",
        "thumbnail",
        "excerpt",
        "content",
        "published_at",
        "status",
        "views",
        "tags",
        "is_featured"
    ];

    #[Override]
    protected function casts()
    {
        return [
            'published_at' => 'date',
            'status'       => \App\Enums\PostStatusEnum::class,
            'tags'         => 'array',
            'is_featured'  => 'bool'
        ];
    }

    // this will used the slug field on url instead of id
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function postCategory(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class);
    }
}
