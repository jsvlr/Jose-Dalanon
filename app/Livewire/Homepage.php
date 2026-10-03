<?php

namespace App\Livewire;

use App\Models\Certificate;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Project;
use App\Models\QuickStat;
use App\Services\GithubStatsService;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Homepage extends Component
{

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
            ->select(['slug', 'thumbnail', 'created_at', 'title', 'excerpt', 'tags', 'post_category_id'])
            ->latest()
            ->limit($limit)
            ->get();
    }

    #[Computed]
    public function featuredProjects(): Collection
    {
        return Project::where('is_featured', true)
            ->select(['title', 'slug', 'start_date', 'end_date', 'featured_image', 'project_logo'])
            ->get();
    }

    #[Computed]
    public function featuredCertificates(): Collection
    {
        return Certificate::where('is_featured', true)
            ->get();
    }

    public function render()
    {
        return view('livewire.homepage');
    }
}
