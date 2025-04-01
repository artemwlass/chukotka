<?php

namespace App\Filament\Widgets;

use Filament\Forms\Components\DatePicker;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class CountryVisitChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'countryVisitChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Страны';

    protected static ?int $sort = 1;

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
                ->reactive()
        ];
    }

    protected function getOptions(): array
    {

        // Получаем значения фильтров (могут быть NULL)
        $dateStart = $this->filterFormData['date_start'] ?? null;
        $dateEnd = $this->filterFormData['date_end'] ?? null;

        // Запрос в БД
        $query = DB::table('analytics')
            ->selectRaw('country, COUNT(*) as count')
            ->groupBy('country')
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
                ->whereNotIn('country', $topRegions->pluck('country'))
                ->value('count');
        }

        $labels = $topRegions->pluck('country')->toArray();
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
