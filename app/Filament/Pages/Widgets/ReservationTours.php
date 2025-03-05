<?php

namespace App\Filament\Pages\Widgets;

use App\Models\ReservationTour;
use Carbon\Carbon;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ReservationTours extends BaseWidget
{

    protected static ?string $heading = 'Бронирования';

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(ReservationTour::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('tour.title')
                    ->label('Тур')
                    ->searchable()
                    ->limit(35)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    }),
                TextColumn::make('booking.date_from')
                    ->label('Дата')
                    ->formatStateUsing(fn($record) => Carbon::parse($record->booking->date_from)->translatedFormat('d F Y') . ' ' . __('по') . ' ' .
                        Carbon::parse($record->booking->date_to)->translatedFormat('d F Y') . ' — ' .
                        $record->booking->price . '₽'
                    ),
                TextColumn::make('name')
                    ->label('ФИО')
                    ->searchable(),
                TextColumn::make('count_adults')
                    ->label('Количество взрослых'),
                TextColumn::make('count_child')
                    ->label('Количество детей'),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Телефон')
                    ->searchable(),
                TextColumn::make('comment')
                    ->label('Комментарий')
                    ->limit(35)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();

                        if (strlen($state) <= $column->getCharacterLimit()) {
                            return null;
                        }

                        return $state;
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Дата заявки')
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->form([
                        Grid::make()
                            ->schema([
                                TextInput::make('tour.title')
                                    ->label('Тур'),
                                TextInput::make('booking.date_from')
                                    ->label('Дата')
                                    ->formatStateUsing(fn($record) => Carbon::parse($record->booking->date_from)->translatedFormat('d F Y') . ' ' . __('по') . ' ' .
                                        Carbon::parse($record->booking->date_to)->translatedFormat('d F Y') . ' — ' .
                                        $record->booking->price . '₽'),
                                TextInput::make('name')->label('Имя')->columnSpanFull(),
                                TextInput::make('count_adults')->label('Количество взрослых'),
                                TextInput::make('count_child')->label('Количество детей'),
                                TextInput::make('email')->label('Email'),
                                TextInput::make('phone')->label('Телефон'),
                                Textarea::make('comment')->label('Комментарий')->columnSpanFull(),
                            ])->columns(2),
                    ])
            ], position: ActionsPosition::BeforeColumns);
    }
}
