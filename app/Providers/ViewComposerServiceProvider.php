<?php

namespace App\Providers;

use App\Models\Account;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(
            ['components.navbar', 'components.footer', 'livewire.homepage'],
            function ($view) {
                $view->with('accounts', Cache::rememberForever(
                    'social-links',
                    fn() => Account::where('is_active', true)->get()->toArray(),
                ));

                $view->with('links', [
                    'home' => [
                        'label' => 'Home',
                        'icon' => 'fa-solid fa-house'
                    ],
                    'blogs' => [
                        'label' => 'Blog',
                        'icon' => 'fa-brands fa-squarespace'
                    ],
                    'projects' => [
                        'label' => 'Projects',
                        'icon' => 'fa-solid fa-diagram-predecessor'
                    ],
                    'about' => [
                        'label' => 'About',
                        'icon' => 'fa-solid fa-info'
                    ],
                    'stack' => [
                        'label' => 'Stack',
                        'icon' => 'fa-solid fa-layer-group'
                    ],
                ]);
            }
        );
    }
}
