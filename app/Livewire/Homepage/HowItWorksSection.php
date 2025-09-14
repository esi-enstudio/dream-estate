<?php

namespace App\Livewire\Homepage;

use App\Models\HowItWork;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class HowItWorksSection extends Component
{
    #[Computed(cache: true, key: 'homepage-how-it-works')]
    public function steps(): Collection
    {
        return HowItWork::query()
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->take(3) // дизайনে ৩টি ধাপ দেখানো হয়েছে
            ->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.homepage.how-it-works-section');
    }
}
