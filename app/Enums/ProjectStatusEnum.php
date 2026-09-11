<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;
use Override;

enum ProjectStatusEnum: string implements HasLabel
{
    case IDEA = 'Idea';
    case PLANNED = 'Planned';
    case INPROGRESS = 'InProgress';
    case ONHOLD = 'OnHold';
    case COMPLETED = 'Completed';
    case CANCELLED = 'Cancelled';
    case ARCHIVE = 'Archive';


    public function getDefault(): ?string
    {
        return self::COMPLETED->value;
    }

    #[Override]
    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::IDEA => 'Idea',
            self::PLANNED => 'Planned',
            self::INPROGRESS => 'In Progress',
            self::ONHOLD => 'On Hold',
            self::COMPLETED => 'Completed',
            self::CANCELLED => 'Cancelled',
            self::ARCHIVE => 'Archive'
        };
    }
}
