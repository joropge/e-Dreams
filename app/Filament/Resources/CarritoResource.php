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


class CarritoResource extends Resource
{
    protected static ?string $model = Carrito::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'System Managment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('producto_id')
                    ->label('Producto')
                    ->relationship('producto', 'id')
                    // ->options(\App\Models\Producto::pluck('id', 'id' , 'nombre')->toArray())
                    ->options(
                        \App\Models\Producto::all()
                            ->map(function ($producto) {
                                return [
                                    'value' => $producto->id,
                                    'label' => $producto->id . ' - ' . $producto->nombre,
                                ];
                            })
                            ->pluck('label', 'value')
                            ->toArray()
                    )
                    ->afterStateUpdated(fn (callable $set) => $set('total', null))
                    ->reactive()
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('cantidad')
                    ->label('Cantidad')
                    ->required(),
                Forms\Components\Select::make('totalAmount')
                    ->label('Total a colocar')
                    ->options(function (callable $get) {
                        $producto_id = $get('producto_id');
                        $cantidad = $get('cantidad');
                        $producto = \App\Models\Producto::find($producto_id);
                        if ($producto) {
                            $total = $producto->precio * $cantidad;
                            $formattedTotal = number_format($total, 2);
                            return [$total => $formattedTotal];
                        }
                        return [];
                    })
                    ->reactive(),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.id')
                    ->label('Id_Usuario')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Producto.id')
                    ->label('Id_Producto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->label('Cantidad')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->suffix(' €')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
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
            'index' => Pages\ListCarritos::route('/'),
            'create' => Pages\CreateCarrito::route('/create'),
            'edit' => Pages\EditCarrito::route('/{record}/edit'),
            // 'delete' => Pages::route('/{record}/delete'),
        ];
    }
}
