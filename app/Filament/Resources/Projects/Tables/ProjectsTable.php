<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Support\Enums\FontWeight;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No projects found')
            ->emptyStateDescription('We couldn\'t find any projects. Try changing your filters or search, or add a new one.')
            ->emptyStateIcon(
                fn($livewire) =>
                !empty($livewire->tableFilters) || !empty($livewire->tableSearch)
                    ? 'heroicon-o-magnifying-glass'
                    : 'heroicon-o-bolt'
            )
            ->columns([
                ImageColumn::make('featured_image')
                    ->label('Thumbnail')
                    ->disk('public')
                    ->imageHeight(50),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('role.title')
                    ->searchable()
                    ->sortable()
                    ->color('gray')
                    ->weight(FontWeight::Light),

                IconColumn::make('is_published')
                    ->boolean(),
            ])
            ->filters([
                TernaryFilter::make('is_featured')
                    ->label('Featured'),

                SelectFilter::make('published_at')
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
}
