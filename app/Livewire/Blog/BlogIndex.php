<?php

namespace App\Livewire\Blog;

use App\Enums\PostStatusEnum;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class BlogIndex extends Component
{

    #[Computed]
    public function posts(): Collection
    {
        return Post::where('status', PostStatusEnum::PUBLISHED)
            ->select([
                'slug',
                'thumbnail',
                'excerpt',
                'created_at',
                'title',
                'tags',
                'post_category_id'
            ])
            ->orderByDesc('created_at')
            ->get();
    }

    public function render()
    {
        return view('livewire.blog.blog-index')->title('Blogs');
    }
}
