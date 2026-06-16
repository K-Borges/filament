<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\Metricas;
use App\Filament\Widgets\ProdutosEstoqueBaixo;
use App\Filament\Widgets\UltimosPedidos;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class Dashboard extends Page
{
    protected string $view = 'filament.pages.dashboard';

    protected static ?string $title = 'Visão Geral';
    protected static ?string $navigationLabel = 'Visão Geral';
    protected static ?int $navigationSort = 0;
    protected static string|null|\BackedEnum $navigationIcon =
        Heroicon::OutlinedChartBar;
    public function getHeaderWidgets(): array{
      return [
          Metricas::class,
          ProdutosEstoqueBaixo::class,
          UltimosPedidos::class,

      ];}
    public function getHeaderWidgetsColumns(): int|array
    {
        return [
            'md' => 2,
            'xl' => 2,
        ];
    }
    public function getSubheading(): ?string
    {
        return 'Acompanhe os principais indicadores do negócio.';
    }

}
