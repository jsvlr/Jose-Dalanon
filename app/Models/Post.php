<?php

namespace App\Models;

use App\Concerns\DeletesFilesModelOnChange;
use App\Enums\PostStatusEnum;
use Awcodes\RicherEditor\Plugins\CodeBlockShikiPlugin;
use Database\Factories\PostFactory;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Override;

class Post extends Model implements HasRichContent
{
    /** @use HasFactory<PostFactory> */
    use DeletesFilesModelOnChange,
        HasFactory,
        InteractsWithRichContent;

    protected $fillable = [
        'post_category_id',
        'title',
        'slug',
        'thumbnail',
        'excerpt',
        'content',
        'published_at',
        'status',
        'views',
        'tags',
        'is_featured',
    ];

    #[Override]
    protected function casts()
    {
        return [
            'published_at' => 'date',
            'status' => PostStatusEnum::class,
            'tags' => 'array',
            'is_featured' => 'bool',
        ];
    }

    protected function content(): Attribute
    {
        return Attribute::make(
            get: static function (?string $value): array|string|null {
                if ($value === null) {
                    return null;
                }

                $document = json_decode($value, true);

                return is_array($document) && ($document['type'] ?? null) === 'doc'
                    ? $document
                    : $value;
            },
            set: static fn (array|string|null $value): ?string => is_array($value)
                ? json_encode($value, JSON_THROW_ON_ERROR)
                : $value,
        );
    }

    protected function setUpRichContent(): void
    {
        $this
            ->registerRichContent('content')
            ->json()
            ->plugins([
                CodeBlockShikiPlugin::make(),
            ])
            ->fileAttachmentsDisk('public');
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
            'thumbnail',
        ];
    }
}
