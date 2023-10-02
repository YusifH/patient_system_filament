<?php

namespace App\Filament\Resources\DoctorAdviceResource\Pages;

use App\Filament\Resources\DoctorAdviceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDoctorAdvice extends EditRecord
{
    protected static string $resource = DoctorAdviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
