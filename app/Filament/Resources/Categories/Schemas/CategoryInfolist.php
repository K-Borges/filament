<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')
                ->label("Nome"),
                TextEntry::make('created_at')
                ->label("Criada em")
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                ->label("Atualizada em")
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                ->label("deletada em (lixeira q faltou eu colocar)")
                    ->dateTime()
                    ->visible(fn (Category $record): bool => $record->trashed()),
            ]);
    }
}
