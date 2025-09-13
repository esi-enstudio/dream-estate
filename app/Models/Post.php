<?php

namespace App\Models;

use App\Traits\HasCustomSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static where(string $string, string $string1)
 */
class Post extends Model implements HasMedia
{

    use HasCustomSlug, InteractsWithMedia;
    protected $guarded = [];
    protected $casts = ['published_at' => 'datetime'];

    public function getRouteKeyName(): string
    {
        return 'slug'; // Use slug instead of id in routes
    }

    public function getSluggableField(): string
    {
        return 'title'; // Use slug instead of id in routes
    }
    public function user(): BelongsTo
    { return $this->belongsTo(User::class); }

    public function category(): BelongsTo
    { return $this->belongsTo(Category::class); }
}
