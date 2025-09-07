<?php

namespace App\Livewire\Property\Rent;

use App\Models\Amenity;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Tenant;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PropertiesPage extends Component
{
    // --- সার্চ এবং সাধারণ ফিল্টার ---
    public string $search = '';
    public string $purpose = '';
    public string $rent_type = '';
    public string $is_negotiable = '';
    public ?int $bedrooms = null;
    public ?int $bathrooms = null;
    public ?int $balconies = null;
    public ?int $size_sqft = null;
    public ?int $rating = null;

    // --- চেকবক্স ফিল্টার (অ্যারে) ---
    public array $propertyTypes = [];
    public array $tenantTypes = [];
    public array $amenities = [];

    // --- বুলিয়ান চেকবক্স (true/false) ---
    public bool $is_featured = false;
    public bool $is_trending = false;
    public bool $is_verified = false;

    // --- প্রাইস রেঞ্জ ---
    public ?int $min_price = null;
    public ?int $max_price = null;

    // --- সর্টিং এবং লোডিং ---
    public string $sort_by = 'score_desc';
    public int $perPage = 10;

    // URL-এ ফিল্টারগুলো দেখানোর জন্য
    protected $queryString = [
        'search' => ['except' => ''],
        'purpose' => ['except' => ''],
        'rent_type' => ['except' => ''],
        'bedrooms' => ['except' => null],
        'propertyTypes' => ['except' => []],
        'amenities' => ['except' => []],
        'rating' => ['except' => null],
        'min_price' => ['except' => null],
        'max_price' => ['except' => null],
        'sort_by' => ['except' => 'score_desc'],
    ];

    public function loadMore(): void
    {
        $this->perPage += 4;
    }

    public function resetFilters(): void
    {
        $this->reset();
        // JS ইভেন্ট পাঠিয়ে স্লাইডার রিসেট করার জন্য
        $this->dispatch('reset-price-slider');
    }

    // --- ফিল্টারের অপশনগুলো ডেটাবেস থেকে আনার জন্য ---

    #[Computed(cache: true)]
    public function allPropertyTypes()
    {
        return PropertyType::withCount('properties')->get();
    }

    #[Computed(cache: true)]
    public function allTenantTypes()
    {
        return Tenant::withCount('properties')->get();
    }

    #[Computed(cache: true)]
    public function allAmenities()
    {
        return Amenity::withCount('properties')->get();
    }

    public function render(): View
    {
        $query = Property::query()->with(['user', 'propertyType'])->where('status', 'active');

        // --- ফিল্টারিং লজিক ---
        $query->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'));
        $query->when($this->purpose, fn($q) => $q->where('purpose', $this->purpose));
        $query->when($this->rent_type, fn($q) => $q->where('rent_type', $this->rent_type));
        $query->when($this->is_negotiable, fn($q) => $q->where('is_negotiable', $this->is_negotiable));
        $query->when($this->bedrooms, fn($q) => $q->where('bedrooms', $this->bedrooms));
        $query->when($this->bathrooms, fn($q) => $q->where('bathrooms', $this->bathrooms));
        $query->when($this->balconies, fn($q) => $q->where('balconies', $this->balconies));
        $query->when($this->size_sqft, fn($q) => $q->where('size_sqft', '>=', $this->size_sqft));
        $query->when($this->rating, fn($q) => $q->where('average_rating', '>=', $this->rating));

        // বুলিয়ান চেকবক্স
        $query->when($this->is_featured, fn($q) => $q->where('is_featured', true));
        $query->when($this->is_trending, fn($q) => $q->where('is_trending', true));
        $query->when($this->is_verified, fn($q) => $q->where('is_verified', true));

        // অ্যারে চেকবক্স (রিলেশনশিপ)
        $query->when($this->propertyTypes, fn($q) => $q->whereIn('property_type_id', $this->propertyTypes));
        $query->when($this->tenantTypes, fn($q) => $q->whereIn('tenant_id', $this->tenantTypes));

        // Amenities (Many-to-Many)
        $query->when($this->amenities, function ($q) {
            $q->whereHas('amenities', function ($subQuery) {
                $subQuery->whereIn('amenity_id', $this->amenities);
            });
        });

        // প্রাইস রেঞ্জ
        $query->when($this->rating, fn($q) => $q->where('average_rating', '>=', $this->rating));
        $query->when($this->min_price, fn($q) => $q->where('rent_price', '>=', $this->min_price));
        $query->when($this->max_price, fn($q) => $q->where('rent_price', '<=', $this->max_price));

        // --- সর্টিং ---
        match ($this->sort_by) {
            'price_asc' => $query->orderBy('rent_price', 'asc'),
            'price_desc' => $query->orderBy('rent_price', 'desc'),
            'date_desc' => $query->orderBy('created_at', 'desc'),
            default => $query->orderBy('score', 'desc')->orderBy('created_at', 'desc'),
        };

        $total_properties_count = $query->clone()->count();
        $properties = $query->take($this->perPage)->get();

        return view('livewire.property.rent.properties-page', [
            'properties' => $properties,
            'totalPropertiesCount' => $total_properties_count,
            'hasMoreProperties' => $properties->count() < $total_properties_count,
        ]);
    }
}
