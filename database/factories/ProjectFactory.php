<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(3);
        return [
            'title'   => $title,
            'slug'    => Str::slug($title),
            'role_id' => \App\Models\Role::factory()->createOne(),
            'excerpt' => fake()->paragraph(2),
            'body'    => fake()->paragraph(4),
            'status'  => fake()->randomElement(\App\Enums\ProjectStatusEnum::class),
            'url'     => fake()->url(),
            'is_published' => fake()->boolean(),
            'start_date' => fake()->dateTime(),
            'end_date' => null,
            'github_url' => fake()->url(),
            'live_url' => fake()->url(),
            'featured_image' => null,
            'project_logo' => null,
        ];
    }
}
