<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nome')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                FileUpload::make('image_url')
                    ->label('Foto do Usuario')
                    ->image()
                    ->directory('users')
                    ->disk('public'),
                TextInput::make('password')
                    ->label('Senha')

                    ->password()
                    ->required(),
            ]);
    }
}
