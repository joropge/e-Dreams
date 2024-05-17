<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('id')
                    ->label('Id')
                    ->disabled()
                    ->default('Auto'),
                Forms\Components\TextInput::make('nombre')
                    ->label('Nombre')
                    ->required(),

                Forms\Components\TextInput::make('descripcion')
                    ->label('Descripcion')
                    ->required(),

                Forms\Components\TextInput::make('precio')
                    ->label('Precio')
                    ->required(),

                Forms\Components\TextInput::make('stock')
                    ->label('Stock')
                    ->required(),

                Forms\Components\Select::make('categoria_id')
                    ->relationship('categoria', 'nombre')
                    ->searchable()
                    ->options(\App\Models\Categoria::pluck('nombre', 'id')->toArray())
                    ->createOptionForm(function () {
                        return [
                            Forms\Components\TextInput::make('nombre')
                                ->label('Nombre')
                                ->required(),
                            Forms\Components\TextInput::make('descripcion')
                                ->label('Descripcion')
                                ->required(),
                        ];
                    })
                    ->required(),

                //imagen
                Forms\Components\FileUpload::make('imagen')
                    ->label('imagen')
                    ->image()
                    ->required(),

                //imagen2
                Forms\Components\FileUpload::make('imagen2')
                    ->label('imagen2')
                    ->image()
                    ->required(),

                //Talla
                Forms\Components\Select::make('talla')
                    ->searchable()
                    ->options([
                        'XS' => 'XS',
                        'S' => 'S',
                        'M' => 'M',
                        'L' => 'L',
                        'XL' => 'XL',
                    ])
                    ->required(),

                //Color
                Forms\Components\Select::make('color')
                    ->searchable()
                    ->options([
                        'Blanco' => 'Blanco',
                        'Negro' => 'Negro',
                        'Verde' => 'Verde',
                        'Azul' => 'Azul',
                        'Rojo' => 'Rojo',
                        'Amarillo' => 'Amarillo',
                        'Gris' => 'Gris',
                        'Morado' => 'Morado',
                        'Rosa' => 'Rosa',
                        'Naranja' => 'Naranja',
                        'Cyan' => 'Cyan',
                        'Marrón' => 'Marrón',
                        'Multicolor'=> 'Multicolor',
                    ])
                    
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Id')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio')
                    ->money('EUR')
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion'),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric(),
                Tables\Columns\ImageColumn::make('imagen'),
                Tables\Columns\ImageColumn::make('imagen2'),
                Tables\Columns\TextColumn::make('talla')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color'),

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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
