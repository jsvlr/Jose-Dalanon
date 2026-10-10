<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Livewire\Component;

class BlogShow extends Component
{
    public ?Post $post;


    public function render()
    {
        return view('livewire.blog.blog-show')
            ->title($this->post->title);
    }
}
