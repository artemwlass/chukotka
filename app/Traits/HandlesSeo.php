<?php

namespace App\Traits;

use Artesaos\SEOTools\Facades\SEOMeta;

trait HandlesSeo
{
    public function setSeo($model): void
    {
        $locale = app()->getLocale();

        $title = $model->seo['title'] ?? 'Default Title';
        $description = $model->seo['description'] ?? 'Default Description';
        $keywords = $model->seo['keywords'] ?? '';

        SEOMeta::setTitle(__($title));
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keywords);
    }
}
