<?php

namespace App\Filament\Widgets;

use App\Models\Investor;
use App\Models\Supplier;
use Filament\Widgets\BarChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class SupplierChart extends BarChartWidget
{
    protected static ?string $heading = 'Supplier';

    protected static ?int $sort=3;


    protected function getData(): array
    {
        $data = Trend::model(Supplier::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Suppliers',
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
