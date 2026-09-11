<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Skill;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns([
                'lg' => 4
            ])
            ->components([
                FileUpload::make('featured_image')
                    ->label('Featured Image')
                    ->image()
                    ->columnSpan(2)
                    ->maxSize(2048) // 2mb
                    ->disk('public')
                    ->directory('project'),

                FileUpload::make('project_logo')
                    ->label('Logo')
                    ->image()
                    ->maxSize(1024) // 1mb
                    ->disk('public')
                    ->directory('project')
                    ->columnSpan(2),

                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, ?string $state) {
                        $set('slug', Str::slug($state));
                    })
                    ->columnSpan(2),

                TextInput::make('slug')
                    ->required()
                    ->readOnly(),

                Select::make('role_id')
                    ->relationship('role', 'title')
                    ->preload()
                    ->searchable(),

                Select::make('status')
                    ->options(\App\Enums\ProjectStatusEnum::class)
                    ->default(\App\Enums\ProjectStatusEnum::ARCHIVE),

                TextInput::make('url')
                    ->columnSpan(3),

                Textarea::make('excerpt')
                    ->helperText('Short description'),

                RichEditor::make('body')
                    ->columnSpan(3),
                Grid::make(4)
                    ->schema([
                        DatePicker::make('start_date'),

                        DatePicker::make('end_date'),

                        Select::make('skills')
                            ->relationship('skills', 'name')
                            ->multiple()
                            ->live()
                            ->preload(),

                        TextEntry::make('skills_used')
                            ->label('Skills used on this project')
                            ->weight(FontWeight::Light)
                            ->color('gray')
                            ->state(function (Get $get) {
                                $skillIds = $get('skills') ?? [];
                                if (empty($skillIds)) {
                                    return '-';
                                }

                                return Skill::whereIn('id', $skillIds)->pluck('name')->join(', ');
                            }),
                    ])
                    ->extraAttributes(['class' => 'items-end'])
                    ->columnSpanFull(),

            ]);
    }
}
