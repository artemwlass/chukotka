<?php

namespace App\Filament\Pages\Widgets;

use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PersonalTour extends BaseWidget
{
    protected static ?string $heading = 'Заявки на персональный тур';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\PersonalTour::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Split::make([
                    TextColumn::make('name')
                        ->label('ФИО')
                        ->searchable(),
                    Stack::make([
                        TextColumn::make('phone')
                            ->copyable()
                            ->icon('heroicon-m-phone'),
                        TextColumn::make('email')
                            ->copyable()
                            ->icon('heroicon-m-envelope'),
                    ]),
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->label('Дата заявки')
                ]),
                TextColumn::make('comment')
                    ->label('Комментарий'),

            ]);
    }
}
