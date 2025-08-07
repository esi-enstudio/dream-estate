<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Small Family'],
            ['name' => 'Big Family'],
            ['name' => 'Bachelor'],
            ['name' => 'Girls'],
            ['name' => 'Boys'],
        ];

        foreach ($types as $type) {
            Tenant::create([
                'name' => $type['name'],
            ]);
        }
    }
}
