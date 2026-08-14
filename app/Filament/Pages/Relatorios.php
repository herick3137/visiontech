<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Componente;
use App\Models\Movimentacao;
use App\Models\Sonda;
use App\Models\User; 
use Illuminate\Support\Facades\DB;

class Relatorios extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar-square';
    protected static ?string $navigationGroup = 'OPERACIONAL';
    protected static ?string $title = 'Relatórios Gerenciais';
    protected static ?string $navigationLabel = 'Relatórios';
    protected static ?int $navigationSort = 4;
    protected static string $view = 'filament.pages.relatorios';

    protected function getViewData(): array
    {
        // Agrupa os funcionários/usuários pela coluna 'cargo'
        $equipePorCargo = User::select('cargo', DB::raw('count(*) as total'))
            ->groupBy('cargo')
            ->get();

        // Contagens base de Inventário
        $totalEquipamentos = Componente::count();
        $emEstoque = Componente::where('status', 'estoque')->count();
        $emManutencao = Componente::where('status', 'manutencao')->count();
        
        // Calculando equipamentos em uso (Total - Estoque - Manutencao)
        $emUso = $totalEquipamentos - $emEstoque - $emManutencao;

        return [
            // Inventário
            'totalEquipamentos'  => $totalEquipamentos,
            'emEstoque'          => $emEstoque,
            'emManutencao'       => $emManutencao,
            'emUso'              => $emUso > 0 ? $emUso : 0, 
            
            // Operações
            'totalSondas'        => Sonda::count(),
            // Trocamos a contagem de mês pela contagem de status
            'sondasManutencao'   => Sonda::where('status', 'manutencao')->count(), 
            
            'totalMovimentacoes' => Movimentacao::count(),
            'movimentacoesMes'   => Movimentacao::where('data_hora', '>=', now()->subDays(30))->count(),
            
            // RH
            'equipePorCargo'     => $equipePorCargo,
            'totalFuncionarios'  => User::count(),
        ];
    }
}