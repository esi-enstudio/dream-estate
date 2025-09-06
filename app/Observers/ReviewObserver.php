<?php

namespace App\Observers;

use App\Models\Property;
use App\Models\Review;

class ReviewObserver
{
    /**
     * Handle events after all transactions are committed.
     *
     * @var bool
     */
    public bool $afterCommit = true;

    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        // নতুন রিভিউ তৈরি হলে এবং সেটি যদি অনুমোদিত হয়, তাহলে গণনা আপডেট করুন
        if ($review->status === 'approved') {
            $this->updatePropertyReviewStats($review->property);
        }
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        // স্ট্যাটাস পরিবর্তন হয়েছে কিনা তা চেক করুন
        // যদি স্ট্যাটাস পরিবর্তন না হয়, তাহলে অপ্রয়োজনীয় গণনা করার দরকার নেই
        if ($review->isDirty('status')) {
            $this->updatePropertyReviewStats($review->property);
        }
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        // রিভিউ মুছে ফেলা হলে গণনা আপডেট করুন
        $this->updatePropertyReviewStats($review->property);
    }

    /**
     * Handle the Review "restored" event.
     */
    public function restored(Review $review): void
    {
        // সফট-ডিলিট থেকে রিভিউ পুনরুদ্ধার করা হলে গণনা আপডেট করুন
        if ($review->status === 'approved') {
            $this->updatePropertyReviewStats($review->property);
        }
    }

    /**
     * Handle the Review "force deleted" event.
     */
    public function forceDeleted(Review $review): void
    {
        //
    }

    /**
     * The main function to calculate and update review statistics for a property.
     *
     * @param Property $property
     * @return void
     */
    protected function updatePropertyReviewStats(Property $property): void
    {
        // শুধুমাত্র অনুমোদিত (approved) রিভিউগুলো গণনা করুন
        $approvedReviews = $property->reviews()->where('status', 'approved');

        $reviewsCount = $approvedReviews->count();
        $averageRating = $approvedReviews->avg('rating') ?? 0;

        // ডেটাবেসে Property মডেল আপডেট করুন
        // Observer-এর অন্য কোনো ইভেন্টকে ট্রিগার না করার জন্য withoutEvents ব্যবহার করা হচ্ছে
        $property->withoutEvents(function () use ($property, $reviewsCount, $averageRating) {
            $property->update([
                'reviews_count' => $reviewsCount,
                'average_rating' => round($averageRating, 1), // এক দশমিক স্থান পর্যন্ত রাউন্ড করুন
            ]);
        });
    }
}
