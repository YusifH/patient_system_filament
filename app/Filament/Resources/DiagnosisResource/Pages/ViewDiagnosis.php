<?php

namespace App\Filament\Resources\DiagnosisResource\Pages;

use App\Filament\Resources\DiagnosisResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDiagnosis extends ViewRecord
{
    protected static string $resource = DiagnosisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
