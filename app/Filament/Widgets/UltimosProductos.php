<?php

namespace App\Filament\Widgets;

use App\Models\Producto;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UltimosProductos extends BaseWidget
{
    protected static ?int $sort = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(Producto::query()->latest()->limit(5)
            )
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
                    ->suffix(' €')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric(),
                Tables\Columns\TextColumn::make('talla')
                    ->searchable(),
                Tables\Columns\TextColumn::make('color'),
            ]);
    }
}
