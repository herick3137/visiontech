<?php

namespace App\Filament\Widgets;

use App\Models\Componente;
use Filament\Widgets\ChartWidget;

class ComponentesChart extends ChartWidget
{
    protected static ?string $heading = 'Componentes por localização';
    protected static ?int $sort = 2;
    
    // Aumentado para 180px para dar destaque ao gráfico mantendo a tela sem rolagem
    protected static ?string $maxHeight = '180px';

    protected int | string | array $columnSpan = [
        'default' => 3,
        'lg' => 1,
    ];

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Componentes',
                    'data' => [
                        Componente::where('status', 'operacao')->count(),
                        Componente::where('status', 'estoque')->count(),
                        Componente::where('status', 'manutencao')->count(),
                    ],
                    'backgroundColor' => ['#0284c7', '#16a34a', '#ea580c'],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => ['Em Operação', 'Em Estoque', 'Em Manutenção'],
        ];
    }

   protected function getOptions(): array
    {
        return [
            // Esconde as linhas de grade que estão aparecendo no fundo do gráfico
            'scales' => [
                'x' => ['display' => false],
                'y' => ['display' => false],
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                    'labels' => [
                        'boxWidth' => 10,
                        'usePointStyle' => true,
                        'font' => ['size' => 11],
                    ],
                ],
            ],
            'maintainAspectRatio' => false,
            'cutout' => '70%',
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}