<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SondaResource\Pages;
use App\Filament\Resources\SondaResource\RelationManagers;
use App\Models\Sonda;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SondaResource extends Resource
{
    protected static ?string $model = Sonda::class;
    protected static ?string $navigationLabel = 'Sondas';
    protected static ?string $navigationIcon = 'heroicon-o-arrow-down-tray';
    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('status')
                    ->maxLength(20)
                    ->default('Ativa'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
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
            'index' => Pages\ListSondas::route('/'),
            'create' => Pages\CreateSonda::route('/create'),
            'edit' => Pages\EditSonda::route('/{record}/edit'),
        ];
    }
}
