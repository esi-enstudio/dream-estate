<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Amenity;
use App\Models\SpaceOverview;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        Property::factory()
            ->count(50)
            ->create()
            ->each(function ($property) {
                // Attach Amenities (pivot with `details`)
                $amenities = Amenity::inRandomOrder()->take(rand(2, 5))->get();
                foreach ($amenities as $amenity) {
                    $property->amenities()->attach($amenity->id, [
                        'details' => fake()->sentence(),
                    ]);
                }

                // Attach Space Overviews (pivot with dimensions)
                $spaceOverviews = SpaceOverview::inRandomOrder()->take(rand(1, 3))->get();
                foreach ($spaceOverviews as $space) {
                    $length = fake()->numberBetween(8, 20);
                    $width = fake()->numberBetween(6, 15);
                    $property->spaceOverviews()->attach($space->id, [
                        'length' => $length,
                        'width' => $width,
                        'total_sq_feet' => $length * $width,
                    ]);
                }

                // Attach extra tenants (if needed)
                $tenants = Tenant::inRandomOrder()->take(rand(1, 3))->pluck('id');
                $property->tenants()->attach($tenants);
            });
    }
}
