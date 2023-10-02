<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DoctorAdviceResource\Pages;
use App\Filament\Resources\DoctorAdviceResource\RelationManagers;
use App\Models\Diagnosis;
use App\Models\DoctorAdvice;
use App\Models\Position;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DoctorAdviceResource extends Resource
{
    protected static ?string $model = DoctorAdvice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Həkim Məsləhətləri';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                Select::make('position_id')
                    ->relationship('position', 'name')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                SelectColumn::make('position_id')
                    ->label('Ixtisas')
                    ->disabled()
                    ->options(Position::all()->pluck('name', 'id')),
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
            'index' => Pages\ListDoctorAdvice::route('/'),
            'create' => Pages\CreateDoctorAdvice::route('/create'),
            'view' => Pages\ViewDoctorAdvice::route('/{record}'),
            'edit' => Pages\EditDoctorAdvice::route('/{record}/edit'),
        ];
    }
}
