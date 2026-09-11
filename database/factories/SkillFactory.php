<?php

namespace Database\Factories;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => fake()->randomElement(\App\Enums\SkillTypeEnum::class),
            'icon' => fake()->imageUrl(),
            'level' => fake()->randomFloat(nbMaxDecimals: 2, min: 0, max: 100.00),
        ];
    }
}
