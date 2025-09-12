<?php

namespace App\Livewire\Homepage;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class PopularAreas extends Component
{
    /**
     * ডেটাবেস থেকে সবচেয়ে জনপ্রিয় এলাকা এবং তাদের প্রপার্টি সংখ্যা নিয়ে আসুন
     */
    #[Computed(cache: true, key: 'popular-areas-homepage')]
    public function areas(): Collection
    {
        // এই কোয়েরিটি address_area অনুযায়ী গ্রুপ করে প্রতিটি এলাকার প্রপার্টি সংখ্যা গণনা করে
        return Property::query()
            ->select('address_area', DB::raw('count(*) as properties_count'))
            ->where('status', 'active')
            ->whereNotNull('address_area')
            ->where('address_area', '!=', '')
            ->groupBy('address_area')
            ->orderBy('properties_count', 'desc') // সবচেয়ে বেশি প্রপার্টি থাকা এলাকাগুলো আগে দেখাবে
            ->take(10) // হোমপেজে দেখানোর জন্য সর্বোচ্চ ১০টি এলাকা নিন
            ->get();
    }

    /**
     * প্রতিটি এলাকার জন্য একটি থাম্বনেইল ইমেজ খুঁজে বের করার জন্য একটি Helper মেথড
     * এলাকার সেরা স্কোর থাকা প্রপার্টির ছবিকে প্রাধান্য দেওয়া হবে
     */
    public function getAreaImage($areaName)
    {
        // সেই এলাকার সর্বোচ্চ স্কোর থাকা প্রপার্টিটি খুঁজে বের করুন
        $property = Property::where('address_area', 'like', $areaName)
            ->where('status', 'active')
            ->orderBy('score', 'desc')
            ->orderBy('is_featured', 'desc')
            ->first();

        // প্রথমে ছবির URL একটি ভ্যারিয়েবলে নিন
        $imageUrl = $property?->getFirstMediaUrl('featured_image', 'thumbnail');

        // যদি URL টি বিদ্যমান থাকে এবং খালি না হয়, তাহলে সেটি রিটার্ন করুন
        // অন্যথায়, ডিফল্ট ইমেজ পাথ রিটার্ন করুন
        return !empty($imageUrl) ? $imageUrl : asset('assets/img/default-city-placeholder.jpg');
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.homepage.popular-areas');
    }
}
