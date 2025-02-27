<?php

namespace App\Models;

use App\Filament\Resources\TourResource;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Post extends Model
{
    use HasTranslations;

    public $translatable = [
        'seo',
        'tags',
        'recommend',
        'title',
        'slug',
        'description',
        'description_2',
        'author',
    ];
    protected $guarded = false;

    protected $casts = [
        'seo' => 'array',
        'tags' => 'array',
        'recommend' => 'array',
        'title' => 'array',
        'slug' => 'array',
        'description' => 'array',
        'description_2' => 'array',
        'author' => 'array',
    ];

    public function recommend()
    {
        return $this->belongsTo(Tour::class, 'recommendation_tour_id');
    }
}
