<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\UserType;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'İstifadəçilər';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required(),
                TextInput::make('email')->email()->required(),
                TextInput::make('password')->password()->required(),
                Select::make('user_type')
                ->options([
                    '0' => 'Admin',
                    '1' => 'Hekim',
                ])
                ->live()
                ->afterStateUpdated(fn (Select $component) => $component
                    ->getContainer()
                    ->getComponent('user_type')
                    ->getChildComponentContainer()
                    ->fill()),

                    Grid::make(1)
                    ->schema(fn (Get $get): array => match ($get('user_type')) {
                        '1' => [
                            Select::make('position_id')
                            ->relationship('position', 'name')->nullable(),
                            TextInput::make('phone_number')->nullable(),
                            TextInput::make('doctor_about')->nullable(),
                        ],
                        default => [],
                    })
                    ->key('user_type'),
                // Select::make('position_id')
                // ->relationship('position', 'name')->nullable(),
                // TextInput::make('phone_number')->nullable(),
                // TextInput::make('doctor_about')->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
