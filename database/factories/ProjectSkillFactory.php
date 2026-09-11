<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectSkill;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProjectSkill>
 */
class ProjectSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'project_id' => Project::factory()->create(),
            'skill_id' => Skill::factory()->create()
        ];
    }
}
