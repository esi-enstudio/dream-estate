<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContactMessage extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    /**
     * যদি কোনো লগইন করা ব্যবহারকারী বার্তাটি পাঠান,
     * তাহলে তার সাথে সম্পর্ক স্থাপন করুন।
     */
    public function user(): BelongsTo
    {
        // এই মেসেজটি যে User পাঠিয়েছে, তার সাথে সম্পর্ক
        // User মডেল মুছে ফেলা হলেও যেন মেসেজটি থেকে যায়, তাই nullable()
        return $this->belongsTo(User::class)->nullable();
    }
}
