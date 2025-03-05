<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class RegionVisitChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'regionVisitChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Регионы';

    protected static ?int $sort = 2;

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
        // Получаем значения фильтров (могут быть NULL)
        $dateStart = $this->filterFormData['date_start'] ?? null;
        $dateEnd = $this->filterFormData['date_end'] ?? null;

        // Запрос в БД
        $query = DB::table('analytics')
            ->selectRaw('region, COUNT(*) as count')
            ->groupBy('region')
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
                ->whereNotIn('region', $topRegions->pluck('region'))
                ->value('count');
        }

        $labels = $topRegions->pluck('region')->toArray();
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
