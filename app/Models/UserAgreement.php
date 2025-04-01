<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAgreement extends Model
{
    use \Spatie\Translatable\HasTranslations;

    public $translatable = [
        'seo',
    ];
    protected $guarded = false;

    protected $casts = [
        'seo' => 'array',
        'description' => 'array',
        'title' => 'array',
    ];

}
