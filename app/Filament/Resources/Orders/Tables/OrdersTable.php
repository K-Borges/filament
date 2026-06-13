<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('user.name')
                    ->label('Cliente')
                    ->sortable(),

                TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pendente',
                        'paid' => 'Pago',
                        'cancelled' => 'Cancelado',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'paid' => 'success',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('total_price')
                    ->label('Preço total do pedido')
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Pedido feito em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Pedido atualizado em')
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
                        ->tooltip('Editar pedido')
                        ->modal()
                        ->modalWidth('5xl'),
                    DeleteAction::make()
                        ->label('Excluir')
                        ->tooltip('Excluir pedido')
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
