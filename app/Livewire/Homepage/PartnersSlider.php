<?php

namespace App\Livewire\Homepage;

use App\Models\Partner;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PartnersSlider extends Component
{
    #[Computed(seconds: 8600, cache: true, key: 'homepage-partners')]
    public function partners(): Collection
    {
        return Partner::query()
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.homepage.partners-slider');
    }
}
