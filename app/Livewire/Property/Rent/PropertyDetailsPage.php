<?php

namespace App\Livewire\Property\Rent;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
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
            'amenities',
            'reviews.user',
            'media',
        ]);
    }

    /**
     * JavaScript থেকে 'increment-view-count' ইভেন্টটি শোনার জন্য এই মেথডটি তৈরি করা হয়েছে
     */
    #[On('increment-view-count')]
    public function incrementViewCount(): void
    {
        // সেশন কী তৈরি করুন, যাতে প্রতিটি প্রপার্টির জন্য আলাদাভাবে ট্র্যাক করা যায়
        $viewedKey = 'property_viewed_' . $this->property->id;

        // যদি এই সেশনে এই প্রপার্টিটি ইতিমধ্যে ভিউ করা না হয়ে থাকে
        if (!Session::has($viewedKey)) {
            // ★★★ এখন এখানে ভিউ কাউন্ট বৃদ্ধি করা হচ্ছে ★★★
            $this->property->increment('views_count');

            // সেশনে এই প্রপার্টিটিকে "ভিউ করা হয়েছে" হিসেবে চিহ্নিত করুন
            Session::put($viewedKey, true);
        }
    }

    /**
     * সম্পর্কিত প্রপার্টিগুলো দেখানোর জন্য (Computed Property)
     */
    #[Computed]
    public function relatedProperties(): Collection
    {
        return Property::with(['media', 'user'])
            ->where('status', 'active')
            ->where('id', '!=', $this->property->id) // বর্তমান প্রপার্টি বাদে
            ->where('property_type_id', $this->property->property_type_id) // একই ক্যাটাগরির
            ->orWhere('address_area', $this->property->address_area) // অথবা একই শহরের
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    public function render(): Application|View|Factory
    {
        // SEO: ডাইনামিকভাবে পেজের টাইটেল এবং মেটা ডেসক্রিপশন সেট করুন
        $metaDescription = Str::limit(strip_tags($this->property->description), 160);

        return view('livewire.property.rent.property-details-page')
            ->title($this->property->title . ' - ' . config('app.name'))
            ->with('metaDescription', $metaDescription);
    }
}
