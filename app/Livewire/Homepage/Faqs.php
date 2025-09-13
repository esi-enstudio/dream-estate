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
        // ডেটাবেস থেকে সমস্ত সক্রিয় FAQ নিয়ে আসুন এবং ক্যাটাগরি অনুযায়ী গ্রুপ করুন
        return Faq::query()
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->groupBy('category');
    }

    public function render(): View|Factory
    {
        return view('livewire.homepage.faqs');
    }
}
