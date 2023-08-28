<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\InfectiosDisease;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Xəstələr';

    public static function form(Form $form): Form
    {
        $infectiousDiseases = InfectiosDisease::pluck('name', 'id');
        return $form
            ->schema([
                Forms\Components\TextInput::make('register_no')->required(),
                Forms\Components\TextInput::make('first_application')->required(),
                Forms\Components\TextInput::make('sending_medical')->required(),
                Forms\Components\TextInput::make('fullname')->required(),
                Forms\Components\Select::make('gender')
                ->options(['0' => 'Kişi', '1' => 'Qadın']),
                Forms\Components\DatePicker::make('birth_date')->required(),
                Forms\Components\TextInput::make('city.name')->required(),
                Forms\Components\TextInput::make('actual_address')->nullable(),
                Forms\Components\TextInput::make('phone1')->nullable(),
                Forms\Components\TextInput::make('phone2')->nullable(),
                Forms\Components\TextInput::make('fathername')->nullable(),
                Forms\Components\TextInput::make('father_bad_habit')->nullable(),
                Forms\Components\TextInput::make('father_work')->nullable(),
                Forms\Components\TextInput::make('mothername')->nullable(),
                Forms\Components\TextInput::make('mother_bad_habit')->nullable(),
                Forms\Components\TextInput::make('mother_work')
                    ->nullable(),
                Forms\Components\TextInput::make('material_status')
                    ->options(['0' => 'Evli', '1' => 'Boşanmış'])
                    ->nullable(),
                Forms\Components\Textarea::make('family_members')->nullable(),
                Forms\Components\Textarea::make('qohumluq_elaqesi_etrafli')->nullable(),
                Forms\Components\Textarea::make('hamilelik_nece_kecib_detalli')->nullable(),
                Forms\Components\TextInput::make('consanguinity_of_parents')
                    ->options(['0' => 'Var', '1' => 'Yoxdur'])
                    ->nullable(),
                Forms\Components\Textarea::make('other_patients_in_the_family')->nullable(),
                Forms\Components\TextInput::make('the_course_of_childbirth')->nullable(),
                Forms\Components\TextInput::make('how_was_the_pregnancy')->nullable(), //enum noram fesadli
                Forms\Components\TextInput::make('necenci_hamilelik')->nullable(),
                Forms\Components\TextInput::make('child_weight')->nullable(),
                Forms\Components\TextInput::make('child_height')->nullable(),
                Forms\Components\TextInput::make('artificial_respiration')
                    ->options(['0' => 'Hə', '1' => 'Yox'])
                    ->nullable(),
                Forms\Components\TextInput::make('start_walking')->nullable(),
                Forms\Components\TextInput::make('start_speaking')->nullable(),
                Forms\Components\TextInput::make('vaccination')->nullable(),
                
                Forms\Components\CheckboxList::make('infectious_disease')
                    ->label('Infeksion Xestelikler')
                    ->options($infectiousDiseases)
                    ->columns(3)
                    ->nullable(),
                Forms\Components\TextInput::make('medicine')->nullable(),
                Forms\Components\TextInput::make('registered_psychoneurologist')->nullable(),
                Forms\Components\TextInput::make('genetik_analiz')->nullable(),
                Forms\Components\Textarea::make('pediatrician_notes')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'view' => Pages\ViewPatient::route('/{record}'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }    
}
