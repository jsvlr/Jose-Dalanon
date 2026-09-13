<?php

namespace App\Providers\Filament;

use Awcodes\Gravatar\GravatarPlugin;
use Awcodes\Gravatar\GravatarProvider;
use Exception;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Outerweb\FilamentSettings\SettingsPlugin;
use Outerweb\Settings\Facades\Setting;

class AdminPanelProvider extends PanelProvider
{


    public function panel(Panel $panel): Panel
    {
        $panel = $this->applyGeneralSettingsConfig($panel);

        $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->sidebarCollapsibleOnDesktop()
            ->login()
            ->defaultAvatarProvider(GravatarProvider::class)
            ->profile(isSimple: false)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\\Filament\\Clusters')
            ->pages([
                Dashboard::class,
            ])
            ->plugins([
                GravatarPlugin::make(),
                SettingsPlugin::make(),
            ])
            ->databaseNotifications()
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);



        return $panel;
    }

    protected function applyGeneralSettingsConfig(Panel $panel): Panel
    {
        try {
            $general = [
                'brandName' => Setting::get('general.brandName', env('APP_NAME')),
                'brandLogo' => Setting::get('general.brandLogo'),
                'brandLogoHeight' => Setting::get('general.brandLogoHeight'),
                'favicon' => Setting::get('general.favicon'),
                'color' => Setting::get('general.color', Color::Amber),
            ];

            $panel
                ->brandName($general['brandName'])
                ->colors([
                    'primary' => $general['color']
                ])
                ->when(
                    $general['brandLogo'],
                    fn(Panel $p, $path) => $p
                        ->brandLogo(Storage::url($path))
                        ->brandLogoHeight(($general['brandLogoHeight'] ?? 50) . 'px')
                )
                ->when($general['favicon'], fn(Panel $p, $path) => $p
                    ->favicon(Storage::url($path)));
        } catch (Exception $e) {
            Log::error($e);
        }

        return $panel;
    }
}
