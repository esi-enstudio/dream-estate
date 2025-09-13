<?php

namespace App\Observers;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;

class TestimonialObserver
{
    /**
     * Handle events after all transactions are committed.
     * এটি নিশ্চিত করে যে ডেটাবেস আপডেট হওয়ার পরেই ক্যাশ পরিষ্কার হবে।
     */
    public bool $afterCommit = true;

    /**
     * Handle the Testimonial "created" event.
     * নতুন Testimonial তৈরি হলে ক্যাশ পরিষ্কার করুন।
     */
    public function created(Testimonial $testimonial): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Testimonial "updated" event.
     * কোনো Testimonial আপডেট হলে ক্যাশ পরিষ্কার করুন।
     */
    public function updated(Testimonial $testimonial): void
    {
        // ঐচ্ছিক: আপনি যদি শুধুমাত্র নির্দিষ্ট কলাম পরিবর্তনের জন্য ক্যাশ পরিষ্কার করতে চান,
        // তাহলে isDirty() ব্যবহার করতে পারেন। তবে, যেকোনো পরিবর্তনই UI-কে প্রভাবিত করতে পারে,
        // তাই সরাসরি clearCache() কল করাই সবচেয়ে নিরাপদ এবং সহজ।
        $this->clearCache();

        /*
        // আরও সুনির্দিষ্ট নিয়ন্ত্রণের জন্য বিকল্প:
        if ($testimonial->isDirty('is_active', 'sort_order', 'rating', 'client_name', 'quote')) {
            $this->clearCache();
        }
        */
    }

    /**
     * Handle the Testimonial "deleted" event.
     * Testimonial মুছে ফেলা হলে ক্যাশ পরিষ্কার করুন।
     */
    public function deleted(Testimonial $testimonial): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Testimonial "restored" event.
     * সফট-ডিলিট থেকে পুনরুদ্ধার করা হলে ক্যাশ পরিষ্কার করুন।
     */
    public function restored(Testimonial $testimonial): void
    {
        $this->clearCache();
    }

    /**
     * Handle the Testimonial "force deleted" event.
     * স্থায়ীভাবে মুছে ফেলা হলে ক্যাশ পরিষ্কার করুন।
     */
    public function forceDeleted(Testimonial $testimonial): void
    {
        $this->clearCache();
    }

    /**
     * A helper function to clear the relevant cache.
     */
    protected function clearCache(): void
    {
        // Livewire কম্পোনেন্টে ব্যবহৃত সঠিক কী দিয়ে ক্যাশ মুছে ফেলুন
        Cache::forget('homepage-testimonials');
    }
}
