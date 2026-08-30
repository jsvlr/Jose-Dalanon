<?php

namespace App\Filament\Resources\Posts\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Filament\Widgets\PostWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Override;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->icon('heroicon-m-plus')];
    }

    #[Override]
    protected function getHeaderWidgets(): array
    {
        return [
            PostWidget::class
        ];
    }
}
