<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class BlogPage extends Model
{
    use HasTranslations;

    public $translatable = ['seo', 'title'];
    protected $guarded = false;

    protected $casts = [
        'seo' => 'array',
        'title' => 'array',
    ];
}
