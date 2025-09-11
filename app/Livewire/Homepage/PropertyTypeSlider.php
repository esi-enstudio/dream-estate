<?php

namespace App\Livewire\Homepage;

use App\Models\PropertyType;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\App\Models\_IH_PropertyType_QB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PropertyTypeSlider extends Component
{
    /**
     * ডেটাবেস থেকে Property Type গুলো নিয়ে আসুন
     * শুধুমাত্র সেইগুলোই আনা হবে যেগুলোর সাথে কমপক্ষে একটি প্রপার্টি যুক্ত আছে
     */
    #[Computed(cache: true, key: 'property-types-for-slider')]
    public function propertyTypes(): Collection|Builder|_IH_PropertyType_QB
    {
        return PropertyType::query()
            ->whereHas('properties') // নিশ্চিত করে যে শুধুমাত্র ব্যবহৃত টাইপগুলোই আসবে
            ->withCount('properties') // 'properties_count' নামে একটি কলাম যোগ করে
            ->orderBy('properties_count', 'desc') // সবচেয়ে বেশি প্রপার্টি থাকা টাইপগুলো আগে দেখাবে
            ->take(8) // স্লাইডারে দেখানোর জন্য সর্বোচ্চ ৮টি আইটেম নিন
            ->get();
    }

    public function render(): View|Factory
    {
        return view('livewire.homepage.property-type-slider');
    }
}
