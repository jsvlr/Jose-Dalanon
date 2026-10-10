<?php

use App\Enums\PostStatusEnum;
use App\Livewire\Blog\BlogIndex;
use App\Models\Post;
use App\Models\PostCategory;
use Livewire\Livewire;

it('filters published articles by category', function () {
    $selectedCategory = PostCategory::factory()->create();
    $otherCategory = PostCategory::factory()->create();

    Post::factory()->create([
        'post_category_id' => $selectedCategory->id,
        'status' => PostStatusEnum::PUBLISHED,
        'title' => 'Selected category article',
        'views' => 10,
    ]);

    Post::factory()->create([
        'post_category_id' => $otherCategory->id,
        'status' => PostStatusEnum::PUBLISHED,
        'title' => 'Other category article',
        'views' => 20,
    ]);

    Livewire::test(BlogIndex::class)
        ->set('categoryId', (string) $selectedCategory->id)
        ->assertSee('Selected category article')
        ->assertDontSee('Other category article');
});
