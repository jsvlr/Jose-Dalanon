<?php

namespace App\Livewire\Blog;

use App\Enums\PostStatusEnum;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BlogIndex extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public string $search = '';

    public string $categoryId = '';

    #[Locked]
    public int $perPage = 6;

    #[Locked]
    protected array $columns = [
        'slug',
        'thumbnail',
        'excerpt',
        'created_at',
        'title',
        'tags',
        'post_category_id',
        'views',
    ];

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryId(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function categories(): Collection
    {
        return PostCategory::query()
            ->whereHas('posts', fn($query) => $query->where('status', PostStatusEnum::PUBLISHED))
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    #[Computed]
    public function posts(): ?LengthAwarePaginator
    {
        return Post::query()
            ->with('postCategory:id,name,color')
            ->where('status', PostStatusEnum::PUBLISHED)
            ->when($this->search, fn($query) => $query->where('title', 'like', "%{$this->search}%"))
            ->when($this->categoryId !== '' && filter_var($this->categoryId, FILTER_VALIDATE_INT), fn($query) => $query->where('post_category_id', $this->categoryId))
            ->select($this->columns)
            ->latest()
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.blog.blog-index')->title('Blogs');
    }
}
