<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AttendanceResource\Pages;
use App\Filament\Resources\AttendanceResource\RelationManagers;
use App\Models\Attendance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class AttendanceResource extends Resource
{
    protected static ?string $model = Attendance::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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
                Forms\Components\Select::make('doctor_advice_id')
                    ->label('Hekim mesleheti')
                    ->relationship('doctorAdvice', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('count')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('first_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.fullname')
                    ->label('Ad Soyad Ata adı')
                    ->alignCenter()
                    ->sortable(),
                TextColumn::make('doctorAdvice.name')
                    ->label('Hekim mesleheti')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('count')
                    ->label('Geldiyi gunlerin sayi')
                    ->alignCenter()
                    ->sortable(),
                Tables\Columns\TextColumn::make('first_date')
                    ->label('Baslama tarixi')
                    ->alignCenter()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->label('Bitirme tarixi')
                    ->alignCenter()
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Davamiyyet')
                    ->modalDescription(fn(Attendance $attendance) => ($attendance->patient->fullname . ' Xestenin davamiyyetine deyisklik edirsiz'))
                    ->modalWidth('md')
                    ->modalSubmitAction(false)
                    ->modalIcon('heroicon-o-trash')
                    ->extraModalFooterActions([
                        Action::make('Əlavə et')
                            ->action(fn( Attendance $attendance) => $attendance->update(['count' => $attendance->count + 1])),
                        Action::make('Sil')
                            ->color('danger')
                            ->action(fn( Attendance $attendance) => $attendance->update(['count' => $attendance->count - 1])),

                    ])


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
            'index' => Pages\ListAttendances::route('/'),
            'create' => Pages\CreateAttendance::route('/create'),
            'edit' => Pages\EditAttendance::route('/{record}/edit'),
        ];
    }
}
