<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelPackageTools\Concerns\Package\HasTranslations;

class ContactPage extends Model
{
    use \Spatie\Translatable\HasTranslations;

    public $translatable = [
        'seo',
    ];
    protected $guarded = false;
    protected $casts = [
        'seo' => 'array',
        'content' => 'array',
    ];
}
