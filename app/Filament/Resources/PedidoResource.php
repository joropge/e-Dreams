<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Producto;
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

                    Forms\Components\Select::make('producto_id')
                    ->relationship('producto', 'nombre')
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
                    ->options(\App\Models\Direccion::pluck(DB::raw("CONCAT(calle, ' Nº', numero, ', ', piso, ' ' , puerta , ' ' , codigo_postal, '-> ' , ciudad)"), 'id')->toArray())
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
                    // ->disabled()
                    ->required(),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    // ->disabled()
                    ->required(),

                    Forms\Components\Select::make('estado')
                    ->label('Estado')
                    // ->disabled()
                    ->default('Auto')
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
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('user_id')
                    ->label('Id_Usuario')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('producto_id')
                    ->label('Id_Producto')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('direccion_completa')
                    ->label('Direccion')
                    ->getStateUsing(function ($record) {
                        return $record->direccion->calle . ',  Nº' . $record->direccion->numero . ', ' . $record->direccion->piso . '' . $record->direccion->puerta . ' ' . $record->direccion->codigo_postal . ' ' . $record->direccion->ciudad;
                    })
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('nombreProducto')
                    ->label('Nombre Producto')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('estado')
                    ->label('Estado')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha Creacion')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha Actualizacion')
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
