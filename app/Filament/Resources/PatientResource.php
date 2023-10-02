<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\HamilelikDovru;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Xəstələr';

    public static function form(Form $form): Form
    {
//        $infectiousDiseases = InfectiosDisease::pluck('name', 'id');
        return $form
            ->schema([
                Forms\Components\TextInput::make('register_no')
                    ->label('Qeydiyyat N')
                    ->numeric()
                    ->required(),
                Forms\Components\DatePicker::make('first_application')
                    ->label('Ilkin müraciət')
                    ->nullable(),
                Forms\Components\TextInput::make('sending_medical')
                    ->label('Göndərən müəssisə')
                    ->nullable(),
                Forms\Components\TextInput::make('fullname')
                    ->label('Ad Soyad Ata adı')
                    ->required(),
                Forms\Components\Select::make('gender')
                    ->label('Cinsiyyət')
                    ->options(['Kişi' => 'Kişi', 'Qadın' => 'Qadın'])
                    ->nullable(),
                Forms\Components\DatePicker::make('birth_date')
                    ->label('Doğum tarixi')
                    ->required(),
                Forms\Components\Select::make('city_id')
                    ->label('Rayon')
                    ->relationship('city', 'name')
                    ->nullable(),
                Forms\Components\TextInput::make('actual_address')
                    ->label('Yaşadığı ünvan')
                    ->nullable(),
                Forms\Components\TextInput::make('phone1')
                    ->label('Telefon nömrəsi (ata)')
                    ->nullable(),
                Forms\Components\TextInput::make('phone2')
                    ->label('Telefon nömrəsi (ana)')
                    ->nullable(),
                Forms\Components\TextInput::make('fathername')
                    ->label('Atanın Ad Soyadı')
                    ->nullable(),
                Forms\Components\TextInput::make('father_bad_habit')
                    ->label('Atanın zərərli vərdişləri')
                    ->nullable(),
                Forms\Components\TextInput::make('father_work')
                    ->label('Atanın iş yeri')
                    ->nullable(),
                Forms\Components\TextInput::make('mothername')
                    ->label('Ananın Ad Soyadı')
                    ->nullable(),
                Forms\Components\TextInput::make('mother_bad_habit')
                    ->label('Ananın zərərli vərdişləri')
                    ->nullable(),
                Forms\Components\TextInput::make('mother_work')
                    ->label('Ananın iş yeri')
                    ->nullable(),
                Forms\Components\Select::make('material_status')
                    ->label('Ailə vəziyyəti')
                    ->options(['Evli' => 'Evli', 'Boşanmış' => 'Boşanmış'])
                    ->nullable(),
                Forms\Components\Textarea::make('family_members')
                    ->label('Ailə üzvləri')
                    ->nullable(),
                Forms\Components\Textarea::make('qohumluq_elaqesi_etrafli')
                    ->label('Ata və Ananın qohumluq əlaqəsi')
                    ->nullable(),
                Forms\Components\Select::make('how_was_the_pregnancy')
                    ->label('Hamiləlik necə keçib?')
                    ->options(HamilelikDovru::all()->pluck('name','id')->toArray())
                    ->nullable(),
                Forms\Components\Textarea::make('hamilelik_nece_kecib_detalli')
                    ->label('Hamiləlik necə keçib ətraflı')
                    ->nullable(),
                Forms\Components\Select::make('consanguinity_of_parents')
                    ->label('Valideynlərin qohumluğu var?')
                    ->options(['Var' => 'Var', 'Yoxdur' => 'Yoxdur'])
                    ->nullable(),
                Forms\Components\Textarea::make('other_patients_in_the_family')
                    ->label('Ailədə digər xəstə varmı?')
                    ->nullable(),
                Forms\Components\TextInput::make('necenci_hamilelik')
                    ->label('Uşaq neçənci hamiləlikdəndir?')
                    ->numeric()
                    ->nullable(),
                Forms\Components\TextInput::make('child_weight')
                    ->label('Uşaqın çəkisi')
                    ->nullable(),
                Forms\Components\TextInput::make('child_height')
                    ->label('Uşaqın boyu')
                    ->nullable(),
                Forms\Components\Select::make('artificial_respiration')
                    ->label('Süni tənəffüs aparatına qoşulub?')
                    ->options(['Hə' => 'Hə', 'Yox' => 'Yox'])
                    ->nullable(),
                Forms\Components\TextInput::make('start_walking')
                    ->label('Nə vaxt gəzməyə başlayıb?')
                    ->nullable(),
                Forms\Components\TextInput::make('start_speaking')
                    ->label('Nə vaxt danışmaqa başlayıb?')
                    ->nullable(),
                Forms\Components\TextInput::make('vaccination')
                    ->label('Hansı peyvəndləri alıb?')
                    ->nullable(),
                Forms\Components\Select::make('infectios_disease_id')
                    ->label('Infeksiyalar')
                    ->multiple()
                    ->preload()
                    ->relationship('infectios_diseases', 'name'),
                Forms\Components\TextInput::make('medicine')
                    ->label('Hansı dərmanları qəbul edir')
                    ->nullable(),
                Forms\Components\Select::make('registered_psychoneurologist')
                    ->label('Psixoloqun qeydiyyatındadır?')
                    ->options(['Hə' => 'Hə', 'Yox' => 'Yox'])
                    ->nullable(),
                Forms\Components\Select::make('genetik_analiz')
                ->label('Genetik analiz olunub?')
                    ->options(['Hə' => 'Hə', 'Yox' => 'Yox'])
                    ->nullable(),
                Forms\Components\Textarea::make('pediatrician_notes')
                ->label('Pediatırın qeydləri')
                ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('register_no'),
                Tables\Columns\TextColumn::make('fullname'),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('birth_date'),
                Tables\Columns\TextColumn::make('city.name'),
                Tables\Columns\TextColumn::make('actual_address'),
                Tables\Columns\TextColumn::make('phone1'),
                Tables\Columns\TextColumn::make('phone2'),
                Tables\Columns\TextColumn::make('fathername'),
                Tables\Columns\TextColumn::make('father_bad_habit'),
                Tables\Columns\TextColumn::make('father_work'),
                Tables\Columns\TextColumn::make('mothername'),
                Tables\Columns\TextColumn::make('mother_bad_habit'),
                Tables\Columns\TextColumn::make('mother_work'),
                Tables\Columns\TextColumn::make('material_status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
