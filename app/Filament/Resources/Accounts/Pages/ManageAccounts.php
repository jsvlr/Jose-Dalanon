<?php

namespace App\Filament\Resources\Accounts\Pages;

use App\Filament\Resources\Accounts\AccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use App\Filament\Widgets\AccountStats;
use Filament\Support\Icons\Heroicon;
use Override;

class ManageAccounts extends ManageRecords
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->icon(Heroicon::Plus),
        ];
    }

    #[Override]
    protected function getHeaderWidgets(): array
    {
        return [
            AccountStats::class
        ];
    }
}
