<?php

namespace App\Livewire\Homepage;

use App\Models\Faq;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Faqs extends Component
{
    #[Computed(cache: true, key: 'homepage-faqs')]
    public function faqs(): Collection
    {
        // ★★★★★ মূল সমাধানটি এখানে ★★★★★

        // ধাপ ১: শুধুমাত্র 'general' ক্যাটাগরির প্রথম ৫টি FAQ নিয়ে আসুন
        $generalFaqs = Faq::query()
            ->where('is_active', true)
            ->where('category', 'general')
            ->orderBy('sort_order', 'asc')
            ->take(5)
            ->get();

        // ধাপ ২: শুধুমাত্র 'renting' ক্যাটাগরির প্রথম ৫টি FAQ নিয়ে আসুন
        $rentingFaqs = Faq::query()
            ->where('is_active', true)
            ->where('category', 'renting')
            ->orderBy('sort_order', 'asc')
            ->take(5)
            ->get();

        // ধাপ ৩: দুটি ফলাফলকে একত্রিত করুন এবং তারপর ক্যাটাগরি অনুযায়ী গ্রুপ করুন
        return $generalFaqs->merge($rentingFaqs)->groupBy('category');
    }

    public function render(): View|Factory
    {
        return view('livewire.homepage.faqs');
    }
}
