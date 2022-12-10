<?php

namespace App\Filament\Widgets;

use App\Models\Investment;
use App\Models\Investor;
use App\Models\Purchase;
use App\Models\Supplier;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort=1;

    protected function getCards(): array

    {
        return [
            //
            Card::make('Investor',Investor::count()),
            Card::make('suppliers',Supplier::count()),
            Card::make('Purchases',Purchase::count()),
            Card::make('Investments',Investment::count()),

        ];
    }


}
