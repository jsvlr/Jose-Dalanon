<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProjectStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stats = Project::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN is_published = ? THEN 1 ELSE 0 END) as total_published
        ", [
            true

        ])->first();

        $total = $stats->total;
        $totalPublished = $stats->total_published;
        return [
            Stat::make('Total Projects', number_format($total)),
            Stat::make('Published', number_format($totalPublished))
                ->color('success')
        ];
    }
}
