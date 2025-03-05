<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Widgets\NoTimeToSearch;
use App\Filament\Pages\Widgets\PersonalTour;
use App\Filament\Pages\Widgets\ReservationTours;
use Filament\Pages\Page;

class Applications extends Page
{
    protected static ?string $pluralModelLabel = 'Заявки с форм';
    protected static ?string $title = 'Заявки с форм';
    protected static ?string $navigationLabel = 'Заявки с форм';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.applications';

    protected function getHeaderWidgets(): array
    {
        return [
            NoTimeToSearch::class,
            PersonalTour::class,
            ReservationTours::class,
        ];
    }
}
