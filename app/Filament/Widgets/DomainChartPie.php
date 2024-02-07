<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DomainChartPie extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [0, 10, 5],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar'],
        ];
    }
    protected function getType(): string
    {
        return 'bar';
    }
}
