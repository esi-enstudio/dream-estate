<?php

use App\Http\Controllers\PropertyViewController;
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

        Route::post('/property/{property:slug}/track-view', [PropertyViewController::class, 'store'])
            ->name('property.track-view')
            ->middleware('throttle:5,1');
});



Route::get('/pricing', PricingPage::class)->name('pricing');
