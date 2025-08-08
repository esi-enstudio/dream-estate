<?php

namespace Database\Factories;

use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TenantFactory extends Factory
{
    protected $model = Tenant::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->company(); // কিংবা নাম টাইপের কিছু

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . uniqid(),
        ];
    }
}
