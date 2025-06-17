<?php

namespace App\Livewire\Components;

use App\Models\AboutPage;
use App\Models\BlogPage;
use App\Models\ContactPage;
use App\Models\Policy;
use App\Models\Post;
use App\Models\Tour;
use App\Models\UserAgreement;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Search extends Component
{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            return;
        }

        $language = App::getLocale(); // Получаем текущий язык пользователя
        $query = mb_strtolower($this->query);

        $this->results = [];

        // Массив моделей и полей для поиска
        $models = [
            AboutPage::class => ['title', 'partner', 'card_organization', 'title_2', 'first_block', 'two_block', 'three_block', 'four_block', 'description', 'header_description'],
            BlogPage::class => ['title'],
            ContactPage::class => ['content'],
            Policy::class => ['description', 'title'],
            Post::class => ['tags', 'recommend', 'title', 'description', 'description_2', 'author'],
            Tour::class => ['title', 'title_1', 'description', 'tour_specifications', 'program_capabilities', 'awaits', 'take', 'first_small_block', 'two_small_block', 'three_small_block', 'big_block', 'price', 'include'],
            UserAgreement::class => ['description', 'title'],
        ];

        foreach ($models as $model => $fields) {
            $queryResults = $model::query()
                ->where(function ($q) use ($fields, $query, $language) {
                    foreach ($fields as $field) {
                        // Проверяем, является ли поле JSON, если да — извлекаем нужный язык
                        $q->orWhere(DB::raw("LOWER(JSON_UNQUOTE(JSON_EXTRACT($field, '$.$language')))"), 'like', "%$query%");
                    }
                })
                ->limit(5) // Ограничиваем количество результатов
                ->get();

            if ($model === Tour::class) {
                $queryResults = $queryResults->where('is_active', 1);
            }

            foreach ($queryResults as $item) {
                // Извлекаем локализованный заголовокdd($item);
                $title = $this->extractLocalizedField($item, 'title', $language);
                $description = $this->extractLocalizedField($item, 'description', $language);

                // Получаем slug, если он есть
                $slug = $item->slug ?? null;

                // Формируем URL на основе типа модели
                $url = $this->generateModelUrl($item, $slug);

                $this->results[] = [
                    'title' => $title ?: ($description ?: 'No Title'),
                    'url' => $url, // Здесь можно добавить ссылку на детальную страницу
                ];
            }
        }
    }

    /**
     * Извлекаем строку из JSON-поля в зависимости от языка.
     *
     * @param object $item
     * @param string $field
     * @param string $language
     * @return string|null
     */
    private function extractLocalizedField($item, $field, $language)
    {
        if (!isset($item->$field)) {
            return null;
        }

        $data = $item->$field;

        // Если поле уже строка — возвращаем как есть
        if (is_string($data)) {
            return $data;
        }

        // Если это JSON (массив), ищем нужный язык
        if (is_array($data) || is_object($data)) {
            $data = (array) $data;
            return $data[$language] ?? reset($data); // Если языка нет, берем первый доступный
        }

        return null;
    }

    private function generateModelUrl($item, $slug)
    {

        return match (get_class($item)) {
            Post::class => route('post', ['slug' => $slug]),
            Tour::class => route('tour', ['slug' => $slug]),
            BlogPage::class => route('blog'),
            AboutPage::class => route('about'),
            ContactPage::class => route('contact'),
            Policy::class => route('private-policy'),
            UserAgreement::class => route('user-agreement'),
            default => '#',
        };
    }


    public function render()
    {
        return view('livewire.components.search');
    }
}
