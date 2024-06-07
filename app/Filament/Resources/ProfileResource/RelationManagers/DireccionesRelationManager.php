<?php

namespace App\Filament\Resources\ProfileResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DireccionesRelationManager extends RelationManager
{
    protected static string $relationship = 'direccion';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->label('Id')
                    ->disabled()
                    ->default('Auto'),
                Forms\Components\TextInput::make('calle')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('numero')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('piso')   
                    ->maxLength(255),
                Forms\Components\TextInput::make('puerta')
                    ->maxLength(255),
                Forms\Components\TextInput::make('codigo_postal')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ciudad')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('provincia')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('pais')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),  
                Tables\Columns\TextColumn::make('calle'),
                Tables\Columns\TextColumn::make('numero'),
                Tables\Columns\TextColumn::make('piso'),
                Tables\Columns\TextColumn::make('puerta'),
                Tables\Columns\TextColumn::make('codigo_postal'),
                Tables\Columns\TextColumn::make('ciudad'),
                Tables\Columns\TextColumn::make('provincia'),
                Tables\Columns\TextColumn::make('pais'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\TextColumn::make('updated_at'),
                
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
