<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class Metricas extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Clientes', User::count())
            ->description('Clientes cadastrados')
                ->descriptionIcon('heroicon-o-users')

            ->color('info'),

            Stat::make(
                'Estoque Total',
                number_format(Product::sum('stock'))
            )
                ->description('Produtos em Estoque')
                ->descriptionIcon('heroicon-o-cube')

            ->color('warning'),

            Stat::make(

                'Faturamento',
                'R$ ' . number_format(
                    Order::sum('total_amount'),
                    2,
                    ',',
                    '.'
                )
            )
                ->descriptionIcon('heroicon-o-banknotes')
                ->description('Faturamento total')

            ->color('success'),

            Stat::make('Pedidos', Order::count())
                ->description('Número de pedidos')
                ->descriptionIcon('heroicon-o-shopping-cart')
                ->color('danger'),


        ];
    }
}
