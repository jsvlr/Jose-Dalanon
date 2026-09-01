<?php

namespace App\Filament\Resources\PostCategories;

use App\Filament\Resources\PostCategories\Pages\ManagePostCategories;
use App\Models\PostCategory;
use BackedEnum;
use Dom\Text;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;
use Override;
use UnitEnum;

class PostCategoryResource extends Resource
{
    protected static ?string $model = PostCategory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Categories';

    protected static string|UnitEnum|null $navigationGroup = \App\Enums\NavigationGroupEnum::BLOG;

    protected static ?int $navigationSort = 0;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                TextInput::make('name')
                    ->required()
                    ->columnSpan(2)
                    ->autofocus()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', blank($state) ? '' : Str::slug($state))),

                ColorPicker::make('color')
                    ->required(),

                TextInput::make('slug')
                    ->required()
                    ->readOnly()
                    ->columnSpanFull()

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No categories found')
            ->emptyStateDescription('Create first category to start organizing posts.')
            ->emptyStateIcon('heroicon-o-folder-open')
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->weight(FontWeight::Bold)
                    ->sortable()
                    ->searchable(),

                TextColumn::make('slug')
                    ->toggledHiddenByDefault()
                    ->toggleable(),

                ColorColumn::make('color')
                    ->sortable()
                    ->searchable()
                    ->label('Color'),

                TextColumn::make('posts_count')
                    ->counts('posts')
                    ->default(0)
                    ->badge()
                    ->sortable()
                    ->searchable()
                    ->alignCenter(),

                TextColumn::make('created_at')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggledHiddenByDefault()
                    ->toggleable(),

                TextColumn::make('updated_at')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggledHiddenByDefault()
                    ->toggleable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManagePostCategories::route('/'),
        ];
    }
}
