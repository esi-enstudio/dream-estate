<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostViewController extends Controller
{
    public function increment(Post $post, Request $request): JsonResponse
    {
        // সেশন কী তৈরি করুন
        $viewedKey = 'post_viewed_' . $post->id;

        // যদি এই সেশনে এই পোস্টটি ইতিমধ্যে ভিউ করা না হয়ে থাকে
        if (!Session::has($viewedKey)) {
            $post->increment('views_count');
            Session::put($viewedKey, true);
        }

        // একটি সফল JSON রেসপন্স পাঠান
        return response()->json(['success' => true]);
    }
}
