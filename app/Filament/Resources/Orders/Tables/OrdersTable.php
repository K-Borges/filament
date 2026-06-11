<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
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
                    ->sortable()
                    ,
                    TextColumn::make('status')
                        ->searchable(),
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

                ViewAction::make()
                ->modal()
                ->extraAttributes(['class' => 'hidden']),

                DeleteAction::make()
                ->label('Excluir')
                ->requiresConfirmation()
                ->color('danger'),
                
                EditAction::make()
                ->label('Editar')
                ->color('primary')
                ->icon('heroicon-o-pencil-square')
                ->tooltip('Editar este produto')
                ->modal()
                ->modalWidth('5xl'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
