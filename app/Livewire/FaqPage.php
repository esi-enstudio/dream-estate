<?php

namespace App\Livewire;

use App\Models\Faq;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class FaqPage extends Component
{
    /**
     * ডেটাবেস থেকে সমস্ত সক্রিয় FAQ নিয়ে আসুন এবং ক্যাটাগরি অনুযায়ী গ্রুপ করুন
     */
    #[Computed(cache: true, key: 'faq-page-all-faqs')]
    public function faqsByCategory(): Collection
    {
        return Faq::query()
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('category'); // কালেকশনটিকে ক্যাটাগরি অনুযায়ী গ্রুপ করা হচ্ছে
    }

    /**
     * সাইডবারে দেখানোর জন্য শুধুমাত্র ক্যাটাগরির তালিকা
     */
    #[Computed(cache: true, key: 'faq-page-categories')]
    public function categories(): \Illuminate\Support\Collection
    {
        // pluck() ব্যবহার করে শুধুমাত্র ক্যাটাগরিগুলোর একটি ইউনিক তালিকা তৈরি করুন
        return $this->faqsByCategory()->keys();
    }

    public function render()
    {
        return view('livewire.faq-page')->title('FAQ' .' - '. config('app.name'));
    }
}
