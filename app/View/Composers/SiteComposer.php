<?php

namespace App\View\Composers;

use App\Models\Account;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;


class SiteComposer
{
    private ?array $data = null;

    public function compose(View $view): void
    {
        $view->with($this->data ??= $this->build());
    }

    private function build(): array
    {
        $settings = Cache::remember('site-settings', now()->addHour(), fn() => [
            'brandName' => setting('general.brandName', config('app.name')),
            'brandLogo' => setting('general.brandLogo'),
            'favicon'   => setting('general.favicon'),
            'tagline'   => setting('general.tagline'),
            'email'     => setting('general.email'),
            'phone'     => setting('general.phone'),
        ]);

        return $settings + [
            'accounts' => Cache::rememberForever(
                'social-links',
                fn() => Account::where('is_active', true)
                    ->select(['icon', 'name', 'url'])
                    ->get()
                    ->toArray(),
            ),
            'links' => config('navigation.links'),
        ];
    }
}
