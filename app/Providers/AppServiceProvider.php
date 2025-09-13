<?php

namespace App\Providers;

use App\Models\Faq;
use App\Models\Property;
use App\Models\Review;
use App\Models\ReviewInteraction;
use App\Models\Testimonial;
use App\Observers\FaqObserver;
use App\Observers\PropertyObserver;
use App\Observers\ReviewInteractionObserver;
use App\Observers\ReviewObserver;
use App\Observers\TestimonialObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Property::observe(PropertyObserver::class);
        Review::observe(ReviewObserver::class);
        ReviewInteraction::observe(ReviewInteractionObserver::class);
        Testimonial::observe(TestimonialObserver::class);
        Faq::observe(FaqObserver::class);
    }
}
