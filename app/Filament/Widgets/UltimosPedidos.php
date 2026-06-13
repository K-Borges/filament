<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;

class UltimosPedidos extends TableWidget
{
    protected static ?string $heading = 'Últimos Pedidos';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Order::query()->latest()
            )
            ->columns([
                TextColumn::make('id')
                    ->label('Pedido'),

                TextColumn::make('user.name')
                    ->label('Cliente'),

                TextColumn::make('status')
                    ->badge(),

                TextColumn::make('created_at')
                    ->date('d/m/Y'),
            ]);
    }
}
