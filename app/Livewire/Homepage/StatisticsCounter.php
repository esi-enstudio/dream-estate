<?php

namespace App\Livewire\Homepage;

use App\Models\Property;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class StatisticsCounter extends Component
{
    public int $listingsAdded = 0;
    public int $agentsListed = 0;
    public int $salesCompleted = 0;
    public int $totalUsers = 0;

    public string $viewName = 'default'; // ডিফল্ট ভিউ

    /**
     * কম্পোনেন্টটি মাউন্ট হওয়ার সময় পরিসংখ্যানগুলো লোড করুন
     */
    public function mount($viewName = 'default'): void
    {
        $this->viewName = $viewName;
        $this->loadStatistics();
    }

    /**
     * ডেটাবেস থেকে পরিসংখ্যান গণনা করুন এবং ক্যাশ ব্যবহার করুন
     */
    public function loadStatistics(): void
    {
        $stats = Cache::remember('homepage_statistics', 600, function () {

            // ★★★★★ মূল সমাধানটি এখানে ★★★★★
            // 'spatie/laravel-permission' প্যাকেজের সঠিক পদ্ধতি ব্যবহার করা হচ্ছে
            $agentsCount = User::role('owner')->count();

            return [
                'listings_added' => Property::count(),
                'agents_listed' => $agentsCount,
                'sales_completed' => Property::whereIn('status', ['rented', 'sold_out'])->count(),
                'total_users' => User::count(),
            ];
        });

        $this->listingsAdded = $stats['listings_added'];
        $this->agentsListed = $stats['agents_listed'];
        $this->salesCompleted = $stats['sales_completed'];
        $this->totalUsers = $stats['total_users'];
    }

    /**
     * সংখ্যাগুলোকে সুন্দর ফরম্যাটে (e.g., 50000 to 50K) দেখানোর জন্য একটি Helper মেথড
     */
    public function formatNumber(int $number): string
    {
        if ($number >= 1000000) {
            return round($number / 1000000, 1) . 'M+';
        }
        if ($number >= 1000) {
            return round($number / 1000, 1) . 'K+';
        }
        return (string)$number;
    }

    public function render(): Factory|View|Application
    {
        // ভিউ নামের উপর ভিত্তি করে সঠিক Blade ফাইলটি রেন্ডার করুন
        if ($this->viewName === 'about-us-stats') {
            return view('livewire.homepage.partials.about-us-stats');
        }

        // ডিফল্ট ভিউ (হোমপেজের জন্য)
        return view('livewire.homepage.statistics-counter');
    }
}
