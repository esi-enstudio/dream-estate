<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $id)
 */
class Review extends Model
{
    protected $fillable = ['property_id','user_id','name','phone','email','rating','comment','is_approved'];

    /**
     * এই রিভিউটি কোন বাসার জন্য।
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * এই রিভিউটি কোন ইউজার দিয়েছেন।
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
