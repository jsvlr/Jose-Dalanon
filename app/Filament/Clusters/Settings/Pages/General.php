<?php

namespace App\Filament\Clusters\Settings\Pages;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use Outerweb\FilamentSettings\Pages\Settings;
use App\Filament\Clusters\Settings\SettingsCluster;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Override;


class General extends Settings
{

    protected static ?string $navigationLabel = 'General';

    protected static ?string $cluster = SettingsCluster::class;


    #[Override]
    public function getTitle(): string|Htmlable
    {
        return 'Manage General';
    }

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Site Identity')
                            ->columns(3)
                            ->components([
                                TextInput::make('general.brandName')
                                    ->required()
                                    ->label('Name')
                                    ->default('Laravel')
                                    ->columnSpan(2),

                                ColorPicker::make('general.color')
                                    ->required()
                                    ->default(Color::Blue),

                                TextInput::make('general.tagline')
                                    ->helperText('A short catchy phrase for your brand')
                                    ->placeholder('Building the future, one line at a time')
                                    ->columnSpanFull(),

                                TextInput::make('general.copyright')
                                    ->label('Copyright Text')
                                    ->placeholder('© 2026 My App. All rights reserved.')
                                    ->helperText('this will be used on the footer.')
                                    ->columnSpanFull(),

                                FileUpload::make('general.brandLogo')
                                    ->label('Logo')
                                    ->disk('public')
                                    ->image()
                                    ->directory('brand')
                                    ->maxSize(1024),

                                FileUpload::make('general.brandLogoDarkMode')
                                    ->label('Dark Mode')
                                    ->disk('public')
                                    ->image()
                                    ->directory('brand')
                                    ->maxSize(1024),

                                FileUpload::make('general.favicon')
                                    ->disk('public')
                                    ->image()
                                    ->directory('brand')
                                    ->maxSize(256)
                            ]),

                        Tab::make('Contact')
                            ->columns(3)
                            ->components([
                                TextInput::make('general.email')
                                    ->email()
                                    ->helperText('Email specifically for this website porfolio')
                                    ->placeholder('@yourdomain.com')
                                    ->columnSpan(2),

                                TextInput::make('general.phone')
                                    ->tel()
                                    ->placeholder('09345678910'),

                                TextInput::make('general.url')
                                    ->url()
                                    ->label('Website URL')
                                    ->helperText('Public facing website url')
                                    ->placeholder('https://yourdomain.com')
                                    ->columnSpanFull(),

                                TextInput::make('general.address')
                                    ->label('Business Address')
                                    ->helperText('Physical or mailing address')
                                    ->columnSpanFull()
                            ])
                    ])
            ]);
    }
}
