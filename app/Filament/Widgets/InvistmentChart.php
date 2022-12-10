<?php

namespace App\Filament\Widgets;

use App\Models\Investment;
use App\Models\Purchase;
use Filament\Widgets\LineChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class InvistmentChart extends LineChartWidget
{
    protected static ?string $heading = 'Investments';

    protected static ?int $sort=2;


    protected function getData(): array
    {
        $data = Trend::model(Investment::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'investments',
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
