<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Home extends Model
{
    use HasTranslations;

    public $translatable = [
        'seo',
    ];

    protected $guarded = false;

    protected $casts = [
      'seo' => 'array',
      'title' => 'array',
      'option' => 'array',
      'personal_tour' => 'array',
      'about_company' => 'array'
    ];
}
