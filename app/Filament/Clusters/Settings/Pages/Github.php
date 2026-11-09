<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings\SettingsCluster;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Outerweb\FilamentSettings\Pages\Settings;
use Override;

class Github extends Settings
{
    protected static ?string $navigationLabel = 'Github';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Bolt;

    protected static ?string $cluster = SettingsCluster::class;

    #[Override]
    public function getTitle(): string|Htmlable
    {
        return 'Github Credentials';
    }

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                TextInput::make('github.username')
                    ->required()
                    ->maxLength(100)
                    ->label('Username')
                    ->helperText('Your github username'),

                TextInput::make('github.token')
                    ->required()
                    ->maxLength(255)
                    ->label('Token')
                    ->helperText('Your git token you created')
                    ->password()
                    ->revealable()
            ]);
    }
}
