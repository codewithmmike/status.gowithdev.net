<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Domain;

class DomainChartStat extends BaseWidget
{
    public $listdomain;

    protected function getStats(): array
    {

        return [
            Stat::make('Total domain', Domain::count())
            ->description('domains')
            ->descriptionIcon('heroicon-m-chart-pie')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('warning'),
            Stat::make('Live domain amount', Domain::count())
            ->description('domains')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('success'),
            Stat::make('Die domain amount', Domain::count())
            ->description('domains')
            ->descriptionIcon('heroicon-m-arrow-trending-down')
            ->chart([7, 2, 10, 3, 15, 4, 17])
            ->color('danger'),
        ];
    }

    public static function canView(): bool
    {
        return auth()->check() && auth()->user()->role == 'ADMIN';
    }
}
