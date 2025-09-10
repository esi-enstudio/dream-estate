<?php

namespace App\Livewire\Homepage;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Tenant;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PropertySearchForm extends Component
{
//    #[Computed(cache: true)]
//    public function allAreas()
//    {
//        return Property::select('address_area')->distinct()->whereNotNull('address_area')->orderBy('address_area')->pluck('address_area');
//    }

    #[Computed(cache: true)]
    public function allPropertyTypes()
    {
        return PropertyType::all(['id', 'name_bn', 'name_en']);
    }

    #[Computed(cache: true)]
    public function allTenantTypes()
    {
        return Tenant::all(['id', 'name']);
    }

    public function render()
    {
        return view('livewire.homepage.property-search-form');
    }
}
