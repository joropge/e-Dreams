<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DireccionResource\Pages;
use App\Models\Direccion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\PasswordInput;
use App\Filament\Resources\DireccionResource\RelationManagers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DireccionResource extends Resource
{
    protected static ?string $model = Direccion::class;
    protected static ?string $navigationGroup = 'System Managment';
    // protected static ?string $title = 'Direcciones';



    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                //id
                Forms\Components\TextInput::make('id')
                    ->label('Id')
                    ->disabled()
                    ->default('Auto'),

                Forms\Components\TextInput::make('calle')
                    ->label('Calle')
                    ->required(),

                Forms\Components\TextInput::make('numero')
                    ->label('Numero')
                    ->required(),

                Forms\Components\TextInput::make('piso')
                    ->label('Piso'),

                Forms\Components\TextInput::make('puerta')
                    ->label('Puerta'),

                Forms\Components\TextInput::make('codigo_postal')
                    ->label('Codigo Postal')
                    ->required(),

                Forms\Components\TextInput::make('ciudad')
                    ->label('Ciudad')
                    ->required(),

                Forms\Components\TextInput::make('provincia')
                    ->label('Provincia')
                    ->required(),

                Forms\Components\TextInput::make('pais')
                    ->label('Pais')
                    ->required(),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([

                        Forms\Components\TextInput::make('id')
                            ->label('Id')
                            ->disabled()
                            ->default('Auto'),

                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\TextInput::make('apellidos')
                            ->label('Apellidos')
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->required(),
                        
                        Forms\Components\Select::make('rol')
                            ->label('Rol')
                            ->options([
                                'admin' => 'Admin',
                                'user' => 'User',
                            ])
                            ->required(),

                    ])
                    ->required(),

            ]);
    }
    

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Id'),
                Tables\Columns\TextColumn::make('user_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('calle'),
                Tables\Columns\TextColumn::make('numero'),
                Tables\Columns\TextColumn::make('piso'),
                Tables\Columns\TextColumn::make('puerta'),
                Tables\Columns\TextColumn::make('codigo_postal'),
                Tables\Columns\TextColumn::make('ciudad'),
                Tables\Columns\TextColumn::make('provincia'),
                Tables\Columns\TextColumn::make('pais'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListDireccions::route('/'),
            'create' => Pages\CreateDireccion::route('/create'),
            'edit' => Pages\EditDireccion::route('/{record}/edit'),
        ];
    }
}
