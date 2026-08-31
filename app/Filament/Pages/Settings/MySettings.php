<?php

namespace App\Filament\Pages\Settings;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Support\Colors\Color;
use Outerweb\FilamentSettings\Pages\Settings;
use Override;

class MySettings extends Settings
{

    protected static ?string $navigationLabel = 'Settings';

    #[Override]
    public static function navigationLabel(?string $label): void
    {
        parent::navigationLabel($label);
    }

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->vertical()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('General')
                            ->icon(Heroicon::OutlinedGlobeAlt)
                            ->schema([
                                Section::make('Site Identity')
                                    ->description('Basic information about your brand and site.')
                                    ->columns(3)
                                    ->collapsible()
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
                                    ]),

                                Section::make('Brand Media')
                                    ->description('Logos, Dark Mode logo and favicon.')
                                    ->collapsed()
                                    ->columns(3)
                                    ->components([
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

                                Section::make('Contact')
                                    ->description('Public facing contact details for your site.')
                                    ->collapsed()
                                    ->columnSpanFull()
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

                            ]),

                        Tab::make('SEO')
                            ->icon(Heroicon::PaperAirplane)
                            ->schema([
                                TextInput::make('seo.title'),
                                TextInput::make('seo.description')
                            ]),

                        Tab::make('Database')
                            ->icon(Heroicon::CircleStack)
                            ->components([
                                // TextInput::make('')
                            ])
                    ])
            ]);
    }
}
