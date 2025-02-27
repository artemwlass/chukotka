<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Day extends Model
{
    use HasTranslations;

    public $translatable = [
        'program_capabilities',
        'title',
        'description',
    ];
    protected $guarded = false;

    protected $casts = [
        'program_capabilities' => 'array',
        'title' => 'array',
        'description' => 'array',
    ];
}
