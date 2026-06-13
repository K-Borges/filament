<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Actions\Action;

class Login extends BaseLogin
{
    public function getHeading(): string
    {
        return 'Entrar';
    }

    public function getSubheading(): ?string
    {
        return 'Acesse sua conta para continuar';
    }

    protected function getFormActions(): array
    {
        return [
            ...parent::getFormActions(),

            Action::make('register')
                ->label('Criar conta')
                ->url(route('filament.admin.auth.register')),
        ];
    }
}
