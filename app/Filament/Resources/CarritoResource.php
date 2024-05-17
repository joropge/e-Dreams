<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CarritoResource\Pages;
use App\Filament\Resources\CarritoResource\RelationManagers;
use App\Models\Carrito;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CarritoResource extends Resource
{
    protected static ?string $model = Carrito::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                
                Forms\Components\Select::make('producto_id')
                    ->relationship('producto', 'nombre')
                    ->searchable()
                    ->required(),
                
                Forms\Components\TextInput::make('cantidad')
                    ->min(1)
                    ->required(),
                
                Forms\Components\TextInput::make('precio')
                    ->min(0)
                    ->required(),
                
                Forms\Components\Select::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'pagado' => 'Pagado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->required(),

                    Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->label('Name')
                            ->maxLength(255)
                            ->required(),

                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255)
                            ->required(),

                        // Forms\Components\PasswordInput::make('password')
                        //     ->label('Password')
                        //     ->required(),
                    
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario'),
                Tables\Columns\TextColumn::make('producto.nombre')
                    ->label('Producto'),
                Tables\Columns\TextColumn::make('cantidad')
                    ->label('Cantidad'),
                Tables\Columns\TextColumn::make('precio')
                    ->label('Precio'),
                Tables\Columns\TextColumn::make('estado')
                    ->label('Estado'),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCarritos::route('/'),
            'create' => Pages\CreateCarrito::route('/create'),
            'edit' => Pages\EditCarrito::route('/{record}/edit'),
        ];
    }
}
