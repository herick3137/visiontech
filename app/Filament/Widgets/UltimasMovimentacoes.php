<?php

namespace App\Filament\Widgets;

use App\Models\Movimentacao;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UltimasMovimentacoes extends BaseWidget
{
    protected static ?string $heading = 'Últimas movimentações';
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = [
        'default' => 3,
        'lg' => 2,
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                
                Movimentacao::query()->latest('data_hora')->limit(3)
            )
            ->paginated(false)
            ->columns([
                Tables\Columns\TextColumn::make('data_hora')
                    ->label('DATA/HORA')
                    ->dateTime('d/m/Y H:i'),

                Tables\Columns\TextColumn::make('componente.nome')
                    ->label('COMPONENTE')
                    ->formatStateUsing(fn ($record) => $record->componente ? "{$record->componente->nome} {$record->componente->numero_serie}" : '—')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('origem')
                    ->label('ORIGEM'),

                Tables\Columns\TextColumn::make('destino')
                    ->label('DESTINO')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'estoque' => 'success',
                        'oficina', 'manutenção', 'manutencao' => 'warning',
                        default => 'info',
                    }),

                Tables\Columns\TextColumn::make('usuario')
                    ->label('USUÁRIO')
                    ->default('—'),
            ])
            ->headerActions([
                Tables\Actions\Action::make('ver_todas')
                    ->label('Ver todas')
                    ->url('/admin/movimentacoes')
                    ->color('primary')
                    ->link(),
            ]);
    }
}