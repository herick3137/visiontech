<?php

namespace App\Filament\Widgets;

use App\Models\Componente;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\HtmlString;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected int | string | array $columnSpan = 'full';

    // FORÇA O LAYOUT A FICAR COM 4 CARDS NA MESMA LINHA
    protected function getColumns(): int
    {
        return 4;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(
                new HtmlString('<span class="text-[#0284c7] font-extrabold text-[11px] uppercase tracking-wider">EM OPERAÇÃO</span>'), 
                Componente::where('status', 'operacao')->count()
            )
                ->description(new HtmlString('<span class="text-[#0284c7]">componentes</span>'))
                ->icon('heroicon-o-truck')
                ->color('info'),

            Stat::make(
                new HtmlString('<span class="text-[#16a34a] font-extrabold text-[11px] uppercase tracking-wider">EM ESTOQUE</span>'), 
                Componente::where('status', 'estoque')->count()
            )
                ->description(new HtmlString('<span class="text-[#16a34a]">componentes</span>'))
                ->icon('heroicon-o-home-modern')
                ->color('success'),

            Stat::make(
                new HtmlString('<span class="text-[#ea580c] font-extrabold text-[11px] uppercase tracking-wider">EM MANUTENÇÃO</span>'), 
                Componente::where('status', 'manutencao')->count()
            )
                ->description(new HtmlString('<span class="text-[#ea580c]">componentes</span>'))
                ->icon('heroicon-o-wrench-screwdriver')
                ->color('warning'),

            Stat::make(
                new HtmlString('<span class="text-[#9333ea] font-extrabold text-[11px] uppercase tracking-wider">TOTAL DE COMPONENTES</span>'), 
                Componente::count()
            )
                ->description(new HtmlString('<span class="text-[#9333ea]">cadastrados</span>'))
                ->icon('heroicon-o-cube')
                ->color('primary'),
        ];
    }
}