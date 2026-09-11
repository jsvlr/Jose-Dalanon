<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;
use Override;

enum SkillTypeEnum: string implements HasLabel, HasColor
{
    case TOOL = 'Tool';
    case PROGRAMMING_LANGUAGE = 'Programming Language';
    case DATABASE = 'Database';
    case OTHER = 'Other';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::TOOL => 'Tool',
            self::PROGRAMMING_LANGUAGE => 'Programming Language',
            self::DATABASE => 'Database',
            self::OTHER => 'Other',
        };
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::TOOL => 'danger',
            self::PROGRAMMING_LANGUAGE => 'primary',
            self::DATABASE => 'success',
            self::OTHER => 'warning'
        };
    }
}
