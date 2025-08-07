<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Tin Shed'],
            ['name' => 'Semi Pucca'],
            ['name' => 'Flat'],
            ['name' => 'Duplex'],
        ];

        foreach ($types as $type) {
            PropertyType::create([
                'name' => $type['name'],
            ]);
        }
    }
}
