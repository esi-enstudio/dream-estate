<?php

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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // যেমন: Premium Tenant, Premium Owner
            $table->string('slug')->unique(); // URL-ফ্রেন্ডলি নাম
            $table->string('stripe_plan')->nullable(); // যদি আন্তর্জাতিক পেমেন্ট গেটওয়ে ব্যবহার করেন
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();
            $table->json('features')->nullable(); // To store list of features
            $table->boolean('is_popular')->default(false); // For the "Most Popular" ribbon
            $table->enum('billing_cycle', ['monthly', 'weekly'])
                ->default('monthly');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
