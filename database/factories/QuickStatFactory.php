<?php

namespace Database\Factories;

use App\Models\QuickStat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<QuickStat>
 */
class QuickStatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->unique()->word(),
            'subtitle' => fake()->unique()->word(),
            'in_used' => fake()->boolean(chanceOfGettingTrue: 50)
        ];
    }
}
