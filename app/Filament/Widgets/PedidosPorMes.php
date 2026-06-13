<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PedidosPorMes extends ChartWidget
{
    protected ?string $heading = 'Pedidos Por Mes';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
