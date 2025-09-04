<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PropertyViewController extends Controller
{
    public function store(Property $property, Request $request): JsonResponse
    {
        // Route Model Binding স্বয়ংক্রিয়ভাবে প্রপার্টি খুঁজে আনবে

        $viewTracked = $property->trackView($request);

        if ($viewTracked) {
            return response()->json(['status' => 'success', 'message' => 'View tracked.']);
        }

        return response()->json(['status' => 'ignored', 'message' => 'View already tracked or invalid.']);
    }
}
