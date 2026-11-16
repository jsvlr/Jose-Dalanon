<?php

namespace App\Filament\Pages\Settings;

use App\Enums\NavigationGroupEnum;
use BackedEnum;
use Filament\Forms\Components\Checkbox;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Outerweb\FilamentSettings\Pages\Settings;
use Override;
use UnitEnum;

class Security extends Settings
{
    protected static ?string $navigationLabel = 'Security';
    protected static string|UnitEnum|null $navigationGroup = NavigationGroupEnum::SETTINGS;
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLockClosed;

    #[Override]
    public function getTitle(): string|Htmlable
    {
        return 'Security';
    }

    #[Override]
    public function getSubheading(): string|Htmlable|null
    {
        return 'Manage your security here.';
    }

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make('Account Recovery')
                    ->collapsible()
                    ->columnSpan(1)
                    ->components([
                        Checkbox::make('security.password_reset')
                            ->default(true)
                            ->label('Can reset password')
                            ->helperText('If this is on user can reset your password by sending a email to your account')
                    ]),

                Section::make('Multifactor Authentication')
                    ->collapsible()
                    ->columnSpan(2)
                    ->components([

                    ])
            ]);
    }

}
