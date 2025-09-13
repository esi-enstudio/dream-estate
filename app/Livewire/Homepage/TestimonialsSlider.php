<?php

namespace App\Livewire\Homepage;

use App\Models\Testimonial;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TestimonialsSlider extends Component
{
    #[Computed(cache: true, key: 'homepage-testimonials')]
    public function testimonials(): Collection
    {
        return Testimonial::query()
            ->where('is_active', true)

            // ★★★★★ মূল সর্টিং লজিকটি এখানে ★★★★★
            // ধাপ ১: যেগুলোর sort_order > 0 আছে, সেগুলোকে সবার উপরে নিয়ে আসুন
            ->orderByRaw('sort_order = 0 ASC')

            // ধাপ ২: সেই ম্যানুয়ালি অর্ডার করা আইটেমগুলোকে তাদের নিজেদের মধ্যে সাজান
            ->orderBy('sort_order', 'asc')

            // ধাপ ৩: বাকি সব আইটেমকে (যাদের sort_order = 0) রেটিং অনুযায়ী সাজান
            ->orderBy('rating', 'desc')

            ->get();
    }
    public function render(): Factory|View|Application
    {
        return view('livewire.homepage.testimonials-slider');
    }
}
