<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(3);
        return [
            "post_category_id" => PostCategory::factory(),
            "title" =>  $title,
            "slug" => Str::slug($title),
            "thumbnail" => null,
            "excerpt" => fake()->paragraph(1),
            "content" => implode("\n\n", fake()->paragraphs(3)),
            "published_at" => fake()->dateTimeThisCentury(),
            "status" => fake()->randomElement(\App\Enums\PostStatusEnum::cases()),
            "views" => fake()->randomDigitNotNull(),
            "tags" => array_map(
                fn(): string => fake()->word(),
                range(3, 5)
            )
        ];
    }
}
