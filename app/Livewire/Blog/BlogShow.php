<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class BlogShow extends Component
{
    #[Locked, Computed]
    public Post $post;

    public function mount(): void
    {
        $this->recordView();
    }

    public function recordView(): void
    {
        $key = "post_view:{$this->post->slug}:" . request()->ip();

        // once per IP every 6 hours; remove the Cache:add check to count every refresh
        if (Cache::add($key, now()->addHours(6))) {
            $this->post->increment('views');
        }
    }

    #[Computed]
    public function content(): string
    {
        return RichContentRenderer::make($this->post->content)
            ->fileAttachmentsDisk('public')
            ->toHtml();
    }

    public function render()
    {
        return view('livewire.blog.blog-show')
            ->title($this->post->title);
    }
}
