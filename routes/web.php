<?php

use App\Livewire\HomePage;
use App\Livewire\PricingPage;
use App\Livewire\Property\Rent\PropertiesPage;
use App\Livewire\Property\Rent\PropertyDetailsPage;
use Illuminate\Support\Facades\Route;




Route::get('/', HomePage::class)->name('home');

Route::prefix('/rent')
    ->name('listing.')
    ->group(function (){
        Route::get('/properties', PropertiesPage::class)->name('rent');
        Route::get('/property', PropertyDetailsPage::class)->name('details');
});

Route::get('/pricing', PricingPage::class)->name('pricing');
