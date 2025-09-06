<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, int|string|null $id)
 * @method static create(array $array)
 */
class ReviewInteraction extends Model
{
    protected $fillable = ['user_id','review_id','type'];

    public function user(): BelongsTo
    { return $this->belongsTo(User::class); }

    public function review(): BelongsTo
    { return $this->belongsTo(Review::class); }
}
