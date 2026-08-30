<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\PostCategory;

class PostCategoryStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalCategories = number_format(PostCategory::count());
        $recentCount = PostCategory::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return [
            Stat::make('Total Categories', number_format($totalCategories))
                ->description($recentCount > 0 ? "+{$recentCount} posts this month created" : "No new categories created this month")
                ->descriptionIcon($recentCount > 0 ? 'heroicon-m-arrow-trending-up' : 'heroicon-m-minus')
                ->color($recentCount > 0 ? 'success' : 'gray')
                ->icon('heroicon-o-tag')
        ];
    }
}
