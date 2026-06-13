<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()

                        ->modal()
                        ->extraAttributes(['class' => 'hidden']),

                    EditAction::make()
                        ->label('Editar')
                        ->color('primary')
                        ->icon('heroicon-o-pencil-square')
                        ->tooltip('Editar Categoria')
                        ->modal()
                        ->modalWidth('5xl'),
                    DeleteAction::make()
                        ->label('Excluir')
                        ->tooltip('Excluir Categoria')
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
