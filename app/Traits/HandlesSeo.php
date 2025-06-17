<?php

namespace App\Traits;

use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;

trait HandlesSeo
{
    public function setSeo($model): void
    {
        $locale = app()->getLocale();

        $title = $model->seo['title'] ?? 'Default Title';
        $description = $model->seo['description'] ?? 'Default Description';
        $keywords = $model->seo['keywords'] ?? '';

        $og_title = $model->seo['og_title'] ?? '';
        $og_description = $model->seo['og_description'] ?? '';
        $og_image = $model->seo['og_image'] ?? '';
        $og_type = $model->seo['og_type'] ?? '';
        $og_url = $model->seo['og_url'] ?? '';

        SEOMeta::setTitle(__($title));
        SEOMeta::setDescription($description);
        SEOMeta::addKeyword($keywords);

        OpenGraph::setTitle($og_title);
        OpenGraph::setDescription($og_description);
        OpenGraph::addImage(asset('storage/' . $og_image));
        OpenGraph::setType($og_type);
        OpenGraph::setUrl($og_url);
    }
}
