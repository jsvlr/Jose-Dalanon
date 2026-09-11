<?php

namespace App\Filament\Widgets;

use App\Models\Role;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RoleStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stats = Role::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN is_primary = ? THEN 1 ELSE 0 END) as total_primary
        ", [
            true
        ])->first();

        $mostUsedRole = Role::withCount('projects')
            ->orderByDesc('projects_count')
            ->first();

        $total = $stats->total;
        $totalPrimary = $stats->total_primary;

        return [
            Stat::make('Total role', number_format($total)),
            Stat::make('Primary', number_format($totalPrimary)),
            Stat::make('Most Used Role', $mostUsedRole?->title ?? 'N/A')
                ->description($mostUsedRole ? "{$mostUsedRole->projects_count} projects" : null),
        ];
    }
}
