<?php

namespace App\Filament\Widgets;

use App\Models\Movimentacao;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Actions\Action;

class UltimasMovimentacoes extends BaseWidget
{
    protected static ?int $sort = 3;
    
    protected int | string | array $columnSpan = [
        'default' => 'full',
        'lg' => 2,
    ];

    protected static ?string $heading = 'Últimas movimentações';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Movimentacao::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('data_hora')
                    ->label('DATA/HORA')
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('componente.nome')
                    ->label('COMPONENTE')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('origem')
                    ->label('ORIGEM')
                    ->default('—'),

                Tables\Columns\TextColumn::make('destino')
                    ->label('DESTINO')
                    ->badge(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('USUÁRIO')
                    ->default('—'),
            ])
            ->headerActions([
                Action::make('verTodas')
                    ->label('Ver todas')
                    ->color('info')
                    ->url('https://visiontech-g520.onrender.com/admin/movimentacaos'), 
            ])
            ->paginated(false);
    }
}
