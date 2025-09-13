<?php

namespace App\Models;

use App\Traits\HasCustomSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static find(mixed $oldCategoryId)
 * @method static whereHas(string $string, \Closure $param)
 */
class Category extends Model
{
    use HasCustomSlug;
    protected $guarded = [];

    public function getRouteKeyName(): string
    {
        return 'slug'; // Use slug instead of id in routes
    }

    public function getSluggableField(): string
    {
        return 'name'; // Use slug instead of id in routes
    }

    public function posts(): HasMany
    { return $this->hasMany(Post::class); }
}
