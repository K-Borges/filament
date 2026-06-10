<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class OndeEstaoAsMetricas extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total de Clientes', User::count())
            ->description('Número total de clientes cadastrados no sistema.')
            
            ->color('info'),
            
            Stat::make('Produtos em estoque', Product::count())
            ->description('Número total de produtos disponíveis no catálogo.')
            
            ->color('warning'),

            Stat::make('Faturamento Total', number_format(Order::sum('total_amount'), 2, ',', '.'))
            ->description('Valor total faturado com as vendas.')
            
            ->color('success'),


        ];
    }
}
