<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;


class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                ->label('Nome do Produto:')
                ->placeholder('-'),

                TextEntry::make('description')
                    ->label('Descrição:')
                    ->placeholder('-')
                    ->columnSpanFull(),

                TextEntry::make('price')
                ->label('Preço:')
                    ->money('BRL'),

                TextEntry::make('stock')
                    ->label('Quantidade em Estoque:')
                    ->numeric(),

                ImageEntry::make('image_url')
                    ->label('Foto:')
                    ->disk('public')
                    ->placeholder('-'),

                TextEntry::make('category.name')
                    ->label('Categoria:')
                    ->placeholder('-'),

                TextEntry::make('created_at')
                    ->label('Criado em:')
                    ->dateTime()
                    ->placeholder('-'),
                

                TextEntry::make('updated_at')
                    ->dateTime()
                    ->label('Atualizado em:')
                    ->placeholder('-'),
            ]);
    }
}
