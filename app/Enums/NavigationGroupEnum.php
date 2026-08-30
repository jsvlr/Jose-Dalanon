<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;
use Override;

enum NavigationGroupEnum: string implements HasLabel
{
    case BLOG = "Blog";

    #[Override]
    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::BLOG => "Blog"
        };
    }
}
