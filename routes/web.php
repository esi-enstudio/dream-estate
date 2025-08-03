<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\HomePage::class)->name('home');
Route::get('/rent/properties', \App\Livewire\Properties\Rent\RentPropertiesPage::class)->name('rent.properties');
