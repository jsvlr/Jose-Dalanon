<?php

namespace App\Filament\Resources\QuickStats;

use App\Filament\Resources\QuickStats\Pages\ManageQuickStats;
use App\Models\QuickStat;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class QuickStatResource extends Resource
{
    protected static ?string $model = QuickStat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('subtitle')
                    ->required()
                    ->maxLength(255),

                Toggle::make('in_used')
                    ->label('Use now')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No Quick Stats found')
            ->emptyStateDescription('Create your first stats to start organizing.')
            ->emptyStateIcon('heroicon-o-folder-open')
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->weight(FontWeight::Bold),

                TextColumn::make('subtitle')
                    ->sortable()
                    ->searchable()
                    ->weight(FontWeight::Light),

                ToggleColumn::make('in_used')
            ])
            ->filters([
                TernaryFilter::make('in_used')
                    ->label('Currently using')
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
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
            'index' => ManageQuickStats::route('/'),
        ];
    }
}
