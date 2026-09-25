<?php

namespace App\Filament\Widgets;

use App\Models\Skill;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Override;

class SkillStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $stats = Skill::count();
        $topSkills = Skill::withCount('projectSkills')
            ->orderByDesc('project_skills_count')
            ->limit(3)
            ->get();

        $widget = [
            Stat::make('Total Skill', number_format($stats)),
        ];

        if ($topSkills->count() > 0) {
            $widget[] = Stat::make((string) $topSkills[0]->name, number_format($topSkills[0]->project_skills_count));
        }

        return $widget;
    }

    #[Override]
    protected function getColumns(): int|array|null
    {
        return [
            'lg' => 4,
            'md' => 2,
            'sm' => 1
        ];
    }
}
