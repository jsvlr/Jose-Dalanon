<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Blog extends Component
{

    public ?string $title = 'Blog';

    #[Computed]
    public function posts()
    {
        return Post::all();
    }

    public function render()
    {
        return view('livewire.blog')
            ->title($this->title);
    }
}
