<?php

namespace App\Livewire\Property\Rent;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class PropertyDetailsPage extends Component
{
    public Property $property;

    /**
     * রাউট থেকে সরাসরি Property মডেল গ্রহণ করা হচ্ছে
     *
     * @param Property $property
     * @return void
     */
    public function mount(Property $property): void
    {
        // Laravel রাউট থেকেই মডেলটি খুঁজে এনেছে, তাই নতুন করে খোঁজার দরকার নেই।
        $this->property = $property;

        // এখন আমরা শুধু প্রয়োজনীয় রিলেশনশিপগুলো লোড করব
        $this->property->load([
            'user',
            'propertyType',
//            'floorPlans.media',
            'reviews.user',
            'media',
        ]);
    }

    // SEO-এর জন্য পেজের টাইটেল ডাইনামিকভাবে সেট হবে
    public function getTitle(): string
    {
        return $this->property->title . ' - Basha Bhara';
    }

    public function render(): Application|View|Factory|\Illuminate\View\View
    {
        // সম্পর্কিত প্রপার্টি খোঁজার লজিক
        $relatedProperties = Property::where('status', 'active')
            ->where('id', '!=', $this->property->id)
            ->where(function ($query) {
                $query->where('property_type_id', $this->property->property_type_id)
                    ->orWhere('address_area', $this->property->address_area);
            })
            ->with(['media', 'user']) // পারফরম্যান্সের জন্য রিলেশনশিপ লোড করুন
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('livewire.property.rent.property-details-page', [
            'relatedProperties' => $relatedProperties,
        ]);
    }
}
