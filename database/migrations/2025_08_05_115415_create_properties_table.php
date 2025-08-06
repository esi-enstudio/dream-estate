<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->comment('Owner of the property')->constrained()->cascadeOnDelete();
            // foreignIdFor(PropertyType::class) এর পরিবর্তে আমরা একটি সহজবোধ্য ক্যাটাগরি সিস্টেম ব্যবহার করতে পারি।
            // foreignIdFor(Tenant::class) এখানে প্রয়োজন নেই, কারণ একটি প্রপার্টির একাধিক ভাড়াটিয়া থাকতে পারে (ভবিষ্যতে) এবং এটি একটি Booking/Rental চুক্তির মাধ্যমে হ্যান্ডেল করা উচিত।

            // --- Core Information ---
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->string('property_code')->unique()->comment('Human-readable unique ID like BHARA-101');
            $table->enum('purpose', ['rent', 'sell'])->default('rent')->comment('Purpose of the listing');
            $table->string('property_type')->comment('e.g., Apartment, Flat, Duplex'); // PropertyType মডেলের পরিবর্তে সাধারণ স্ট্রিং ব্যবহার সহজতর।

            // --- Pricing Details ---
            $table->unsignedInteger('rent_price')->comment('Monthly rent amount');
            $table->unsignedInteger('service_charge')->nullable()->default(0);
            $table->unsignedInteger('security_deposit')->nullable()->default(0);
            $table->boolean('is_negotiable')->default(true);

            // --- Property Specifications ---
            $table->unsignedSmallInteger('bedrooms');
            $table->unsignedSmallInteger('bathrooms');
            $table->unsignedSmallInteger('balconies')->default(0);
            $table->unsignedInteger('size_sqft')->comment('Area in square feet');
            $table->string('floor_level')->nullable()->comment('e.g., 5th floor of 12');
            $table->unsignedSmallInteger('total_floors')->nullable();
            $table->string('facing_direction')->nullable()->comment('e.g., South, North-East');
            $table->year('year_built')->nullable();

            // --- Location ---
            $table->text('address_street');
            $table->string('address_city');
            $table->string('address_area'); // e.g., Dhanmondi, Gulshan
            $table->string('address_zipcode')->nullable();
            $table->string('google_maps_location_link')->nullable(); // সরাসরি গুগল ম্যাপের লিংক রাখার জন্য
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            // --- Additional Features (JSON Column for flexibility) ---
            // ডিজাইনে থাকা "Property Features" (AC, TV, Fridge) এর জন্য JSON কলাম সেরা।
            // এতে ভবিষ্যতে নতুন ফিচার যোগ করতে মাইগ্রেশন লাগবে না।
            $table->json('additional_features')->nullable()->comment('Stores key-value pairs like {"ac": 4, "tv": 2, "fridge": 1}');
            $table->text('house_rules')->nullable();

            // --- Media ---
            // Filament Spatie Media Library ইন্টিগ্রেশনের জন্য আলাদা টেবিল ব্যবহার হবে।
            // তাই এখানে শুধু ভিডিও লিংক রাখা হলো।
            $table->string('video_url')->nullable()->comment('Youtube or Vimeo video link');

            // --- Status & Visibility ---
            $table->enum('status', ['pending', 'active', 'rented', 'inactive', 'sold_out'])->default('pending');
            $table->boolean('is_available')->default(true);
            $table->date('available_from');
            $table->boolean('is_featured')->default(false)->comment('For "Featured" badge');
            $table->boolean('is_trending')->default(false)->comment('For "Trending" badge');
            $table->boolean('is_verified')->default(false)->comment('Verified by platform admin');

            // --- System & SEO ---
            $table->unsignedBigInteger('views_count')->default(0);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->decimal('average_rating', 2, 1)->default(0.0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property');
    }
};
