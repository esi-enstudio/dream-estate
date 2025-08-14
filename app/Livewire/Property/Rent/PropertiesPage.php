<?php

namespace App\Livewire\Property\Rent;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PropertiesPage extends Component
{
    // --- Filter Properties ---
    public $search = '';
    public $city = '';
    public $bedrooms = '';
    public $bathrooms = '';
    public $min_sqft = '';
    public $categories = [];
    public $amenities = [];
    public $min_price = 0;
    public $max_price = 100000;
    public $rating = '';

    // --- Sort Properties ---
    public $sort_by = 'score_desc';

    // --- "Load More" Properties ---
    public int $perPage = 6; // প্রথমে কয়টি আইটেম দেখানো হবে

    // Livewire 3 তে, আপনি সরাসরি public প্রপার্টিতে টাইপ-হিন্ট করতে পারেন।
    // public int $perPage = 6;

    protected $queryString = [
        'search', 'city', 'bedrooms', 'bathrooms', 'min_sqft', 'categories',
        'amenities', 'min_price', 'max_price', 'rating', 'sort_by'
    ];

    /**
     * "Load More" বাটনে ক্লিক করলে এই মেথডটি কল হবে
     */
    public function loadMore(): void
    {
        $this->perPage += 4; // প্রতি ক্লিকে আরও ৬টি আইটেম যোগ হবে
    }

    public function resetFilters(): void
    {
        $this->reset();
    }

    public function render(): Factory|View|Application
    {
        $query = Property::query()->with('user')->where('status', 'active');

        // --- সমস্ত ফিল্টারিং লজিক এখানে অপরিবর্তিত থাকবে ---
        // ... (আগের কোডের ফিল্টারিং অংশটুকু এখানে থাকবে) ...
        $query->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'));
        $query->when($this->city, fn($q) => $q->where('address_city', $this->city));
        // ... ইত্যাদি ...

        // --- সর্টিং লজিকও অপরিবর্তিত থাকবে ---
        match ($this->sort_by) {
            'price_asc' => $query->orderBy('rent_price', 'asc'),
            'price_desc' => $query->orderBy('rent_price', 'desc'),
            'date_desc' => $query->orderBy('created_at', 'desc'),
            default => $query->orderBy('score', 'desc')->orderBy('created_at', 'desc'),
        };

        // --- পেজিনেশনের পরিবর্তে 'take' ব্যবহার করা ---
        // মোট কতগুলো আইটেম আছে তা গণনা করুন (লোড করার আগে)
        $total_properties_count = $query->clone()->count();

        // নির্দিষ্ট সংখ্যক আইটেম নিন
        $properties = $query->take($this->perPage)->get();
//        dd($properties->count());

        return view('livewire.property.rent.properties-page', [
            'properties' => $properties,
            'hasMoreProperties' => $properties->count() < $total_properties_count,
        ]);
    }
}
