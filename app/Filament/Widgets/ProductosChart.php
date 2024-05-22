<?php

namespace App\Filament\Widgets;

use App\Models\Producto;
use App\Models\Categoria;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Facades\DB;

class ProductosChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Stock de productos por categoría';

    // protected static ?string $subheading = 'Stock';

    protected function getData(): array
    {
        
        $data = Producto::select(DB::raw('categorias.nombre as categoria, SUM(productos.stock) as total_stock'))
            ->join('categorias', 'productos.categoria_id', '=', 'categorias.id')
            ->groupBy('categorias.nombre')
            ->orderBy('categorias.nombre')
            ->get();

        $labels = $data->pluck('categoria');
        $values = $data->pluck('total_stock');

        return [
            'datasets' => [
                [
                    'label' => 'Stock',
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
