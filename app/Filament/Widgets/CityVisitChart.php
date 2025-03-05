<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class CityVisitChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'cityVisitChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Города';

    protected static ?int $sort = 3;

    /**
     * Фильтр по датам
     */
    protected function getFormSchema(): array
    {
        return [
            DatePicker::make('date_start')
                ->label('Дата начала')
                ->nullable() // Позволяем оставить пустым
                ->reactive(),

            DatePicker::make('date_end')
                ->label('Дата окончания')
                ->nullable() // Позволяем оставить пустым
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
            ->selectRaw('city, COUNT(*) as count')
            ->groupBy('city')
            ->orderByDesc('count');

        // Если фильтры не пустые, применяем whereBetween
        if ($dateStart && $dateEnd) {
            $query->whereBetween('created_at', [$dateStart, $dateEnd]);
        }

        $topRegions = $query->limit(9)->get();

        // Считаем "Остальные" (если фильтр включен)
        $otherRegionsCount = 0;
        if ($dateStart && $dateEnd) {
            $otherRegionsCount = DB::table('analytics')
                ->selectRaw('COUNT(*) as count')
                ->whereBetween('created_at', [$dateStart, $dateEnd])
                ->whereNotIn('city', $topRegions->pluck('city'))
                ->value('count');
        }

        $labels = $topRegions->pluck('city')->toArray();
        $series = $topRegions->pluck('count')->toArray();

        if ($otherRegionsCount > 0) {
            $labels[] = 'Остальные';
            $series[] = $otherRegionsCount;
        }

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => $series,
            'labels' => $labels,
            'legend' => [
                'labels' => [
                    'fontFamily' => 'inherit',
                ],
            ],
        ];
    }
}
