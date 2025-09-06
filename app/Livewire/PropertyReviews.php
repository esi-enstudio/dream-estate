<?php

namespace App\Livewire;

use App\Models\Property;
use App\Models\Review;
use App\Models\ReviewInteraction;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Application;
use LaravelIdea\Helper\App\Models\_IH_Review_QB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class PropertyReviews extends Component
{
    public Property $property;

    // Form State
    public $rating = 5;
    public $title = '';
    public $body = '';
    public array $userInteractions = [];

    // UI State for initial display
    public int $initialDisplayCount = 3; // প্রথমে কয়টি রিভিউ দেখানো হবে

    public function mount(Property $property): void
    {
        $this->property = $property;
        $this->loadUserInteractions();
    }

    // এই মেথডটি ব্যবহারকারীর interaction গুলো আগেই লোড করে নেয়
    protected function loadUserInteractions(): void
    {
        if (auth()->check()) {
            $reviewIds = $this->property->approvedReviews()->pluck('id');
            $this->userInteractions = ReviewInteraction::where('user_id', auth()->id())
                ->whereIn('review_id', $reviewIds)
                ->pluck('type', 'review_id')
                ->all();
        }
    }

    public function toggleInteraction(int $reviewId, string $type)
    {
        if (!auth()->check()) {
            return $this->redirect(route('filament.superadmin.auth.login'));
        }

        $existingInteraction = ReviewInteraction::where('user_id', auth()->id())
            ->where('review_id', $reviewId)
            ->first();

        if ($existingInteraction) {
            if ($existingInteraction->type === $type) {
                // একই বাটনে আবার ক্লিক করলে interaction মুছে যাবে
                $existingInteraction->delete();
                unset($this->userInteractions[$reviewId]);
            } else {
                // অন্য বাটনে ক্লিক করলে type পরিবর্তন হবে
                $existingInteraction->update(['type' => $type]);
                $this->userInteractions[$reviewId] = $type;
            }
        } else {
            // নতুন interaction তৈরি হবে
            ReviewInteraction::create([
                'user_id' => auth()->id(),
                'review_id' => $reviewId,
                'type' => $type,
            ]);
            $this->userInteractions[$reviewId] = $type;
        }
    }

    /**
     * Initially visible reviews on the page.
     */
    #[Computed]
    public function initialReviews(): Collection
    {
        return $this->property->approvedReviews()
            ->with(['user', 'replies.user'])
            ->latest()
            ->take($this->initialDisplayCount)
            ->get();
    }

    /**
     * All approved reviews for the modal.
     */
    #[Computed]
    public function allReviews(): Collection
    {
        // Cache this result to avoid re-querying on every render
        return $this->property->approvedReviews()
            ->with(['user', 'replies.user'])
            ->latest()
            ->get();
    }

    #[Computed]
    public function reviews(): Collection|HasMany|_IH_Review_QB
    {
        return $this->property->approvedReviews()
            ->with(['user', 'replies.user'])
            ->latest()
            ->take($this->initialDisplayCount)
            ->get();
    }

    #[Computed]
    public function ratingDistribution(): array
    {
        $distribution = $this->property->approvedReviews()
            ->selectRaw('rating, count(*) as count')
            ->groupBy('rating')
            ->pluck('count', 'rating')->all();

        $totalReviews = array_sum($distribution);
        $result = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = $distribution[$i] ?? 0;
            $result[$i] = [
                'count' => $count,
                'percentage' => $totalReviews > 0 ? ($count / $totalReviews) * 100 : 0,
            ];
        }
        return $result;
    }

    /**
     * Checks if the currently authenticated user has already reviewed this property.
     */
    #[Computed]
    public function hasAlreadyReviewed(): bool
    {
        if (!auth()->check()) {
            return false;
        }

        return Review::where('user_id', auth()->id())
            ->where('property_id', $this->property->id)
            ->exists();
    }

    public function submitReview()
    {
        if (!auth()->check()) {
            return $this->redirect(route('filament.superadmin.auth.login'));
        }

        // সার্ভার-সাইড সুরক্ষা: রিভিউ জমা দেওয়ার আগে আবার চেক করুন
        if ($this->hasAlreadyReviewed()) {
            session()->flash('review_error', 'You have already submitted a review for this property.');
            return;
        }

        $this->validate([
            'rating' => 'required|integer|between:1,5',
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:20',
        ]);

        Review::create([
            'property_id' => $this->property->id,
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'title' => $this->title,
            'body' => $this->body,
        ]);

        $this->reset('rating', 'title', 'body');
        $this->dispatch('review-submitted'); // JS event পাঠাবে মডাল বন্ধ করার জন্য
        $this->dispatch('show-review-success', message: 'Thank you! Your review is pending approval.');
    }

    /**
     * Resets the form fields and validation errors.
     * This method is triggered by a browser event dispatched from JavaScript.
     */
    #[On('resetReviewForm')] // <-- এই অ্যাট্রিবিউটটি যোগ করুন
    public function resetForm(): void
    {
        $this->resetValidation(); // শুধুমাত্র ভ্যালিডেশন error রিসেট করে
        $this->reset('rating', 'title', 'body'); // ফর্মের ফিল্ডগুলো রিসেট করে
        $this->rating = 5; // রেটিংকে ডিফল্ট মানে ফিরিয়ে আনা হলো
    }

    public function render(): Application|View|Factory|\Illuminate\View\View
    {
        return view('livewire.property-reviews');
    }
}
