<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimentacaoResource\Pages;
use App\Filament\Resources\MovimentacaoResource\RelationManagers;
use App\Models\Movimentacao;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovimentacaoResource extends Resource
{
    protected static ?string $model = Movimentacao::class;

    protected static ?string $navigationLabel = 'Movimentações';
    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('componente_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('origem')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('destino')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('usuario_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\TextInput::make('usuario')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DateTimePicker::make('data_hora')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('componente_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('origem')
                    ->searchable(),
                Tables\Columns\TextColumn::make('destino')
                    ->searchable(),
                Tables\Columns\TextColumn::make('usuario_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('usuario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('data_hora')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListMovimentacaos::route('/'),
            'create' => Pages\CreateMovimentacao::route('/create'),
            'edit' => Pages\EditMovimentacao::route('/{record}/edit'),
        ];
    }
}
