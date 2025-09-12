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
            ->orderBy('sort_order', 'asc')
            ->get();
    }
    public function render(): Factory|View|Application
    {
        return view('livewire.homepage.testimonials-slider');
    }
}
