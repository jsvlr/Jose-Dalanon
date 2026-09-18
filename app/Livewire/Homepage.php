<?php

namespace App\Livewire;

use App\Models\QuickStat;
use App\Services\GithubStatsService;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Outerweb\Settings\Facades\Setting;

class Homepage extends Component
{
    public string $title = 'Homepage';
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
    public function quickStats(): array
    {
        return QuickStat::where('in_used', true)->get()->toArray();
    }

    #[Computed]
    public function githubStats(): array
    {
        return app(GithubStatsService::class)->stats();
    }

    public function render()
    {
        return view('livewire.homepage')
            ->title($this->title);
    }
}
