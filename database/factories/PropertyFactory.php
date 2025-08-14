<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Tenant;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(4);

        return [
            'user_id'           => User::inRandomOrder()->first()->id ?? 1,
            // 'property_type_id' এখানে faker দিয়ে একটিই id দিবে, Factory কল নাই
            'property_type_id'  => PropertyType::inRandomOrder()->first()->id ?? 1,
            'tenant_id'         => Tenant::inRandomOrder()->first()->id ?? 1,

            'title'             => $title,
            'slug'              => Str::slug($title) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'description'       => $this->faker->paragraph(10),
            'property_code'     => 'PROP-' . $this->faker->unique()->numberBetween(100, 999),
            'purpose'           => $this->faker->randomElement(['rent', 'sell']),

            'rent_price'        => $this->faker->numberBetween(5000, 50000),
            'rent_type'         => $this->faker->randomElement(['day', 'week', 'month', 'year']),
            'service_charge'    => $this->faker->optional()->numberBetween(0, 5000),
            'security_deposit'  => $this->faker->optional()->numberBetween(0, 50000),
            'is_negotiable'     => $this->faker->randomElement(['negotiable', 'fixed']),

            'bedrooms'          => $this->faker->numberBetween(1, 5),
            'bathrooms'         => $this->faker->numberBetween(1, 4),
            'balconies'         => $this->faker->numberBetween(0, 3),
            'size_sqft'         => $this->faker->numberBetween(400, 3000),
            'floor_level'       => $this->faker->optional()->numberBetween(1, 20) . 'th floor',
            'total_floors'      => $this->faker->optional()->numberBetween(1, 20),
            'facing_direction'  => $this->faker->optional()->randomElement(['North', 'South', 'East', 'West', 'North-East', 'South-West']),
            'year_built'        => $this->faker->optional()->year(),

            'division_id'       => Division::inRandomOrder()->value('id'),
            'district_id'       => District::inRandomOrder()->value('id'),
            'upazila_id'        => Upazila::inRandomOrder()->value('id'),
            'union_id'          => Union::inRandomOrder()->value('id'),

            'address_street'    => $this->faker->streetAddress(),
            'address_area'      => $this->faker->city(),
            'address_zipcode'   => $this->faker->optional()->postcode(),
            'google_maps_location_link' => $this->faker->optional()->url(),
            'latitude'          => $this->faker->optional()->latitude(),
            'longitude'         => $this->faker->optional()->longitude(),

            'house_rules'       => $this->faker->optional()->paragraph(3),

            'video_url'         => $this->faker->optional()->url(),

            'status'            => $this->faker->randomElement(['pending', 'active', 'rented', 'inactive', 'sold_out']),
            'is_available'      => $this->faker->boolean(90),
            'available_from'    => $this->faker->dateTimeBetween('now', '+3 months')->format('Y-m-d'),
            'is_featured'       => $this->faker->boolean(10),
            'is_trending'       => $this->faker->boolean(10),
            'is_verified'       => $this->faker->boolean(20),

            'views_count'       => $this->faker->numberBetween(0, 5000),
            'reviews_count'     => $this->faker->numberBetween(0, 200),
            'average_rating'    => $this->faker->randomFloat(1, 0, 5),
        ];
    }
}
