<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Nome do cliente'),
                
                TextEntry::make('total_price')
                    ->label('Preço total do pedido')
                    ->money('BRL'),

                TextEntry::make('status'),

                TextEntry::make('created_at')
                    ->label('Criado em:')
                    ->dateTime()
                    ->placeholder('-'),
                    
                TextEntry::make('updated_at')
                    ->label('Editado em:')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
