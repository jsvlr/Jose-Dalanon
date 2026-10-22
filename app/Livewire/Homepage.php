<?php

namespace App\Livewire;

use App\Models\Certificate;
use App\Models\Post;
use App\Models\Project;
use App\Models\QuickStat;
use App\Services\GithubStatsService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class Homepage extends Component
{
    #[Locked]
    protected array $blogColumns = [
        'slug',
        'thumbnail',
        'created_at',
        'title',
        'excerpt',
        'tags',
        'post_category_id'
    ];

    #[Locked]
    protected array $projectColumns = [
        'title',
        'slug',
        'start_date',
        'end_date',
        'featured_image',
        'project_logo'
    ];

    #[Locked]
    protected array $certificatesColumn = [
        'image',
        'issue_date',
        'credential_id',
        'credential_url'
    ];

    #[Computed]
    public function quickStats(): Collection
    {
        return QuickStat::where('in_used', true)
            ->select(['title', 'subtitle'])
            ->get();
    }

    #[Computed]
    public function githubStats(): array
    {
        return app(GithubStatsService::class)->stats();
    }

    #[Computed]
    public function featuredBlogs(): Collection
    {
        $limit = 3;
        return Post::query()
            ->with('postCategory:id,name,color')
            ->where('is_featured', true)
            ->select($this->blogColumns)
            ->latest()
            ->limit($limit)
            ->get();
    }

    #[Computed]
    public function featuredBlogCategories(): \Illuminate\Support\Collection
    {
        return $this->featuredBlogs
            ->pluck('postCategory')
            ->filter()
            ->unique('id')
            ->sortBy('name')
            ->values();
    }


    #[Computed]
    public function featuredProjects(): Collection
    {
        return Project::where('is_featured', true)
            ->select($this->projectColumns)
            ->get();
    }

    #[Computed]
    public function featuredCertificates(): Collection
    {
        return Certificate::where('is_featured', true)
            ->select($this->certificatesColumn)
            ->get();
    }

    public function render()
    {
        return view('livewire.homepage')
            ->title('Homepage');
    }
}
