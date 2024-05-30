<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Actions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use SebastianBergmann\CodeCoverage\Report\Xml\Totals;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'System Managment';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('id')
                    ->searchable()
                    ->disabled()
                    ->default('Auto'),

                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->options(\App\Models\User::pluck('name', 'id')->toArray())
                    ->reactive()
                    ->required(),
                // ->afterStateUpdated(function (callable $get, callable $set) {
                //     $user = \App\Models\Direccion::find($get('user_id'));
                //     if ($user) {
                //         $set('direccion', $user->calle);
                //     }
                // }),

                //producto_id
                Forms\Components\Select::make('producto_id')
                    ->relationship('producto', 'id')
                    ->options(\App\Models\Producto::pluck('id', 'id')->toArray())
                    ->searchable()
                    ->reactive()
                    ->required()
                    ->afterStateUpdated(function (callable $get, callable $set) {
                        $producto = \App\Models\Producto::find($get('producto_id'));
                        if ($producto) {
                            $set('total', $producto->precio);
                            $set('nombreProducto', $producto->nombre);
                        }
                    }),

                Forms\Components\Select::make('direccion_id')
                    ->relationship('direccion', 'calle')
                    ->searchable()
                    ->options(\App\Models\Direccion::pluck('calle', 'id')->toArray())
                    ->createOptionForm(function () {
                        return [
                            Forms\Components\TextInput::make('calle')
                                ->label('Calle')
                                ->required(),
                            Forms\Components\TextInput::make('numero')
                                ->label('Número')
                                ->required(),
                            Forms\Components\TextInput::make('piso')
                                ->label('Piso'),
                            Forms\Components\TextInput::make('puerta')
                                ->label('Puerta'),
                            Forms\Components\TextInput::make('codigo_postal')
                                ->label('Código Postal')
                                ->required(),
                            Forms\Components\TextInput::make('ciudad')
                                ->label('Ciudad')
                                ->required(),
                            Forms\Components\TextInput::make('provincia')
                                ->label('Provincia')
                                ->required(),
                            Forms\Components\TextInput::make('pais')
                                ->label('País')
                                ->required(),
                        ];
                    })
                    ->required(),

                Forms\Components\TextInput::make('nombreProducto')
                    ->label('Nombre Producto')
                    ->disabled()
                    ->required(),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->disabled()
                    ->required(),


                // Forms\Components\Select::make('total')
                //     ->relationship('producto', 'precio')
                //     ->options(function (callable $get) {
                //         $producto_id = $get('producto_id');
                //         $cantidad = 1;
                //         $producto = \App\Models\Producto::find($producto_id);
                //         return $producto ? [$producto->precio * $cantidad => $producto->precio * $cantidad] : [];
                //     })
                //     ->reactive()
                //     ->label('total')
                //     ->required(),

                // Forms\Components\Select::make('nombreProducto')
                //     ->label('Nombre Producto')
                //     ->options(function (callable $get) {
                //         $producto_id = $get('producto_id');
                //         // $nombre = $get('nombreProducto');
                //         $producto = \App\Models\Producto::find($producto_id);
                //         return $producto ? [$producto->nombre => $producto->nombre] : [];
                //     })
                //     ->default('Auto')
                //     ->disabled(),


                Forms\Components\Select::make('estado')
                    ->options([
                        'enviado' => 'Enviado',
                        'pendiente' => 'Pendiente',
                        'pagado' => 'Pagado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->required(),

                Forms\Components\Select::make('created_at')
                    ->label('Fecha de creacion')
                    ->disabled()
                    ->default('Auto'),

                Forms\Components\Select::make('updated_at')
                    ->label('Fecha de actualizacion')
                    ->disabled()
                    ->default('Auto'),
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

                Tables\Columns\TextColumn::make('user.id')
                    ->label('Id_Usuario')
                    ->searchable()
                    ->sortable(),

                //producto_id
                Tables\Columns\TextColumn::make('producto_id')
                    ->label('Producto_id')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('direccion.calle')
                    ->label('Direccion')
                    ->sortable(),
                Tables\Columns\TextColumn::make('nombreProducto')
                    ->label('Nombre Producto')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->sortable(),
                Tables\Columns\TextColumn::make('estado')
                    ->label('Estado')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creacion')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de actualizacion')
                    ->searchable()
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
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}
