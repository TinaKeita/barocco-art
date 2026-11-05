<?php

namespace App\Providers\Filament;

use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->profile()

          
            ->brandName('Barocco Art')
            ->favicon(asset('favicon.png'))
            ->colors([
                'primary' => Color::Amber,   
            ])
            ->defaultThemeMode(ThemeMode::Dark)
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => '<style>' . self::css() . '</style>',
            )
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn (): string => '<script>' . self::js() . '</script>',
            )
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn (): string => '<p class="ba-login-note">Tikai Barocco Art administratoriem</p>',
            )

            // Link back to the website in the side menu
            ->navigationItems([
                NavigationItem::make('Skatīt mājaslapu')
                    ->url('/', shouldOpenInNewTab: true)
                    ->icon('heroicon-o-arrow-top-right-on-square')
                    ->sort(99),
            ])

            // ---------- Content ----------
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,   
            ])

            // ---------- Standard Filament middleware  ----------
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    // When the image editor opens, switch it to "move the image" mode
    private static function js(): string
    {
        return <<<'JS'
            document.addEventListener('ready', function (e) {
                const cropper = e.target.cropper;

                if (!cropper || !e.target.classList.contains('fi-fo-file-upload-editor-image')) return;

                cropper.setDragMode('move');
                // double click would switch back to "draw a new frame", so turn it off
                cropper.cropper.removeEventListener('dblclick', cropper.onDblclick);
            }, true);
        JS;
    }

    // A few small style touches, matching the website
    private static function css(): string
    {
        return <<<'CSS'
            /* Pure black background in dark mode, like the website */
            .dark .fi-body { background-color: #000; }
            .dark .fi-sidebar, .dark .fi-topbar > nav { background-color: #0a0a0a; }

            /* Rounder, softer cards */
            .fi-section, .fi-ta-ctn, .fi-simple-main { border-radius: 18px !important; }
            .dark .fi-section, .dark .fi-ta-ctn, .dark .fi-simple-main {
                background-color: #111;
                box-shadow: 0 0 0 1px #232323;
            }

            /* Pill-shaped buttons, like the website */
            .fi-btn { border-radius: 999px; }

            /* Brand name: bold and tight like the site logo */
            .fi-logo { font-weight: 700; letter-spacing: -0.02em; }

            /* Image editor: hide the number fields, only the buttons stay */
            .fi-fo-file-upload-editor-control-panel-main > .fi-fo-file-upload-editor-control-panel-group:first-child {
                display: none;
            }

            /* The frame can't be moved or resized, dragging moves the image under it */
            .fi-fo-file-upload-editor .cropper-crop-box,
            .fi-fo-file-upload-editor .cropper-crop-box * {
                pointer-events: none;
            }
            .fi-fo-file-upload-editor .cropper-line,
            .fi-fo-file-upload-editor .cropper-point {
                display: none;
            }
            .fi-fo-file-upload-editor .cropper-view-box {
                outline: 2px solid #fff;
            }
            .fi-fo-file-upload-editor .cropper-drag-box {
                cursor: grab;
            }

            /* Small note under the login form */
            .ba-login-note {
                margin-top: 1.25rem;
                text-align: center;
                font-size: 0.75rem;
                letter-spacing: 0.15em;
                text-transform: uppercase;
                color: #7a7a7a;
            }
        CSS;
    }
}