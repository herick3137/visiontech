<?php

namespace App\Filament\Resources\SondaResource\Pages;

use App\Filament\Resources\SondaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSondas extends ListRecords
{
    protected static string $resource = SondaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
