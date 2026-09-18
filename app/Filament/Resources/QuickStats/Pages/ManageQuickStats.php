<?php

namespace App\Filament\Resources\QuickStats\Pages;

use App\Filament\Resources\QuickStats\QuickStatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageQuickStats extends ManageRecords
{
    protected static string $resource = QuickStatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
