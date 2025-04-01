<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Concerns\Package\HasTranslations;

class AboutPage extends Model
{
    use \Spatie\Translatable\HasTranslations;

    public $translatable = [
        'seo',
    ];

    protected $guarded = false;

    protected $casts = [
      'seo' => 'array',
      'title' => 'array',
      'partner' => 'array',
      'card_organization' => 'array',
      'title_2' => 'array',
      'first_block' => 'array',
      'two_block' => 'array',
      'three_block' => 'array',
      'four_block' => 'array',
      'description' => 'array',
      'header_description' => 'array',
    ];
}
