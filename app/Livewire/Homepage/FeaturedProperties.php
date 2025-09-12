<?php

namespace App\Livewire\Homepage;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class FeaturedProperties extends Component
{
    // ★★★ ১. public প্রপার্টির ডিফল্ট মান সরিয়ে দিন ★★★
    public string $purpose;
    public array $properties = [];

    /**
     * কম্পোনেন্ট ইনিশিয়ালাইজ করার জন্য mount() মেথড ব্যবহার করুন
     */
    public function mount(string $purpose = 'rent'): void
    {
        $this->purpose = $purpose;
        $this->loadFeaturedProperties();
    }

    /**
     * ডেটাবেস থেকে Featured প্রপার্টিগুলো নিয়ে আসুন
     */
    public function loadFeaturedProperties(): void
    {
        $cacheKey = 'featured-properties-array-' . $this->purpose;

        $this->properties = cache()->remember($cacheKey, 600, function () {
            $propertiesCollection = Property::query()
                ->with(['user', 'propertyType'])
                ->where('status', 'active')
                ->where('is_featured', true)
                ->where('purpose', $this->purpose)
                ->orderBy('score', 'desc')
                ->take(8)
                ->get();

            // ★★★★★ মূল সমাধান: কালেকশনকে অ্যারেতে পরিণত করার সময় ছবির URL যোগ করা ★★★★★
            return $propertiesCollection->map(function ($property) {
                $propertyArray = $property->toArray();
                // প্রতিটি প্রপার্টি অ্যারের মধ্যে thumbnail_url নামে একটি নতুন কী যোগ করুন
                $propertyArray['thumbnail_url'] = $property->getFirstMediaUrl('featured_image', 'thumbnail');
                return $propertyArray;
            })
                ->chunk(2)
                ->toArray();
        });
    }

    public function render(): View|Factory
    {
        return view('livewire.homepage.featured-properties');
    }
}
