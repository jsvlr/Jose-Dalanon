<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(4)
            ->components([
                FileUpload::make('thumbnail')
                    ->disk('public')
                    ->directory('post_thumbnails')
                    ->image()
                    ->imageEditor()
                    ->helperText('max size 5 mb')
                    ->maxSize(5024)
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->columnSpan(2)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->readOnly(),

                Select::make('post_category_id')
                    ->required()
                    ->label('Category')
                    ->relationship('postCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm(
                        [
                            Grid::make(3)
                                ->schema([
                                    TextInput::make('name')
                                        ->required()
                                        ->autofocus()
                                        ->maxLength(255)
                                        ->live(onBlur: true)
                                        ->columnSpan(2)
                                        ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                    ColorPicker::make('color')
                                        ->columnSpan(1)
                                        ->required(),

                                    TextInput::make('slug')
                                        ->required()
                                        ->readOnly()
                                        ->columnSpanFull()
                                ])
                        ]
                    ),
                TextInput::make('excerpt')
                    ->columnSpanFull(),

                RichEditor::make('content')
                    ->columnSpanFull(),

                DatePicker::make('published_at')
                    ->default(now()),

                TagsInput::make('tags')
                    ->suggestions(
                        fn() => \App\Models\Post::query()
                            ->pluck('tags')
                            ->flatten()
                            ->unique()
                            ->values()
                            ->toArray()
                    )
                    ->separator(',')
                    ->splitKeys(['Tab', ',']),

                Select::make('status')
                    ->options(\App\Enums\PostStatusEnum::class),

                Toggle::make('is_featured')
                    ->required()
                    ->default(false)
            ]);
    }
}
