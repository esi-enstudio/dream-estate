<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tenant;
use App\Models\PropertyType;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        $slug = Str::slug($title) . '-' . uniqid();

        return [
            // Foreign Keys
            'user_id' => User::inRandomOrder()->value('id'),
            'property_type_id' => PropertyType::inRandomOrder()->value('id'),
            'tenant_id' => Tenant::inRandomOrder()->value('id'),
            'division_id' => Division::inRandomOrder()->value('id'),
            'district_id' => District::inRandomOrder()->value('id'),
            'upazila_id' => Upazila::inRandomOrder()->value('id'),
            'union_id' => Union::inRandomOrder()->value('id'),

            // Core
            'title' => $title,
            'slug' => $slug,
            'description' => $this->faker->paragraph(10),
            'property_code' => 'PROP-' . $this->faker->unique()->numberBetween(1000, 9999),
            'purpose' => $this->faker->randomElement(['rent', 'sell']),
            'property_type' => $this->faker->randomElement(['Apartment', 'Flat', 'Duplex']),

            // Pricing
            'rent_price' => $this->faker->numberBetween(5000, 50000),
            'rent_type' => $this->faker->randomElement(['day', 'week', 'month', 'year']),
            'service_charge' => $this->faker->numberBetween(0, 5000),
            'security_deposit' => $this->faker->numberBetween(0, 10000),
            'is_negotiable' => $this->faker->randomElement(['negotiable', 'fixed']),

            // Specs
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'balconies' => $this->faker->numberBetween(0, 3),
            'size_sqft' => $this->faker->numberBetween(400, 3000),
            'floor_level' => $this->faker->randomElement(['Ground Floor', '1st', '2nd', '5th of 10']),
            'total_floors' => $this->faker->numberBetween(1, 20),
            'facing_direction' => $this->faker->randomElement(['North', 'South', 'East', 'West']),
            'year_built' => $this->faker->year(),
            'thumbnail' => $this->faker->imageUrl(640, 480, 'buildings', true),

            // Location
            'address_street' => $this->faker->streetAddress,
            'address_city' => $this->faker->city,
            'address_area' => $this->faker->randomElement(['Dhanmondi', 'Gulshan', 'Mirpur', 'Uttara']),
            'address_zipcode' => $this->faker->postcode,
            'google_maps_location_link' => 'https://maps.google.com/?q=' . $this->faker->latitude() . ',' . $this->faker->longitude(),
            'latitude' => $this->faker->latitude(23.6, 24.0),
            'longitude' => $this->faker->longitude(90.3, 90.5),

            // Additional Features
            'additional_features' => json_encode([
                'ac' => $this->faker->numberBetween(0, 4),
                'tv' => $this->faker->numberBetween(0, 2),
                'fridge' => $this->faker->numberBetween(0, 2),
            ]),
            'house_rules' => $this->faker->sentence(10),

            // Media
            'video_url' => 'https://youtube.com/watch?v=' . Str::random(11),

            // Status & Visibility
            'status' => $this->faker->randomElement(['pending', 'active', 'rented', 'inactive', 'sold_out']),
            'is_available' => $this->faker->boolean(90),
            'available_from' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'is_featured' => $this->faker->boolean(20),
            'is_trending' => $this->faker->boolean(15),
            'is_verified' => $this->faker->boolean(50),

            // SEO
            'views_count' => $this->faker->numberBetween(0, 5000),
            'reviews_count' => $this->faker->numberBetween(0, 100),
            'average_rating' => $this->faker->randomFloat(1, 0, 5),
        ];
    }
}
