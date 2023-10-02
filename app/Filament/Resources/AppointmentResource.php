<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use App\Models\Diagnosis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Həkim qəbulu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('patient_id')
                            ->label('Xəstə')
                            ->relationship('patient', 'fullname')
                            ->searchable()
                            ->preload()
                            ->disabledOn('edit')
                            ->required(),
                Forms\Components\Select::make('doctor_id')
                            ->label('Həkim')
                            ->relationship('doctor', 'fullname')
                            ->disabledOn('edit')
                            ->required(),
                Forms\Components\Select::make('first_diagnosis_id')
                            ->label('Diaqnoz')
                            ->disabledOn('edit')
                            ->options(Diagnosis::all()->pluck('name', 'id')),
                Forms\Components\Select::make('first_or_second')
                            ->label('Müayinə tipi')
                            ->disabledOn('edit')
                            ->options(['0' => 'İlkin müyinə', '1' => 'Təkrar müayinə'])
                            ->required(),
                Forms\Components\DatePicker::make('appointment_date')
                            ->label('Qeydiyyat tarixi')
                            ->nullable(),
                Forms\Components\Textarea::make('appointment_notes')
                            ->label('Qeyd')
                            ->nullable(),
                Forms\Components\TextInput::make('status')
                            ->hidden('edit')
                            ->default(1),
                Forms\Components\DatePicker::make('appointment_history')
                            ->label('Müayinə tarixi')
                            ->hiddenOn('create')
                            ->nullable(),
                Forms\Components\Select::make('second_diagnosis_id')
                            ->label('Yekun Diaqnoz')
                            ->hiddenOn('create')
                            ->options(Diagnosis::all()->pluck('name', 'id')),
                Forms\Components\Select::make('third_diagnosis_id')
                            ->label('Əlaqəli Diaqnoz')
                            ->nullable()
                            ->hiddenOn('create')
                            ->options(Diagnosis::all()->pluck('name', 'id')),
                Forms\Components\Select::make('doctor_advice_id')
                            ->label('Hekim meslehetleri')
                            ->multiple()
                            ->preload()
                            ->hiddenOn('create')
                            ->relationship('doctor_advices', 'name'),
                Forms\Components\Textarea::make('appointment_history_note')
                            ->label('Müayinə qeydi')
                            ->hiddenOn('create')
                            ->nullable(),
            ]);


    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.fullname')
                    ->label('Ad Soyad Ata adı')
                    ->sortable(),
                TextColumn::make('doctor.fullname')
                    ->label('Qəbul edəcək həkim'),
                SelectColumn::make('first_diagnosis_id')
                    ->label('Diaqnoz')
                    ->disabled()
                    ->options(Diagnosis::all()->pluck('name', 'id')),
            ])
            ->filters([
                //
            ])
            ->actions([
                    Tables\Actions\DeleteAction::make()->button(),
                    Tables\Actions\EditAction::make()
                        ->label('Təsdiqlə')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->button()
                        ->successNotificationTitle('Müayinə uğurla təsdiqləndi.'),
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
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
            'view' => Pages\ViewAppointment::route('/{record}'),
        ];
    }

}
