<?php

namespace App\Providers;

use App\View\Composers\SiteComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SiteComposer::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(
            [
                'components.layouts.app',
                'components.navbar',
                'components.footer',
                'livewire.homepage',
                'livewire.about'
            ],
            SiteComposer::class
        );
    }
}
