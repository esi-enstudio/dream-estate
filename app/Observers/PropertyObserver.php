<?php

namespace App\Observers;

use App\Models\Property;
use App\Models\PropertyType;
use Carbon\Carbon;

class PropertyObserver
{
    /**
     * Handle the Property "created" event.
     */
    public function created(Property $property): void
    {
        $this->updateCount($property->propertyType);
    }

    /**
     * Handle the Property "updated" event.
     */
    public function updated(Property $property): void
    {
        if ($property->isDirty('property_type_id')) {
            $oldTypeId = $property->getOriginal('property_type_id');
            if ($oldType = PropertyType::find($oldTypeId)) {
                $this->updateCount($oldType); // পুরনো টাইপের কাউন্ট আপডেট করুন
            }
            $this->updateCount($property->propertyType); // নতুন টাইপের কাউন্ট আপডেট করুন
        }
    }

    /**
     * Handle the Property "deleted" event.
     */
    public function deleted(Property $property): void
    {
        $this->updateCount($property->propertyType);
    }

    /**
     * Handle the Property "restored" event.
     */
    public function restored(Property $property): void
    {
        //
    }

    /**
     * Handle the Property "force deleted" event.
     */
    public function forceDeleted(Property $property): void
    {
        //
    }

    public function saved(Property $property): void
    {
        $this->calculateAndSetScore($property);
    }

    private function calculateAndSetScore(Property $property): void
    {
        $score = 0;

        // ভেরিফিকেশন
        if ($property->is_verified) $score += 50;
        if ($property->user->is_verified) $score += 30; // Assuming User model has is_verified field

        // সম্পূর্ণতা
        if ($property->hasMedia('featured_image')) $score += 20;
        $galleryScore = $property->getMedia('gallery')->count() * 2;
        $score += min($galleryScore, 20); // সর্বোচ্চ ২০ পয়েন্ট

        if (strlen($property->description) > 300) $score += 15;
        if (!empty($property->video_url)) $score += 15;
        if (count((array)$property->additional_features) > 0) $score += 10;

        // জনপ্রিয়তা
        $score += $property->average_rating * 5;
        $score += min($property->reviews_count, 10); // সর্বোচ্চ ১০ পয়েন্ট

        // বিশেষ স্ট্যাটাস
        if ($property->is_featured) $score += 25;

        // নতুনত্ব
        if ($property->created_at->gt(Carbon::now()->subDays(7))) $score += 10;

        // স্কোর আপডেট করুন, কিন্তু observer পুনরায় ট্রিগার না করে
        $property->withoutEvents(function () use ($property, $score) {
            $property->score = $score;
            $property->save();
        });
    }

    protected function updateCount(?PropertyType $type): void
    {
        if ($type) {
            $type->properties_count = $type->properties()->count();
            $type->save();
        }
    }
}
