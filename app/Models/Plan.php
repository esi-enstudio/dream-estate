<?php

namespace App\Models;

use App\Traits\HasCustomSlug;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, string $string1)
 */
class Plan extends Model
{
    use HasCustomSlug;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'features',
        'is_popular',
        'billing_cycle',
    ];

    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug'; // Use slug instead of id in routes
    }

    /**
     * Get the field name that should be used for generating the slug.
     */
    public function getSluggableField(): string
    {
        return 'name'; // Use slug instead of id in routes
    }
}
