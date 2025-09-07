<?php

namespace App\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use App\Models\Amenity;
use App\Models\District;
use App\Models\Division;
use App\Models\PropertyType;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

class PropertyFilterSidebar extends Component
{
    // Filter state properties
    public $search = '';
    public $division_id = '';
    public $district_id = '';
    public $upazila_id = '';
    public $union_id = '';
    public $bedrooms = '';
    public $bathrooms = '';
    public $min_sqft = '';
    public $selected_categories = [];
    public $selected_amenities = [];
    public $min_price = 0;
    public $max_price = 100000;
    public $min_rating = '';

    // Data for dropdowns
    public $divisions;
    public $districts = [];
    public $upazilas = [];
    public $unions = [];
    public $propertyTypes;
    public $amenities;

    public function mount(): void
    {
        $this->divisions = Division::all();
        $this->propertyTypes = PropertyType::withCount('properties')->get();
        $this->amenities = Amenity::withCount('properties')->get();
    }

    // Updated hooks for dependent dropdowns
    public function updatedDivisionId($value): void
    {
        $this->districts = District::where('division_id', $value)->get();
        $this->reset('district_id', 'upazila_id', 'union_id');
        $this->applyFilters();
    }

    public function updatedDistrictId($value): void
    {
        $this->upazilas = Upazila::where('district_id', $value)->get();
        $this->reset('upazila_id', 'union_id');
        $this->applyFilters();
    }

    public function updatedUpazilaId($value): void
    {
        $this->unions = Union::where('upazila_id', $value)->get();
        $this->reset('union_id');
        $this->applyFilters();
    }

    // This method will be called whenever any filter property changes.
    public function updated($property): void
    {
        // Avoid re-triggering for dependent dropdowns as they have their own updated methods.
        if (!in_array($property, ['division_id', 'district_id', 'upazila_id'])) {
            $this->applyFilters();
        }
    }

    public function applyFilters(): void
    {
        $filters = [
            'search' => $this->search,
            'division_id' => $this->division_id,
            'district_id' => $this->district_id,
            'upazila_id' => $this->upazila_id,
            'union_id' => $this->union_id,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'min_sqft' => $this->min_sqft,
            'categories' => $this->selected_categories,
            'amenities' => $this->selected_amenities,
            'min_price' => $this->min_price,
            'max_price' => $this->max_price,
            'min_rating' => $this->min_rating,
        ];

        // প্যারেন্ট কম্পোনেন্টে (PropertyList) ইভেন্ট পাঠানো হচ্ছে
        $this->dispatch('filters-updated', $filters);
    }

    public function resetFilters(): void
    {
        $this->reset();
        $this->mount(); // Re-initialize default data
        $this->applyFilters();
    }




    public function render(): Application|View|Factory
    {
        return view('livewire.property-filter-sidebar');
    }
}
