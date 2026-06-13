<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Filament\Tables\Columns\TextColumn;

class ProdutosEstoqueBaixo extends TableWidget
{
    protected static ?string $heading = 'Produtos com Estoque Baixo';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Product::query()
                    ->where('stock', '<=', 5)
                    ->orderBy('stock')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Produto'),

                TextColumn::make('stock')
                    ->label('Estoque')
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state == 0 => 'danger',
                        $state <= 3 => 'warning',
                        default => 'success',
                    })

            ]);
    }
}
