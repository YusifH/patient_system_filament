<?php

namespace App\Filament\Resources\KlinikiGostericiResource\Pages;

use App\Filament\Resources\KlinikiGostericiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKlinikiGosterici extends EditRecord
{
    protected static string $resource = KlinikiGostericiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
