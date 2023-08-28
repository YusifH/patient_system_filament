<?php

namespace App\Filament\Resources\KlinikiGostericiResource\Pages;

use App\Filament\Resources\KlinikiGostericiResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKlinikiGosterici extends ViewRecord
{
    protected static string $resource = KlinikiGostericiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
