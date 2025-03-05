<?php

namespace App\Filament\Widgets;

use App\Models\Analytic;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Facades\DB;

class PopularPage extends BaseWidget
{
    protected static ?string $heading = 'Популярные страницы';

    protected static ?int $sort = 6;

    protected int|string|array $columnSpan = 'full';


    public function table(Table $table): Table
    {
        return $table
            ->query(
                Analytic::query()
                    ->select(
                        DB::raw('MIN(id) as id'),
                        'url',
                        DB::raw('COUNT(*) as views'),
                        DB::raw('COUNT(DISTINCT ip) as visitors'),

                        DB::raw("ROUND(SUM(CASE WHEN device = 'desktop' THEN 1 ELSE 0 END) / COUNT(*) * 100, 0) as desktop_percent"),
                        DB::raw("ROUND(SUM(CASE WHEN device = 'mobile' THEN 1 ELSE 0 END) / COUNT(*) * 100, 0) as mobile_percent"),
                        DB::raw("ROUND(SUM(CASE WHEN device = 'tablet' THEN 1 ELSE 0 END) / COUNT(*) * 100, 0) as tablet_percent")
                    )
                    ->groupBy('url')
                    ->orderByDesc('views')
            )
            ->columns([
                Tables\Columns\TextColumn::make('url')
                    ->label('Страница')
                    ->searchable(),
                Tables\Columns\TextColumn::make('views')
                    ->label('Просмотры')
                    ->sortable(),
                Tables\Columns\TextColumn::make('visitors')
                    ->label('Посетители')
                    ->sortable(),

                Tables\Columns\TextColumn::make('desktop_percent')
                    ->label('ПК / Телефон / Планшет (%)')
                    ->sortable()
                    ->formatStateUsing(fn ($record) =>
                    $record->desktop_percent .'% / ' . $record->mobile_percent . '% / ' . $record->tablet_percent .'%'
                    ),

            ])
            ->filters([
                Filter::make('date_range')
                    ->form([
                        DatePicker::make('date_start')
                            ->label('Дата начала')
                            ->default(null),

                        DatePicker::make('date_end')
                            ->label('Дата окончания')
                            ->default(null),
                    ])
                    ->query(function ($query, array $data) {
                        if (!empty($data['date_start']) && !empty($data['date_end'])) {
                            $query->whereBetween('created_at', [$data['date_start'], $data['date_end']]);
                        }
                    })
            ]);

    }
}
