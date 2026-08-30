<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Post;
use Filament\Support\Icons\Heroicon;
use App\Enums\PostStatusEnum;

class PostWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {

        $stats = Post::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN MONTH(created_at) = ? AND YEAR(created_at) = ? THEN 1 ELSE 0 END) as recent,
            SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as published,
            SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as draft,
            SUM(CASE WHEN status = ? THEN 1 ELSE 0 END) as archived
        ", [
            now()->month,
            now()->year,
            PostStatusEnum::PUBLISHED->value,
            PostStatusEnum::DRAFT->value,
            PostStatusEnum::ARCHIVE->value,
        ])->first();

        $total = $stats->total;
        $recent = $stats->recent;

        $published = $stats->published;
        $archived = $stats->archived;
        $draft = $stats->draft;

        return [
            Stat::make('Total Posts', number_format($total))
                ->description($recent > 0 ? "+{$recent} posts this month created" : "No new post created this month")
                ->color($recent > 0 ? 'success' : 'gray')
                ->icon(Heroicon::Newspaper),

            Stat::make('Published', number_format($published))
                ->description($total > 0
                    ? number_format(($published / $total) * 100, 1) . '% of all posts'
                    : '')
                ->icon(PostStatusEnum::PUBLISHED->getIcon())
                ->color(PostStatusEnum::PUBLISHED->getColor()),

            Stat::make('Archived', number_format($archived))
                ->description($total > 0
                    ? number_format(($archived / $total) * 100, 1) . '% of all posts'
                    : '')
                ->icon(PostStatusEnum::ARCHIVE->getIcon())
                ->color(PostStatusEnum::ARCHIVE->getColor()),

            Stat::make('Draft', number_format($draft))
                ->description($total > 0
                    ? number_format(($draft / $total) * 100, 1) . '% of all posts'
                    : '')
                ->icon(PostStatusEnum::DRAFT->getIcon())
                ->color(PostStatusEnum::DRAFT->getColor()),

        ];
    }
}
