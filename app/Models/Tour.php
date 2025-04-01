<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Tour extends Model
{
    use HasTranslations;

    public $translatable = [
        'seo',
        'title',
        'slug',
        'title_1',
        'description',
        'type_logo',
        'tour_specifications',
        'program_capabilities',
        'awaits',
        'take',
        'first_small_block',
        'two_small_block',
        'three_small_block',
        'big_block',
        'price',
        'include'
    ];
    protected $guarded = false;

    protected $casts = [
        'seo' => 'array',
        'title' => 'array',
        'slug' => 'array',
        'title_1' => 'array',
        'type_logo' => 'array',
        'description' => 'array',
        'tour_specifications' => 'array',
        'program_capabilities' => 'array',
        'awaits' => 'array',
        'take' => 'array',
        'first_small_block' => 'array',
        'two_small_block' => 'array',
        'three_small_block' => 'array',
        'big_block' => 'array',
        'recommend' => 'array',
        'galleries' => 'array',
        'images' => 'array',
        'price' => 'array',
        'include' => 'array',
    ];

    public function days(): HasMany
    {
        return $this->hasMany(Day::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
