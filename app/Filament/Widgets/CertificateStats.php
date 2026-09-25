<?php

namespace App\Filament\Widgets;

use App\Models\Certificate;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CertificateStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stats = Certificate::all();
        $featured = $stats->where('is_featured', true)->count();

        return [
            Stat::make('Total Certificates', number_format($stats->count())),
            Stat::make('Featured', number_format($featured))
        ];
    }
}
