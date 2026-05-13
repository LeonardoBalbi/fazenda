<?php

namespace App\Filament\Widgets;

use App\Models\PasseiosTuristicos;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PasseiosStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $total     = PasseiosTuristicos::count();
        $liberados = PasseiosTuristicos::where('status', 'liberado')->count();
        $analise   = PasseiosTuristicos::whereIn('status', ['em análise', 'em analise', 'Em análise'])->count();
        $aguardando = PasseiosTuristicos::where('status', 'aguardando')->count();
        $hoje      = PasseiosTuristicos::whereDate('data_chegada', today())->count();

        return [
            Stat::make('Total de Passeios', $total)
                ->description('Todos os registros')
                ->descriptionIcon('heroicon-m-map')
                ->color('primary'),

            Stat::make('Liberados', $liberados)
                ->description('Passeios liberados')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Em Análise', $analise)
                ->description('Aguardando aprovação')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Aguardando', $aguardando)
                ->description('Pendentes de envio')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('info'),

            Stat::make('Chegadas Hoje', $hoje)
                ->description('Passeios chegando hoje')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('gray'),
        ];
    }
}
