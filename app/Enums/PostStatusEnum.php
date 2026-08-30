<?php

namespace App\Enums;

use BackedEnum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Override;

enum PostStatusEnum: string implements HasLabel, HasIcon, HasColor
{
    case PUBLISHED = "Published";
    case DRAFT     = "Draft";
    case ARCHIVE   = "Archive";

    public function default(): string
    {
        return self::DRAFT->value;
    }

    #[Override]
    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::PUBLISHED  => 'Published',
            self::DRAFT      => 'Draft',
            self::ARCHIVE    => 'Archive'
        };
    }

    #[Override]
    public function getIcon(): string|BackedEnum|Htmlable|null
    {
        return match ($this) {
            self::PUBLISHED   => 'heroicon-o-check-circle',
            self::DRAFT       => 'heroicon-o-pencil-square',
            self::ARCHIVE     => 'heroicon-o-archive-box'
        };
    }

    #[Override]
    public function getColor(): string|array|null
    {
        return match ($this) {
            self::PUBLISHED => 'success',
            self::DRAFT     => 'gray',
            self::ARCHIVE   => 'danger'
        };
    }
}
