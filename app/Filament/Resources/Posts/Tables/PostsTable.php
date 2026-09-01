<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->emptyStateHeading('No posts found')
            ->emptyStateDescription('We couldn\'t find any posts. Try changing your filters or search, or add a new one.')
            ->emptyStateIcon(
                fn($livewire) =>
                !empty($livewire->tableFilters) || !empty($livewire->tableSearch)
                    ? 'heroicon-o-magnifying-glass'
                    : 'heroicon-o-document-text'
            )
            ->columns([
                ImageColumn::make('thumbnail')
                    ->disk('public')
                    ->imageSize(50)
                    ->grow(false),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->limit(40),

                TextColumn::make('views')
                    ->numeric()
                    ->icon(Heroicon::ArrowUp)
                    ->sortable(),

                IconColumn::make('status')
                    ->tooltip(fn($state): string => $state->getLabel())
                    ->color(fn($state): string => $state->getColor())
                    ->icon(fn($state): string => $state->getIcon()),

                TextColumn::make('published_at')
                    ->label('Published')
                    ->date('M d, Y')
                    ->sortable()
                    ->placeholder('Not published'),

                ToggleColumn::make('is_featured')
                    ->disabled(fn($record) => $record->status !== \App\Enums\PostStatusEnum::PUBLISHED)
                    ->tooltip(fn($record) => $record->status !== \App\Enums\PostStatusEnum::PUBLISHED
                        ? 'Only published posts can be featured'
                        : null)
                    ->afterStateUpdated(function ($record) {
                        $newState = $record->is_featured;
                        Notification::make('status_updated')
                            ->title("Post updated successfully")
                            ->body("{$record->title} is " . ($newState ? 'featured' : 'not featured'))
                            ->icon(Heroicon::OutlinedCheckCircle)
                            ->iconColor('success')
                            ->date(now())
                            ->seconds(5) // 3 seconds duration
                            ->send();
                    })


            ])
            ->filters([
                SelectFilter::make('status')
                    ->options(\App\Enums\PostStatusEnum::class),

                SelectFilter::make('postCategory_id')
                    ->relationship('postCategory', 'name')
                    ->label('Category'),

                SelectFilter::make('published_at')
                    ->form([
                        DatePicker::make('published_from'),
                        DatePicker::make('published_until')
                    ])
                    ->query(function ($query, $data) {
                        return $query
                            ->when($data['published_from'], fn($q, $date) => $q->whereDate('published_at', '>=', $date))
                            ->when($data['published_until'], fn($q, $date) => $q->whereDate('published_at', '<=', $date));
                    }),

            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make()
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
