<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AcoesRapidas;
use App\Filament\Widgets\ComponentesChart;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\UltimasMovimentacoes;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'Dashboard';
    
    protected ?string $subheading = null;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('escanear')
                ->label('Escanear')
                ->icon('heroicon-o-qr-code') // Ícone de QR Code / Leitor
                ->color('success')
                ->size('sm') // Botão compacto
                ->url('/admin/ler-qr-code'), // Caminho atualizado para a página de escaneamento
        ];
    }

    public function getColumns(): int | string | array
    {
        return [
            'default' => 1,
            'md' => 3,
            'lg' => 3,
        ];
    }

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,
            ComponentesChart::class,
            UltimasMovimentacoes::class,
            AcoesRapidas::class,
        ];
    }
}