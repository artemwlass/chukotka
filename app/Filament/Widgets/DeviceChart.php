<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class DeviceChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'deviceChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Устройства';

    protected static ?int $sort = 4;

    /**
     * Фильтр по датам
     */
    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('date_start')
                ->label('Дата начала')
                ->nullable() // Можно оставить пустым
                ->reactive(),

            DatePicker::make('date_end')
                ->label('Дата окончания')
                ->nullable() // Можно оставить пустым
                ->reactive(),
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
        // Получаем значения фильтров (могут быть NULL)
        $dateStart = $this->filterFormData['date_start'] ?? null;
        $dateEnd = $this->filterFormData['date_end'] ?? null;

        // Запрос в БД
        $query = DB::table('analytics')
            ->selectRaw("
                SUM(CASE WHEN device = 'desktop' THEN 1 ELSE 0 END) as desktop,
                SUM(CASE WHEN device = 'mobile' THEN 1 ELSE 0 END) as mobile,
                SUM(CASE WHEN device = 'tablet' THEN 1 ELSE 0 END) as tablet
            ");

        // Если фильтры не пустые, применяем whereBetween
        if ($dateStart && $dateEnd) {
            $query->whereBetween('created_at', [$dateStart, $dateEnd]);
        }

        $deviceData = $query->first();

        // Данные для графика
        $series = [
            (int) ($deviceData->desktop ?? 0),
            (int) ($deviceData->mobile ?? 0),
            (int) ($deviceData->tablet ?? 0)
        ];
        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => $series,
            'labels' => ['ПК', 'Телефон', 'Планшет'],
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
}
