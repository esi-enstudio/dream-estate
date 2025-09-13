<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, int|string|null $id)
 * @method static updateOrCreate(array $array, string[] $array1)
 */
class PostFeedback extends Model
{
    protected $guarded = [];

    public function user(): BelongsTo
    { return $this->belongsTo(User::class); }

    public function post(): BelongsTo
    { return $this->belongsTo(Post::class); }
}
