<?php

namespace App\Livewire\Property\Rent;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('layouts.app')]
class PropertiesPage extends Component
{
    // --- Sort Properties ---
    public $sort_by = 'score_desc';

    // --- "Load More" Properties ---
    public int $perPage = 6; // প্রথমে কয়টি আইটেম দেখানো হবে

    // ফিল্টারগুলো সংরক্ষণের জন্য একটি অ্যারে
    public array $filters = [];

    // 'filters-updated' ইভেন্ট শোনার জন্য
    #[On('filters-updated')]
    public function updateFilters($filters): void
    {
        $this->filters = $filters;
        $this->resetPage(); // পেজিনেশন রিসেট করার জন্য (যদি পেজিনেশন ব্যবহার করেন)
    }

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
        $query->when($this->filters['search'] ?? null, fn($q, $search) => $q->where('title', 'like', '%' . $search . '%'));
        $query->when($this->filters['division_id'] ?? null, fn($q, $id) => $q->where('division_id', $id));
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
