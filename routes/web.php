<?php

use App\Http\Controllers\PaymentController;
use App\Livewire\HomePage;
use App\Livewire\PricingPage;
use App\Livewire\Properties\Rent\RentPropertiesPage;
use Illuminate\Support\Facades\Route;




Route::get('/', HomePage::class)->name('home');
Route::get('/rent/properties', RentPropertiesPage::class)->name('rent.properties');
Route::get('/pricing', PricingPage::class)->name('pricing');

Route::get('/pay/{plan:slug}', [PaymentController::class, 'initiatePayment'])->name('payment.initiate')->middleware('auth');

// ShurjoPay return URLs
Route::post('/payment/callback', [PaymentController::class, 'paymentCallback'])->name('payment.callback');
Route::post('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

// A generic dashboard route for redirection after success
Route::get('/dashboard', function () {
    // You can create a proper dashboard later
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
