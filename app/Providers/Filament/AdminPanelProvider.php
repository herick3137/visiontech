<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;
use Filament\Navigation\NavigationItem;
use Filament\Facades\Filament;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => '#0d9488', // Cor Teal/Ciano
                'danger'  => Color::Rose,
                'gray'    => Color::Gray,
                'info'    => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->font('Inter')
            ->brandLogo(fn () => new \Illuminate\Support\HtmlString('
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                
                    <!-- Ícone com fundo e cor fixos via estilo inline -->
                    <div style="display: flex; align-items: center; justify-content: center; width: 3.5rem; height: 3.5rem; border-radius: 1rem; background-color: #1F2937; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 2.25rem; height: 2.25rem; color: #22D3EE;">
                            <path d="M2 19h20v2H2v-2zM5 10h4v7H5v-7zm7-3l-2.5 7.5h5L12 7zm5.5-2c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm-6-2L6.5 5 5 9l2 .5 1-2.5 7.5-2 1.5 2.5 1.5-1.5-2-3.5-5 1z"/>
                        </svg>
                    </div>

                    <!-- Textos corrigidos (Cor escura para o texto VISION aparecer no modo claro) -->
                    <div style="display: flex; flex-direction: column; text-align: left;">
                        <span style="font-size: 1.5rem; line-height: 1; font-weight: 900; letter-spacing: -0.05em;">
                            <span style="color: #1F2937;">VISION</span><span style="color: #22D3EE;">TECH</span>
                        </span>
                        
                        <span style="font-size: 0.65rem; font-weight: 700; letter-spacing: 0.25em; color: #9CA3AF; margin-top: 0.25rem;">
                            GEOSOL PBA
                        </span>
                    </div>

                </div>
            '))
            ->brandLogoHeight('4rem')
            ->navigationGroups([
                NavigationGroup::make()->label('OPERACIONAL'),
                NavigationGroup::make()->label('ADMINISTRAÇÃO'),
            ])
            ->navigationItems([
                NavigationItem::make('Sair')
                    ->url(fn (): string => route('filament.admin.auth.logout'))
                    ->icon('heroicon-o-arrow-right-on-rectangle')
                    ->group('ADMINISTRAÇÃO')
                    ->sort(99),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn (): string => Blade::render('
                    <style>
                        /* Escurece o fundo do layout principal e da tela de login no modo claro */
                        body, .fi-simple-layout {
                            background-color: #e2e8f0 !important;
                        }

                        /* Estilização da Barra Lateral Escura */
                        aside.fi-sidebar {
                            background-color: #0b1120 !important;
                            border-right: 1px solid #1e293b !important;
                        }
                        aside.fi-sidebar .fi-sidebar-header,
                        aside.fi-sidebar .fi-sidebar-nav {
                            background-color: transparent !important;
                        }
                        .fi-sidebar-group-label span {
                            color: #64748b !important;
                            font-size: 0.7rem !important;
                            font-weight: 700 !important;
                        }
                        .fi-sidebar-item-button {
                            color: #94a3b8 !important;
                        }
                        .fi-sidebar-item-active .fi-sidebar-item-button {
                            background: #00a8cc !important;
                            color: #ffffff !important;
                        }
                        .fi-sidebar-item-active .fi-sidebar-item-button * {
                            color: #ffffff !important;
                        }

                        /* Cores dos Títulos e Legendas dos Cards do StatsOverview */
                        /* 1. EM OPERAÇÃO (Azul) */
                        .fi-wi-stats-overview-stat:nth-child(1) .fi-wi-stats-overview-stat-label,
                        .fi-wi-stats-overview-stat:nth-child(1) .fi-wi-stats-overview-stat-description {
                            color: #0284c7 !important;
                            font-weight: 700 !important;
                        }
                        
                        /* 2. EM ESTOQUE (Verde) */
                        .fi-wi-stats-overview-stat:nth-child(2) .fi-wi-stats-overview-stat-label,
                        .fi-wi-stats-overview-stat:nth-child(2) .fi-wi-stats-overview-stat-description {
                            color: #16a34a !important;
                            font-weight: 700 !important;
                        }

                        /* 3. EM MANUTENÇÃO (Laranja) */
                        .fi-wi-stats-overview-stat:nth-child(3) .fi-wi-stats-overview-stat-label,
                        .fi-wi-stats-overview-stat:nth-child(3) .fi-wi-stats-overview-stat-description {
                            color: #ea580c !important;
                            font-weight: 700 !important;
                        }

                        /* 4. TOTAL DE COMPONENTES (Roxo) */
                        .fi-wi-stats-overview-stat:nth-child(4) .fi-wi-stats-overview-stat-label,
                        .fi-wi-stats-overview-stat:nth-child(4) .fi-wi-stats-overview-stat-description {
                            color: #9333ea !important;
                            font-weight: 700 !important;
                        }

                        /* Compactação para caber em 100vh sem rolagem */
                        .fi-main { padding-top: 0.75rem !important; padding-bottom: 0.75rem !important; }
                        .fi-page-header { margin-bottom: 0.5rem !important; }
                        .fi-widgets { gap: 0.75rem !important; }
                        .fi-section-header { padding: 0.5rem 1rem !important; }
                        .fi-section-content { padding: 0.5rem 1rem !important; }
                        .fi-ta-cell { padding-top: 0.35rem !important; padding-bottom: 0.35rem !important; }
                    </style>
                ')
            )
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
}