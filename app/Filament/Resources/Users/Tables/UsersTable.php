<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email ')
                    ->label('Email')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])

                ->recordUrl(null)

            ->recordAction(ViewAction::class)

            ->actions([
                ActionGroup::make([
                    ViewAction::make()

                        ->modal()
                        ->extraAttributes(['class' => 'hidden']),

                    EditAction::make()
                        ->label('Editar')
                        ->color('primary')
                        ->icon('heroicon-o-pencil-square')
                        ->tooltip('Editar usuário')
                        ->modal()
                        ->modalWidth('5xl'),
                    DeleteAction::make()
                        ->label('Excluir')
                        ->tooltip('Excluir usuário')
                        ->requiresConfirmation()

                        ->color('danger'),
                ])
                    ->icon('heroicon-m-ellipsis-horizontal')
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
