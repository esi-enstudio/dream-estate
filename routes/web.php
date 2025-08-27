<?php

use App\Livewire\HomePage;
use App\Livewire\PricingPage;
use App\Livewire\Property\Rent\PropertiesPage;
use App\Livewire\Property\Rent\PropertyDetailsPage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/test-storage', function () {
    try {
        // একটি টেস্ট ফাইল তৈরি করার চেষ্টা করুন
        Storage::disk('public')->put('avatars/test.txt', 'Hello World from Storage Test!');

        // ফাইলটি বিদ্যমান কিনা তা পরীক্ষা করুন
        if (Storage::disk('public')->exists('avatars/test.txt')) {
            return 'Success! File created at storage/app/public/avatars/test.txt';
        } else {
            return 'Failure! File was not created, but no error was thrown.';
        }
    } catch (\Exception $e) {
        // যদি কোনো এরর হয়, সেটি দেখান
        return 'Error: ' . $e->getMessage();
    }
});




Route::get('/', HomePage::class)->name('home');

Route::prefix('/rent')
    ->name('listing.')
    ->group(function (){
        Route::get('/properties', PropertiesPage::class)->name('rent');
        Route::get('/property/{property:slug}', PropertyDetailsPage::class)->name('details');
});

Route::get('/pricing', PricingPage::class)->name('pricing');
