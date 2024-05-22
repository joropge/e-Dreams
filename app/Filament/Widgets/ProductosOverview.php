<?php

namespace App\Filament\Widgets;

use App\Models\Producto;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\ChartWidget;

class ProductosOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count())
                ->description('All Users')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Productos', Producto::count())
                ->description('Todos los productos')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger'),
            Stat::make('Stock', Producto::sum('stock'))
                ->description('Stock total')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),

        ];
    }
}
