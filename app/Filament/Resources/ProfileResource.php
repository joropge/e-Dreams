<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\User;
use App\Models\Direccion;
use Filament\Forms\Components\Section;
use App\Filament\Resources\ProfileResource\RelationManagers\DireccionesRelationManager;



class ProfileResource extends Resource
{
    protected static ?string $model = User::class;

    protected static $modelRelationships = [
        'direccion' => Direccion::class,
    ];

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $navigationGroup = 'Users Managment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Section::make('User Info')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('id')
                            ->label('Id')
                            ->disabled()
                            ->default('Auto'),
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->required(),
                        Forms\Components\TextInput::make('apellidos')
                            ->label('Apellidos')
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->required(),

                        Forms\Components\TextInput::make('password')
                            ->label('Password')
                            ->required(),

                        Forms\Components\TextInput::make('rol')
                            ->label('Rol')
                            ->default('user')
                            ->required(),

                        Forms\Components\TextInput::make('created_at')
                            ->label('Created At')
                            ->disabled(),

                        Forms\Components\TextInput::make('updated_at')
                            ->label('Updated At')
                            ->disabled(),
                    ]),

                // Section::make('Direcciones del Usuario')
                //     ->columns(3)
                //     ->schema([
                //         Forms\Components\TextInput::make('calle')
                //             ->label('Calle')
                //             ->required(),

                //         Forms\Components\TextInput::make('numero')
                //             ->label('Numero')
                //             ->required(),

                //         Forms\Components\TextInput::make('piso')
                //             ->label('Piso'),

                //         Forms\Components\TextInput::make('puerta')
                //             ->label('Puerta'),

                //         Forms\Components\TextInput::make('codigo_postal')
                //             ->label('Codigo Postal')
                //             ->required(),

                //         Forms\Components\TextInput::make('ciudad')
                //             ->label('Ciudad')
                //             ->required(),

                //         Forms\Components\TextInput::make('provincia')
                //             ->label('Provincia')
                //             ->required(),

                //         Forms\Components\TextInput::make('pais')
                //             ->label('Pais')
                //             ->required(),


                //     ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('id')
                    ->label('Id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('apellidos')
                    ->label('Apellidos')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('rol')
                    ->label('Rol')
                    ->searchable()
                    ->sortable(),

                // Tables\Columns\TextColumn::make('direcciones')
                //     ->label('Direcciones')
                //     ->relationship('direccion', 'calle')
                //     ->searchable()
                //     ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('password')
                    ->label('Password')
                    ->searchable(),
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
            DireccionesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProfiles::route('/'),
            'create' => Pages\CreateProfile::route('/create'),
            'edit' => Pages\EditProfile::route('/{record}/edit'),
        ];
    }
}
