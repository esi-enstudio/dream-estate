<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $id)
 */
class Review extends Model
{
    protected $fillable = ['property_id','user_id','title','body','rating','status'];

    public function user(): BelongsTo
    { return $this->belongsTo(User::class); }
    public function property(): BelongsTo
    { return $this->belongsTo(Property::class); }
    public function replies(): HasMany
    { return $this->hasMany(Review::class, 'parent_id'); }
}
