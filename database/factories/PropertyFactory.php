<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use App\Models\PropertyType;
use App\Models\Tenant;
use App\Models\Division;
use App\Models\District;
use App\Models\Upazila;
use App\Models\Union;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    protected $model = Property::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->value('id'),
            'property_type_id' => PropertyType::inRandomOrder()->value('id'),
            'tenant_id' => Tenant::inRandomOrder()->value('id'),

            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph,
            'listing_type' => $this->faker->randomElement(['rent', 'sell', 'buy']),
            'total_area' => $this->faker->numberBetween(800, 2500),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'balconies' => $this->faker->numberBetween(0, 3),
            'floor_number' => $this->faker->randomDigitNotNull,
            'facing' => $this->faker->randomElement(['north', 'south', 'east', 'west', 'north_east', 'south_west']),
            'year_built' => $this->faker->year,
            'thumbnail' => $this->faker->imageUrl(640, 480, 'house'),

            'division_id' => Division::inRandomOrder()->value('id'),
            'district_id' => District::inRandomOrder()->value('id'),
            'upazila_id' => Upazila::inRandomOrder()->value('id'),
            'union_id' => Union::inRandomOrder()->value('id'),

            'landmark' => $this->faker->streetName,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,

            'rent_amount' => $this->faker->numberBetween(10000, 100000),
            'rent_negotiable' => $this->faker->randomElement(['negotiable', 'fixed']),
            'service_charge' => $this->faker->numberBetween(500, 3000),
            'security_deposit' => $this->faker->numberBetween(10000, 50000),
            'rent_summary' => $this->faker->text(100),

            'available_from' => $this->faker->dateTimeBetween('now', '+3 months'),
            'is_available' => true,
            'is_featured' => $this->faker->boolean(1),
            'is_spotlight' => $this->faker->boolean(1),
            'is_featured_showcase' => $this->faker->boolean(1),
            'is_hero_featured' => $this->faker->boolean(1),
            'hero_order_column' => $this->faker->optional()->numberBetween(1, 10),
            'house_rules' => $this->faker->text(100),

            'contact_number_primary' => $this->faker->unique()->phoneNumber,
            'contact_whatsapp' => $this->faker->unique()->phoneNumber,
            'views_count' => $this->faker->numberBetween(0, 1000),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
