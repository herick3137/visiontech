<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComponenteResource\Pages;
use App\Models\Componente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class ComponenteResource extends Resource
{
    protected static ?string $model = Componente::class;

    // --- CONFIGURAÇÕES DA BARRA LATERAL ---
    protected static ?string $navigationLabel = 'Componentes';
    protected static ?string $navigationGroup = 'OPERACIONAL';
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('numero_serie')
                    ->label('Número de Série')
                    ->required()
                    ->maxLength(50),

                Forms\Components\TextInput::make('nome')
                    ->label('Nome do Componente')
                    ->required()
                    ->maxLength(100),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'estoque' => 'Estoque',
                        'operacao' => 'Em Operação',
                        'manutencao' => 'Manutenção',
                    ])
                    ->default('estoque')
                    ->required(),

                Forms\Components\TextInput::make('localizacao_atual')
                    ->label('Localização Atual')
                    ->required()
                    ->maxLength(50),

                Forms\Components\Select::make('sonda_id')
                    ->label('Sonda Vinculada')
                    ->relationship('sonda', 'nome')
                    ->nullable()
                    ->placeholder('Nenhuma sonda vinculada'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('numero_serie')
                    ->label('Nº de Série')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('nome')
                    ->label('Componente')
                    ->searchable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'operacao' => 'success',
                        'estoque' => 'info',
                        'manutencao' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('localizacao_atual')
                    ->label('Localização')
                    ->searchable(),

                Tables\Columns\TextColumn::make('sonda.nome')
                    ->label('Sonda')
                    ->default('—')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'estoque' => 'Estoque',
                        'operacao' => 'Em Operação',
                        'manutencao' => 'Manutenção',
                    ]),
            ])
            ->actions([
                // Botão para abrir o modal do QR Code
                Action::make('qr_code')
                    ->label('QR Code')
                    ->icon('heroicon-o-qr-code')
                    ->color('success')
                    ->modalHeading(fn (Componente $record) => "Gerar QR Code - " . $record->nome)
                    ->modalContent(fn (Componente $record) => view('filament.components.qr-code-modal', ['record' => $record]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Fechar'),

                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComponentes::route('/'),
            'create' => Pages\CreateComponente::route('/create'),
            'edit' => Pages\EditComponente::route('/{record}/edit'),
        ];
    }
}