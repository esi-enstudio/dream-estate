<?php

namespace App\Livewire\Homepage;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FeaturedProperties extends Component
{
    /**
     * ডেটাবেস থেকে Featured প্রপার্টিগুলো নিয়ে আসুন
     */
    #[Computed(cache: true, key: 'featured-properties-for-homepage')]
    public function featuredProperties()
    {
        return Property::query()
            ->with(['user', 'propertyType']) // N+1 সমস্যা এড়ানোর জন্য রিলেশনশিপ লোড করুন
            ->where('status', 'active')
            ->where('is_featured', true) // শুধুমাত্র is_featured = true থাকা প্রপার্টিগুলো আনবে
            ->orderBy('score', 'desc') // সেরা স্কোর থাকা ফিচার্ড প্রপার্টিগুলো আগে দেখাবে
            ->take(8) // স্লাইডারে দেখানোর জন্য সর্বোচ্চ ৮টি আইটেম নিন
            ->get()
            ->chunk(2); // আপনার ডিজাইন অনুযায়ী প্রতি স্লাইডে ২টি করে আইটেম দেখানোর জন্য
    }
    public function render(): View|Factory
    {
        return view('livewire.homepage.featured-properties');
    }
}
