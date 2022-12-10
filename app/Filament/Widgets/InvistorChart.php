<?php

namespace App\Filament\Widgets;

use App\Models\Investor;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class InvistorChart extends BarChartWidget
{
    protected static ?string $heading = 'Investors';

    protected static ?int $sort=3;


    protected function getData(): array
    {
        $data = Trend::model(Investor::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'investors',
                    'data' => $data->map(static fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(static fn (TrendValue $value) => $value->date),
       ];
    }

    protected function getFilters(): array|null
    {
        return [
            'today' => 'Today',
            'week' => 'Last week',
            'month' => 'Last month',
            'year' => 'This year',
        ];
    }
}
