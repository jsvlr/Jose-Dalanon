<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectSkill;
use App\Models\Skill;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectCount = $this->command->ask('How many records you want to seed?', 5);

        // Create a shared pool of skills ONCE, or reuse existing ones
        $skillPoolCount = $this->command->ask('How many total skills should exists in pool?', 10);
        $skillPool = Skill::factory((int) $skillPoolCount)->create();

        for ($i = 0; $i < $projectCount; $i++) {
            $project = Project::factory()->create();

            $skillsCount = $this->command->ask("How many skills you want to add for {$project->title}?", 0);
            if ($skillPoolCount <= 0) continue;

            // Pick random EXISTING skills from the pool, no duplicates for this project
            $randomSkill = $skillPool->random(min($skillsCount, $skillPool->count()));

            $project->skills()->attach($randomSkill->pluck('id'));
        }
    }
}
