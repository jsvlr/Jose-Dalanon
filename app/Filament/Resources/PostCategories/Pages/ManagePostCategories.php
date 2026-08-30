<?php

namespace App\Filament\Resources\PostCategories\Pages;

use App\Filament\Resources\PostCategories\PostCategoryResource;
use App\Filament\Widgets\PostCategoryStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Override;

class ManagePostCategories extends ManageRecords
{
    protected static string $resource = PostCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()->icon('heroicon-m-plus')];
    }

    #[Override]
    protected function getHeaderWidgets(): array
    {
        return [
            PostCategoryStats::class
        ];
    }
}
