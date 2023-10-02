<?php

namespace App\Filament\Resources\DoctorResource\Pages;

use App\Filament\Resources\DoctorResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListDoctors extends ListRecords
{
    protected static string $resource = DoctorResource::class;

     protected function getHeaderActions(): array
     {
         return [
             Actions\CreateAction::make()->label('Yeni Hekim elave et'),
         ];
     }

    protected function getTableQuery(): Builder
    {
        return User::query()->where('user_type', 1);
    }

}
