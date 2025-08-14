<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;
use Illuminate\Support\Str;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['Family', 'পরিবার'],
            ['Bachelor Male', 'অবিবাহিত পুরুষ'],
            ['Bachelor Female', 'অবিবাহিত মহিলা'],
            ['Office', 'অফিস'],
            ['Sublet', 'সাবলেট'],
            ['Hostel', 'হোস্টেল'],
            ['Other', 'অন্যান্য'],
        ];

        foreach ($types as [$en, $bn]) {
            Tenant::updateOrCreate(
                ['slug' => Str::slug($en)],
                [
                    'name' => $en,
                    // বাংলা নাম রাখার জন্য আলাদা কলাম থাকলে সেটি এখানে দিন, যেমন 'name_bn' => $bn
                ]
            );
        }
    }
}
