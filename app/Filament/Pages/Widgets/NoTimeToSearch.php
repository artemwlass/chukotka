<?php

namespace App\Filament\Pages\Widgets;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class NoTimeToSearch extends BaseWidget
{
    protected static ?string $heading = 'Заявки с формы- нет времени на поиск';

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\NoTimeToSearch::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->label('ФИО')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Телефон')
                    ->copyable()
                    ->searchable()
                    ->icon('heroicon-m-phone'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Дата заявки')
            ]);
    }
}
