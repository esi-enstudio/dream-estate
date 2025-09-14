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
    public string $viewName = 'default'; // ডিফল্ট ভিউ

    /**
     * কম্পোনেন্টটি মাউন্ট হওয়ার সময় পরিসংখ্যানগুলো লোড করুন
     */
    public function mount($viewName = 'default'): void
    {
        $this->viewName = $viewName;
    }

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
        // ভিউ নামের উপর ভিত্তি করে সঠিক Blade ফাইলটি রেন্ডার করুন
        if ($this->viewName === 'about-us-stats') {
            return view('livewire.homepage.partials.about-us-partners');
        }

        return view('livewire.homepage.partners-slider');
    }
}
