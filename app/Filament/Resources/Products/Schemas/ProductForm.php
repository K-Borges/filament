<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                               
                TextInput::make('name')
                    ->label('Nome do Produto')
                    ->required(),

                Select::make('category_id')
                    ->label('Categoria')
                    ->relationship('category', 'name')
                    ->required(),
     
                Textarea::make('description')
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->label('Preço')
                    ->numeric()
                    ->prefix('R$')
                    ->required(),

                TextInput::make('stock')
                    ->label('Quantidade em Estoque')
                    ->numeric()
                    ,
                    
                FileUpload::make('image_url')
                ->label('Foto do Produto')
                ->image()
                ->directory('products')
                ->disk('public'),
                
            ]);
    }
}
