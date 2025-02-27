<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class HeaderAndFooter extends Model
{
    use HasTranslations;

    public $translatable = ['footer', 'header'];
    protected $guarded = false;

    protected $casts = [
        'header' => 'array',
        'footer' => 'array',
    ];
}
