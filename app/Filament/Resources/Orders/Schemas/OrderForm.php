<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user.name')
                    ->label('Nome do usuario')
                    ->required(),

                TextInput::make('name')
                    ->label('Nome do Produto')
                    ->required(),

                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('Pendente'),

                TextInput::make('price')
                    ->label('Preço')
                    ->numeric()
                    ->required()
                    ->prefix('R$'),

                FileUpload::make('image_url')
                    ->label('Foto do Produto')
                    ->image()
                    ->directory('products')
                    ->disk('public'),

            ]);
    }
}
