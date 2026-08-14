<?php

namespace App\Filament\Resources\SondaResource\Pages;

use App\Filament\Resources\SondaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSonda extends EditRecord
{
    protected static string $resource = SondaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
