<?php

use App\Http\Controllers\PostViewController;
use App\Http\Controllers\PropertyViewController;
use App\Livewire\AboutUsPage;
use App\Livewire\Blog\DetailsPage;
use App\Livewire\Blog\IndexPage;
use App\Livewire\ContactUsPage;
use App\Livewire\FaqPage;
use App\Livewire\HomePage;
use App\Livewire\PricingPage;
use App\Livewire\Property\Rent\PropertiesPage;
use App\Livewire\Property\Rent\PropertyDetailsPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', HomePage::class)->name('home');

Route::prefix('/rent')
    ->name('listing.')
    ->group(function (){
        Route::get('/properties', PropertiesPage::class)->name('rent');
        Route::get('/property/{property:slug}', PropertyDetailsPage::class)->name('details');

        Route::post('/properties/{property}/increment-view', [PropertyViewController::class, 'increment'])
            ->name('increment-view');
});


Route::prefix('/blog')
    ->name('blog.')
    ->group(function (){
        Route::get('/list', IndexPage::class)->name('index');
        Route::get('/details/{post:slug}', DetailsPage::class)->name('details');

        Route::post('/posts/{post}/increment-view', [PostViewController::class, 'increment'])
            ->name('increment-view');
    });



Route::get('/about-us', AboutUsPage::class)->name('about.us');
Route::get('/contact-us', ContactUsPage::class)->name('contact.us');
Route::get('/pricing', PricingPage::class)->name('pricing');
Route::get('/faq', FaqPage::class)->name('faq');
