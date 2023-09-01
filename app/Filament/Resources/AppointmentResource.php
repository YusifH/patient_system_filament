<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
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
                Section::make()
                    ->schema([
                        Select::make('patient_id')
                            ->label('Xəstə')
                            ->relationship('patient', 'fullname')
                            ->searchable()
                            ->preload()
//                            ->disabledOn('submit')
                            ->required(),
                        Select::make('doctor_id')
                            ->label('Həkim')
                            ->relationship('doctor', 'fullname')
                            ->required(),
                        Select::make('first_diagnosis_id')
                            ->label('Diaqnoz')
                            ->options(Diagnosis::all()->pluck('name', 'id')),
                        Select::make('first_or_second')
                            ->label('Müayinə tipi')
                            ->options(['0' => 'İlkin müyinə', '1' => 'Təkrar müayinə'])
                            ->required(),
                        DatePicker::make('appointment_date')
                            ->label('Qeydiyyat tarixi')
                            ->nullable(),
                        Textarea::make('appointment_notes')
                            ->label('Qeyd')
                            ->nullable(),
                        TextInput::make('status')
                            ->default('0')
                            ->hidden()
                    ])->columns(2)
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
                Tables\Actions\Action::make('submit')

                    ->form([
//                        Select::make('patient_id')
//                            ->label('Xeste')
//                            ->options(Patient::query()->pluck('fullname', 'id')),
                        Select::make('first_or_second')
                            ->label('Müayinə tipi')
                            ->options(['0' => 'İlkin müyinə', '1' => 'Təkrar müayinə']),
                        DatePicker::make('appointment_date')
                            ->label('Qeydiyyat tarixi')
                            ->nullable(),
                        Textarea::make('appointment_notes')
                            ->label('Qeyd')
                            ->nullable(),
                    ])
                    ->action(fn(Appointment $appointment) => $appointment->update(
                        [
                            'status' => 1,
                        ]
                    ))
                    ->color('primary')
                    ->requiresConfirmation(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make()->color('warning')
                    ->successNotificationTitle('Deyisiklik Ugurla Tamamlandi'),
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
        ];
    }
}
