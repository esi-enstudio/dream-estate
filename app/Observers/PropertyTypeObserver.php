<?php

namespace App\Observers;

use App\Models\PropertyType;
use Illuminate\Support\Facades\Cache;

class PropertyTypeObserver
{
    public bool $afterCommit = true;

    /**
     * Handle the PropertyType "saved" event (covers created and updated).
     */
    public function saved(PropertyType $propertyType): void
    {
        $this->clearCache();
    }

    /**
     * Handle the PropertyType "deleted" event.
     */
    public function deleted(PropertyType $propertyType): void
    {
        $this->clearCache();
    }

    /**
     * A helper function to clear the relevant cache.
     */
    protected function clearCache(): void
    {
        Cache::forget('all-property-types-for-slider-optimized');
    }
}
