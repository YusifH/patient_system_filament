<?php

namespace App\Filament\Resources\DoctorAdviceResource\Pages;

use App\Filament\Resources\DoctorAdviceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDoctorAdvice extends ListRecords
{
    protected static string $resource = DoctorAdviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
