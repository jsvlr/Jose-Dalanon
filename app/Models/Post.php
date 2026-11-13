<?php

namespace App\Models;

use App\Concerns\DeletesFilesModelOnChange;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class Post extends Model implements HasRichContent
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory,
        InteractsWithRichContent,
        DeletesFilesModelOnChange;

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
            'status' => \App\Enums\PostStatusEnum::class,
            'tags' => 'array',
            'is_featured' => 'bool'
        ];
    }

    protected function setUpRichContent(): void
    {
        $this
            ->registerRichContent('content')
            ->toHtml();
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

    protected function getFileDisk(): string
    {
        return 'public';
    }

    protected function getFileFields(): array
    {
        return [
            'thumbnail'
        ];
    }
}
