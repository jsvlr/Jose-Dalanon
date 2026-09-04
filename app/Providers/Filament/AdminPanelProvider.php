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
use Hamcrest\Core\Set;
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
    public function applySettingsConfig(Panel $panel): Panel
    {
        // This prevent error on newly pull and continue integration
        try {
            $brandName = Setting::get('general.brandName', env('APP_NAME'));
            $brandLogo = Storage::url(Setting::get('general.brandLogo', null));
            $favicon = Storage::url(Setting::get('general.favicon', null));
            $primaryColor = Setting::get('general.color', Color::Amber);

            $panel->brandName($brandName);
            $panel->colors([
                'primary' => $primaryColor
            ]);
            if ($brandLogo !== null) {
                $panel->brandLogo($brandLogo);
                $panel->brandLogoHeight('50px'); // will changed this to dynamic later...
            }

            if ($favicon !== null) {
                $panel->favicon($favicon);
            }
        } catch (Exception $e) {
            Log::error($e);
        } finally {
            return $panel;
        }
    }

    public function panel(Panel $panel): Panel
    {

        $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->sidebarCollapsibleOnDesktop()
            ->viteTheme('resources/css/filament/admin/theme.css')
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
}
