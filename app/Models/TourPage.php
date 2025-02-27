<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class TourPage extends Model
{
    use HasTranslations;

    public $translatable = [
        'seo',
    ];
    protected $guarded = false;

    protected $casts = [
        'seo' => 'array',
        'title' => 'array',
    ];
}
