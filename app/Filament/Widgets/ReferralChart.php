<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ReferralChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'referralChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Источники переходов';

    protected static ?int $sort = 5;

    protected int|string|array $columnSpan = 'full';

    /**
     * Фильтр по датам
     */
    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('date_start')
                ->label('Дата начала')
                ->nullable() // Можно оставить пустым
                ->reactive()
                ->afterStateUpdated(fn () => $this->updateChartOptions()),

            DatePicker::make('date_end')
                ->label('Дата окончания')
                ->nullable() // Можно оставить пустым
                ->reactive()
                ->afterStateUpdated(fn () => $this->updateChartOptions()),
        ];
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $yourDomain = config('app.url');

        // Получаем значения фильтров (могут быть NULL)
        $dateStart = $this->filterFormData['date_start'] ?? null;
        $dateEnd = $this->filterFormData['date_end'] ?? null;

        // Запрос в БД
        $query = DB::table('analytics')
            ->selectRaw("
                CASE
                    WHEN referrer LIKE '%$yourDomain%' THEN 'Внутренние переходы'
                    WHEN referrer LIKE '%google.%' THEN 'Google'
                    WHEN referrer LIKE '%yandex.%' THEN 'Yandex'
                    WHEN referrer LIKE '%bing.%' THEN 'Bing'
                    WHEN referrer LIKE '%facebook.%' THEN 'Facebook'
                    WHEN referrer LIKE '%instagram.%' THEN 'Instagram'
                    WHEN referrer LIKE '%twitter.%' THEN 'Twitter'
                    WHEN referrer IS NULL OR referrer = '' THEN 'Прямые заходы'
                    ELSE 'Другие сайты'
                END as source, COUNT(*) as count
            ")
            ->groupBy('source')
            ->orderByDesc('count');

        // Если фильтры не пустые, применяем whereBetween
        if ($dateStart && $dateEnd) {
            $query->whereBetween('created_at', [$dateStart, $dateEnd]);
        }

        $data = $query->get()->pluck('count', 'source')->toArray();

        if (empty($data)) {
            $data = ['Нет данных' => 1];
        }

        $labels = array_keys($data);
        $series = array_values($data);

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 400,
            ],
            'series' => [[
                'name' => 'Переходы',
                'data' => $series,
            ]],
            'xaxis' => [
                'categories' => $labels,
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'plotOptions' => [
                'bar' => [
                    'horizontal' => true,
                    'borderRadius' => 5,
                ],
            ],
            'colors' => ['#FF3B30', '#34C759', '#007AFF', '#FF9500', '#8E44AD', '#C7C7CC'],
        ];
    }
}
