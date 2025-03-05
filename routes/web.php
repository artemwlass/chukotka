<?php

use App\Http\Middleware\Analytic;
use App\Http\Middleware\SetLocale;
use App\Livewire\About;
use App\Livewire\Blog;
use App\Livewire\BookingPage;
use App\Livewire\Contact;
use App\Livewire\Index;
use App\Livewire\Policy;
use App\Livewire\Post;
use App\Livewire\Tour;
use App\Livewire\Tours;
use App\Livewire\UserAgreement;
use Illuminate\Support\Facades\Route;

Route::middleware([SetLocale::class, Analytic::class])->group(function () {
    $locale = request()->segment(1);

    Route::prefix($locale === 'en' ? 'en' : '')->group(function () {
        Route::get('/', Index::class)->name('index');
        Route::get('/contact', Contact::class)->name('contact');
        Route::get('/about', About::class)->name('about');
        Route::get('blog/{slug}', Post::class)->name('post');
        Route::get('tour/{slug}', Tour::class)->name('tour');
        Route::get('/blog', Blog::class)->name('blog');
        Route::get('/tours', Tours::class)->name('tours');
        Route::get('/private-policy', Policy::class)->name('private-policy');
        Route::get('/user-agreement', UserAgreement::class)->name('user-agreement');
        Route::get('booking-page', BookingPage::class)->name('booking-page');
    });
});
