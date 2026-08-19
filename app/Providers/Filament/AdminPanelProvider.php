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
                        /* Logo na Sidebar Escura */
                        aside.fi-sidebar .brand-text-primary { color: #ffffff !important; }
                        aside.fi-sidebar .brand-text-secondary { color: #9ca3af !important; }

                        /* Estilização da Barra Lateral Escura */
                        aside.fi-sidebar {
                            background-color: #0b1120 !important;
                            border-right: 1px solid #1e293b !important;
                            display: flex !important;
                            flex-direction: column !important;
                        }
                        aside.fi-sidebar .fi-sidebar-header,
                        aside.fi-sidebar .fi-sidebar-nav { background-color: transparent !important; }
                        aside.fi-sidebar .fi-sidebar-nav { flex: 1 1 auto !important; display: flex !important; flex-direction: column !important; }

                        /* Textos da Sidebar */
                        .fi-sidebar-group-label span { color: #64748b !important; font-size: 0.7rem !important; font-weight: 700 !important; }
                        .fi-sidebar-item-button { color: #94a3b8 !important; }
                        .fi-sidebar-item-active .fi-sidebar-item-button,
                        .fi-sidebar-item-active .fi-sidebar-item-button * { background: #00a8cc !important; color: #ffffff !important; }

                        /* MODO ESCURO - CARDS DE AÇÕES RÁPIDAS E SEÇÕES */
                        .dark .fi-section,
                        .dark .fi-wi-widget {
                            background-color: #1e293b !important;
                            border-color: #334155 !important;
                        }

                        /* FIX DE CORES: Botões de Ações Rápidas em Tema Escuro */
                        .dark [class*="acoes-rapidas"] a,
                        .dark [class*="acoes-rapidas"] button,
                        .dark .fi-section-content a,
                        .dark .fi-section-content button {
                            background-color: #0f172a !important;
                            border: 1px solid #334155 !important;
                        }
                        
                        .dark [class*="acoes-rapidas"] *,
                        .dark .fi-section-content a *,
                        .dark .fi-section-content button * {
                            color: #f8fafc !important;
                        }

                        /* --- FIX RESPONSIVO PARA O CELULAR (AÇÕES RÁPIDAS) --- */
                        @media (max-width: 640px) {
                            /* Remove a barra de rolagem horizontal */
                            .fi-section-content {
                                overflow-x: hidden !important;
                                padding: 0.5rem !important;
                            }
                            
                            /* Reorganiza qualquer container interno em Grid 2 Colunas */
                            .fi-section-content > div,
                            .fi-section-content .grid,
                            .fi-section-content [class*="flex"] {
                                display: grid !important;
                                grid-template-columns: repeat(2, 1fr) !important;
                                gap: 0.5rem !important;
                                width: 100% !important;
                                max-width: 100% !important;
                                box-sizing: border-box !important;
                            }

                            /* Ajusta o tamanho e texto dos cards para encaixar no celular */
                            .fi-section-content a, 
                            .fi-section-content button {
                                width: 100% !important;
                                min-width: 0 !important;
                                max-width: 100% !important;
                                box-sizing: border-box !important;
                                padding: 0.5rem !important;
                                flex-direction: column !important;
                                align-items: flex-start !important;
                            }

                            .fi-section-content a *, 
                            .fi-section-content button * {
                                white-space: normal !important;
                                word-break: break-word !important;
                            }
                        }

                        /* Cores dos Cards do Stats Overview */
                        .fi-wi-stats-overview-stat:nth-child(1) .fi-wi-stats-overview-stat-label,
                        .fi-wi-stats-overview-stat:nth-child(1) .fi-wi-stats-overview-stat-description { color: #0284c7 !important; font-weight: 700 !important; }
                        .fi-wi-stats-overview-stat:nth-child(2) .fi-wi-stats-overview-stat-label,
                        .fi-wi-stats-overview-stat:nth-child(2) .fi-wi-stats-overview-stat-description { color: #16a34a !important; font-weight: 700 !important; }
                        .fi-wi-stats-overview-stat:nth-child(3) .fi-wi-stats-overview-stat-label,
                        .fi-wi-stats-overview-stat:nth-child(3) .fi-wi-stats-overview-stat-description { color: #ea580c !important; font-weight: 700 !important; }
                        .fi-wi-stats-overview-stat:nth-child(4) .fi-wi-stats-overview-stat-label,
                        .fi-wi-stats-overview-stat:nth-child(4) .fi-wi-stats-overview-stat-description { color: #9333ea !important; font-weight: 700 !important; }

                        /* Layout Compacto */
                        .fi-main { padding-top: 0.75rem !important; padding-bottom: 0.75rem !important; }
                        .fi-page-header { margin-bottom: 0.5rem !important; }
                        .fi-widgets { gap: 0.75rem !important; }
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
