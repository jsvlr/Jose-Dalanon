<?php

namespace App\Filament\Resources\Certificates\Pages;

use App\Filament\Resources\Certificates\CertificateResource;
use App\Filament\Widgets\CertificateStats;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Icons\Heroicon;
use Override;

class ManageCertificates extends ManageRecords
{
    protected static string $resource = CertificateResource::class;

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
            CertificateStats::class
        ];
    }
}
