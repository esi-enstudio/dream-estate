<?php

namespace App\Livewire\Footer;

use App\Models\Property;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class TopDestinations extends Component
{
    /**
     * ডেটাবেস থেকে সবচেয়ে জনপ্রিয় (বেশি প্রপার্টি আছে এমন) ৫টি এলাকা নিয়ে আসুন
     */
    #[Computed(cache: true, key: 'footer-top-destinations')]
    public function destinations()
    {
        // এই কোয়েরিটি address_area অনুযায়ী গ্রুপ করে প্রতিটি এলাকার প্রপার্টি সংখ্যা গণনা করে
        return Property::query()
            ->select('address_area', DB::raw('count(*) as properties_count'))
            ->where('status', 'active')
            ->whereNotNull('address_area')
            ->where('address_area', '!=', '')
            ->groupBy('address_area')
            ->orderBy('properties_count', 'desc') // সবচেয়ে বেশি প্রপার্টি থাকা এলাকাগুলো আগে দেখাবে
            ->take(5) // শুধুমাত্র সেরা ৫টি এলাকা নিন
            ->get();
    }
    public function render(): View|Factory
    {
        return view('livewire.footer.top-destinations');
    }
}
