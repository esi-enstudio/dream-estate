<?php

namespace App\Observers;

use App\Models\Faq;
use Illuminate\Support\Facades\Cache;

class FaqObserver
{
    /**
     * Handle events after all transactions are committed.
     * এটি নিশ্চিত করে যে ডেটাবেস আপডেট হওয়ার পরেই ক্যাশ পরিষ্কার হবে, যা ডেটা অসামঞ্জস্যতা প্রতিরোধ করে।
     */
    public bool $afterCommit = true;

    /**
     * Handle the Faq "saved" event (covers both created and updated).
     * নতুন FAQ তৈরি হলে বা কোনো FAQ আপডেট হলে (প্রশ্ন, উত্তর, ক্যাটাগরি, is_active, sort_order)
     * এই মেথডটি কল হবে এবং ক্যাশ পরিষ্কার করবে।
     *
     * @param Faq $faq
     * @return void
     */
    public function saved(Faq $faq): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Faq "deleted" event.
     * কোনো FAQ মুছে ফেলা হলে ক্যাশ পরিষ্কার করুন।
     *
     * @param Faq $faq
     * @return void
     */
    public function deleted(Faq $faq): void
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
        Cache::forget('homepage-faqs');
    }
}
