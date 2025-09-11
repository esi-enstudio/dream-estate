<?php

namespace App\Livewire\Homepage;

use App\Models\PropertyType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PropertyTypeSlider extends Component
{
    /**
     * ডেটাবেস থেকে সমস্ত Property Type নিয়ে আসুন, সংরক্ষিত কাউন্টার ব্যবহার করে
     */
    #[Computed(cache: true, key: 'all-property-types-for-slider-optimized')]
    public function propertyTypes(): Collection
    {
        return PropertyType::query()
            // ★★★★★ মূল পরিবর্তন: সরাসরি সংরক্ষিত কলাম দিয়ে সর্ট করা হচ্ছে ★★★★★
            ->orderBy('properties_count', 'desc')

            // স্লাইডারে দেখানোর জন্য সর্বোচ্চ ৮টি আইটেম নিন
            ->take(8)

            ->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.homepage.property-type-slider');
    }
}
