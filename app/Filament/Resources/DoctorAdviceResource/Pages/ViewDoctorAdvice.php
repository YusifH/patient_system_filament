<?php

namespace App\Filament\Resources\DoctorAdviceResource\Pages;

use App\Filament\Resources\DoctorAdviceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDoctorAdvice extends ViewRecord
{
    protected static string $resource = DoctorAdviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
