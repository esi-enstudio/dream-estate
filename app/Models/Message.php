<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class Message extends Model
{
    protected $fillable = ['property_id', 'user_id','name','phone', 'message', 'is_read', 'read_at'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime', // <-- $casts-এ যোগ করুন
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (Message $message) {
            // isDirty() চেক করে যে is_read ফিল্ডটি এই সেভ অপারেশনে পরিবর্তন হচ্ছে কি না
            if ($message->isDirty('is_read')) {

                // যদি is_read-কে true করা হয়
                if ($message->is_read) {
                    // read_at কলামে বর্তমান সময় সেট করুন
                    $message->read_at = now();
                }
                // যদি is_read-কে false করা হয়
                else {
                    // read_at কলামটিকে null করে দিন
                    $message->read_at = null;
                }
            }
        });
    }

    /**
     * Determine if the message was sent by a guest.
     */
    protected function isGuest(): Attribute
    {
        return Attribute::make(
            get: fn () => is_null($this->user_id),
        );
    }

    /**
     * Get the property that the message was sent for.
     * প্রতিটি মেসেজ একটি নির্দিষ্ট প্রপার্টির অন্তর্গত।
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the user who sent the message (if they were logged in).
     * প্রতিটি মেসেজ একজন ব্যবহারকারীর হতে পারে (যদি তিনি লগইন করা থাকেন)।
     */
    public function user(): BelongsTo
    {
        // 'user_id' কলামকে sender() নামে রিলেশন দিচ্ছি, যা বেশি অর্থবহ
        return $this->belongsTo(User::class);
    }
}
