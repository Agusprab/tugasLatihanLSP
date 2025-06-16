<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Transaction;
use App\Models\Item;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [


            Stat::make('Total Item', Item::count())->icon('heroicon-o-cube'),

            Stat::make('Total Transaksi', Transaction::count())->icon('heroicon-o-cube'),
            Stat::make('Total Sales', Sale::count())->icon('heroicon-o-user'),
            Stat::make('Total Customer', Customer::count())->icon('heroicon-o-user-circle'),
        ];
    }
}
