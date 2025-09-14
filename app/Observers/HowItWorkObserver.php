<?php

namespace App\Observers;

use App\Models\HowItWork;
use Illuminate\Support\Facades\Cache;

class HowItWorkObserver
{
    /**
     * Handle events after all transactions are committed.
     * এটি নিশ্চিত করে যে ডেটাবেস আপডেট হওয়ার পরেই ক্যাশ পরিষ্কার হবে।
     */
    public bool $afterCommit = true;

    /**
     * Handle the HowItWork "saved" event (covers both created and updated).
     * নতুন ধাপ তৈরি হলে বা কোনো ধাপ আপডেট হলে (টাইটেল, বর্ণনা, আইকন, is_active, sort_order)
     * এই মেথডটি কল হবে এবং ক্যাশ পরিষ্কার করবে।
     *
     * @param HowItWork $howItWork
     * @return void
     */
    public function saved(HowItWork $howItWork): void
    {
        $this->clearCache();
    }

    /**
     * Handle the HowItWork "deleted" event.
     * কোনো ধাপ মুছে ফেলা হলে ক্যাশ পরিষ্কার করুন।
     *
     * @param HowItWork $howItWork
     * @return void
     */
    public function deleted(HowItWork $howItWork): void
    {
        $this->clearCache();
    }

    /**
     * Handle the HowItWork "restored" event.
     */
    public function restored(HowItWork $howItWork): void
    {
        $this->clearCache();
    }

    /**
     * Handle the HowItWork "force deleted" event.
     */
    public function forceDeleted(HowItWork $howItWork): void
    {
        $this->clearCache();
    }

    /**
     * A helper function to clear the relevant cache.
     *
     * @return void
     */
    protected function clearCache(): void
    {
        // Livewire কম্পোনেন্টে ব্যবহৃত সঠিক কী দিয়ে ক্যাশ মুছে ফেলুন
        Cache::forget('homepage-how-it-works');
    }
}
