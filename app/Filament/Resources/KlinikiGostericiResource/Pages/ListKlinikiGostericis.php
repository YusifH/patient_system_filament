<?php

namespace App\Filament\Resources\KlinikiGostericiResource\Pages;

use App\Filament\Resources\KlinikiGostericiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKlinikiGostericis extends ListRecords
{
    protected static string $resource = KlinikiGostericiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
