<?php

namespace App\Filament\Resources\Companies\Pages;

use App\Filament\Resources\Companies\CompanyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Icons\Heroicon;

class ManageCompanies extends ManageRecords
{
    protected static string $resource = CompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon(Heroicon::Plus),
        ];
    }
}
