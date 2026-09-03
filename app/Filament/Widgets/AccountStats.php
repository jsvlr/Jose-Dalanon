<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Account;
use Filament\Support\Icons\Heroicon;

class AccountStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stat = Account::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN MONTH(created_at) = ? AND YEAR(created_at) = ? THEN 1 ELSE 0 END) as recent,
            SUM(CASE WHEN is_active = ? THEN 1 ELSE 0 END) as active,
            SUM(CASE WHEN is_active = ? THEN 1 ELSE 0 END) as inactive
        ", [
            now()->month,
            now()->year,
            true,
            false
        ])->first();

        $total = $stat->total;
        $recent = $stat->recent;
        $active = $stat->active;
        $inactive = $stat->inactive;

        return [
            Stat::make('Total Accounts', number_format($total))
                ->description($recent > 0 ? "+{$recent} account this month created" : "No new account created this month")
                ->color($recent > 0 ? 'success' : 'gray')
                ->icon(Heroicon::UserGroup),

            Stat::make('Active', number_format($active))
                ->description(
                    $total > 0
                        ? number_format(($active / $total) * 100, 1) . '% of all accounts'
                        : ''
                ),
            Stat::make('Not Active', number_format($inactive))
                ->description(
                    $total > 0
                        ? number_format(($inactive / $total) * 100, 1) . '% of all accounts'
                        : ''
                ),

        ];
    }
}
