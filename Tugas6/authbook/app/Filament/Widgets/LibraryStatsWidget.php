<?php

namespace App\Filament\Widgets;

use App\Models\Author;
use App\Models\Book;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LibraryStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Books', Book::count())
                ->description('All books in the library')
                ->icon('heroicon-o-book-open'),
            Stat::make('Total Authors', Author::count())
                ->description('Registered authors')
                ->icon('heroicon-o-user-group'),
            Stat::make('Available Books', Book::where('status', 'available')->count())
                ->color('success')
                ->icon('heroicon-o-check-circle'),
            Stat::make('Borrowed Books', Book::where('status', 'borrowed')->count())
                ->color('warning')
                ->icon('heroicon-o-clock'),
        ];
    }
}
