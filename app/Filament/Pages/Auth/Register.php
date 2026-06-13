<?php

namespace App\Filament\Auth;

use Filament\Actions\Action;
use Filament\Auth\Pages\Register as BaseRegister;

class Register extends BaseRegister
{
    public function getHeading(): string
    {
        return 'Criar Conta';
    }

    public function getSubheading(): ?string
    {
        return 'Cadastre-se para acessar o sistema';
    }
    protected function getFormActions(): array
    {
        return [
            ...parent::getFormActions(),

            Action::make('login')
                ->label('Login')
                ->url(route('filament.admin.auth.login')),
        ];
    }
}
