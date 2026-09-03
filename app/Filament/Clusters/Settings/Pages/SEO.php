<?php

namespace App\Filament\Clusters\Settings\Pages;

use App\Filament\Clusters\Settings\SettingsCluster;

use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use Outerweb\FilamentSettings\Pages\Settings;
use Override;
use BackedEnum;
use Filament\Forms\Components\Toggle;

class SEO extends Settings
{
    protected static ?string $cluster = SettingsCluster::class;

    protected static ?string $navigationLabel = 'SEO';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::MagnifyingGlass;

    protected static ?string $slug = 'seo';

    #[Override]
    public function getTitle(): string|Htmlable
    {
        return 'Search Engine Optimization';
    }

    #[Override]
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('Basic Meta tags')
                            ->columns(3)
                            ->components([
                                TextInput::make('seo.metaTitle')
                                    ->required()
                                    ->label('Title')
                                    ->default('Laravel')
                                    ->maxLength(60)
                                    ->helperText('Recommended: 50-60 characters')
                                    ->columnSpan(2),

                                TagsInput::make('seo.metaKeywords')
                                    ->label('Keywords')
                                    ->helperText('Coma-separated keywords')
                                    ->columnSpan(1),

                                Textarea::make('seo.metaDescription')
                                    ->label('Description')
                                    ->helperText('Recommnended: 150-160 characters')
                                    ->maxLength(160)
                                    ->columnSpanFull()
                            ]),
                        Tab::make('Indexing')
                            ->components([
                                TextInput::make('seo.siteMapURL')
                                    ->label('Sitemap URL')
                                    ->url()
                                    ->placeholder('https://yourdomain.com/sitemap.xml'),

                                TextInput::make('seo.canonicalURL')
                                    ->label('Canonical URL')
                                    ->url()
                                    ->placeholder('https://yourdomain.com'),

                                Toggle::make('seo.index')
                                    ->label('Allow search engine indexing')
                                    ->default(true),
                                Toggle::make('seo.follow')
                                    ->label('Allow link following')
                                    ->default(true),
                                Toggle::make('seo.siteMapEnabled')
                                    ->label('Enable Sitemap'),

                            ])
                    ]),

            ]);
    }
}
