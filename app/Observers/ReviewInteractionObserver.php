<?php

namespace App\Observers;

use App\Models\Review;
use App\Models\ReviewInteraction;

class ReviewInteractionObserver
{
    /**
     * Handle the ReviewInteraction "created" event.
     */
    public function created(ReviewInteraction $reviewInteraction): void
    {
        $this->updateCounts($reviewInteraction->review);
    }

    /**
     * Handle the ReviewInteraction "updated" event.
     */
    public function updated(ReviewInteraction $reviewInteraction): void
    {
        $this->updateCounts($reviewInteraction->review);
    }

    /**
     * Handle the ReviewInteraction "deleted" event.
     */
    public function deleted(ReviewInteraction $reviewInteraction): void
    {
        $this->updateCounts($reviewInteraction->review);
    }

    /**
     * Handle the ReviewInteraction "restored" event.
     */
    public function restored(ReviewInteraction $reviewInteraction): void
    {
        //
    }

    /**
     * Handle the ReviewInteraction "force deleted" event.
     */
    public function forceDeleted(ReviewInteraction $reviewInteraction): void
    {
        //
    }

    protected function updateCounts(Review $review): void
    {
        $review->likes_count = $review->interactions()->where('type', 'like')->count();
        $review->dislikes_count = $review->interactions()->where('type', 'dislike')->count();
        $review->favorites_count = $review->interactions()->where('type', 'favorite')->count();
        $review->save();
    }
}
