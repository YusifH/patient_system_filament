<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KlinikiGostericiResource\Pages;
use App\Filament\Resources\KlinikiGostericiResource\RelationManagers;
use App\Models\KlinikiGosterici;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KlinikiGostericiResource extends Resource
{
    protected static ?string $model = KlinikiGosterici::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Kliniki Göstəricilər';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
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
            'index' => Pages\ListKlinikiGostericis::route('/'),
            'create' => Pages\CreateKlinikiGosterici::route('/create'),
            'view' => Pages\ViewKlinikiGosterici::route('/{record}'),
            'edit' => Pages\EditKlinikiGosterici::route('/{record}/edit'),
        ];
    }    
}
