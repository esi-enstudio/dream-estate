<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PropertyViewController extends Controller
{
    public function increment(Property $property, Request $request): JsonResponse
    {
        // সেশন কী তৈরি করুন
        $viewedKey = 'property_viewed_' . $property->id;

        // যদি এই সেশনে এই প্রপার্টিটি ইতিমধ্যে ভিউ করা না হয়ে থাকে
        if (!Session::has($viewedKey)) {
            $property->increment('views_count');
            Session::put($viewedKey, true);
        }

        // একটি সফল JSON রেসপন্স পাঠান
        return response()->json(['success' => true]);
    }
}
