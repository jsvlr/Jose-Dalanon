<?php

namespace App\Livewire;

use App\Models\Certificate;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Project;
use App\Models\QuickStat;
use App\Services\GithubStatsService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Outerweb\Settings\Facades\Setting;
use Exception;

class Homepage extends Component
{

    public ?string $name;
    public ?string $brandLogo;
    public ?string $tagline;

    public function mount()
    {
        try {
            $this->name = Setting::get('general.brandName', env('APP_NAME'));
            $this->brandLogo = Setting::get('general.brandLogo');
            $this->tagline = Setting::get('general.tagline', 'Laravel');
        } catch (Exception $e) {
            Log::error($e);
        }
    }

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
        return Post::where('is_featured', true)
            ->select(['slug', 'thumbnail', 'created_at', 'title', 'excerpt', 'tags', 'post_category_id'])
            ->orderBy('created_at')
            ->limit($limit)
            ->get();
    }

    #[Computed]
    public function usedBlogCategory(): Collection
    {
        return PostCategory::whereIn('id', $this->featuredBlogs()->pluck('post_category_id'))->get();
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
