<?php

namespace App\Observers;

use App\Models\Property;
use App\Models\PropertyType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class PropertyObserver
{
    /**
     * Handle events after all transactions are committed.
     */
    public bool $afterCommit = true;

    /**
     * Handle the Property "saved" event (covers both "created" and "updated").
     */
    public function saved(Property $property): void
    {
        // --- ক্যাশ এবং Property Type কাউন্ট আপডেটের লজিক ---

        // শুধুমাত্র 'property_type_id' পরিবর্তন হলেই কাউন্ট আপডেট করুন
        if ($property->isDirty('property_type_id')) {
            // যদি পুরনো property_type_id থাকে (অর্থাৎ, এটি একটি update ছিল), তাহলে পুরনোটির কাউন্ট কমান
            if ($oldTypeId = $property->getOriginal('property_type_id')) {
                if ($oldType = PropertyType::find($oldTypeId)) {
                    $this->updatePropertyTypeCount($oldType);
                }
            }
            // নতুনটির কাউন্ট আপডেট করুন
            $this->updatePropertyTypeCount($property->propertyType);
        }

        // শুধুমাত্র 'is_featured' পরিবর্তন হলেই ক্যাশ পরিষ্কার করুন
        if ($property->isDirty('is_featured') || $property->isDirty('purpose')) {
            Cache::forget('featured-properties-array-rent');
            Cache::forget('featured-properties-array-sell');
        }

        // শুধুমাত্র 'address_area' পরিবর্তন হলেই ক্যাশ পরিষ্কার করুন
        if ($property->isDirty('address_area')) {
            Cache::forget('popular-areas-homepage');
        }

        // --- স্কোর গণনার লজিক ---
        $this->calculateAndSetScore($property);
    }

    /**
     * Handle the Property "deleted" event.
     */
    public function deleted(Property $property): void
    {
        // প্রপার্টি মুছে ফেলা হলে সংশ্লিষ্ট Property Type-এর কাউন্ট আপডেট করুন
        $this->updatePropertyTypeCount($property->propertyType);
    }

    /**
     * The main function to calculate and update the score.
     */
    private function calculateAndSetScore(Property $property): void
    {
        $score = 0;

        // ভেরিফিকেশন
        if ($property->is_verified) $score += 50;
        if ($property->user?->is_verified) $score += 30; // Optional chaining for safety

        // সম্পূর্ণতা
        if ($property->hasMedia('featured_image')) $score += 20;
        $galleryScore = $property->getMedia('gallery')->count() * 2;
        $score += min($galleryScore, 20);

        if (strlen($property->description) > 300) $score += 15;
        if (!empty($property->video_url)) $score += 15;
        if (count((array)$property->additional_features) > 0) $score += 10;

        // জনপ্রিয়তা
        $score += $property->average_rating * 5;
        $score += min($property->reviews_count, 10);

        // বিশেষ স্ট্যাটাস
        if ($property->is_featured) $score += 25;

        // নতুনত্ব (শুধুমাত্র তৈরি হওয়ার সময় বা 최근 আপডেটের সময়)
        // Carbon is automatically available in newer Laravel versions
        if ($property->created_at->gt(now()->subDays(7))) $score += 10;

        // স্কোর আপডেট করুন, কিন্তু observer পুনরায় ট্রিগার না করে
        // We use direct DB update to avoid re-triggering 'saved' event
        Property::withoutEvents(function () use ($property, $score) {
            $property->score = $score;
            $property->saveQuietly(); // saveQuietly() is another safe method
        });
    }

    /**
     * The main function to update property counts for a PropertyType.
     */
    protected function updatePropertyTypeCount(?PropertyType $type): void
    {
        if ($type) {
            // This is the most efficient way inside an observer
            $type->properties_count = $type->properties()->count();
            $type->saveQuietly(); // saveQuietly() does not trigger any events

            // Property Type-এর কাউন্ট আপডেট হওয়ার সাথে সাথেই স্লাইডার ক্যাশ পরিষ্কার করুন
            Cache::forget('all-property-types-for-slider-optimized');
        }
    }
}
