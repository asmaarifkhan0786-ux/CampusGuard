<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CrisisCategory;

class CrisisCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Fire',
            'Medical Emergency',
            'Security',
            'Lab Accident',
            'Building Damage',
            'Other',
        ];

        foreach ($categories as $name) {
            CrisisCategory::updateOrCreate(
                ['name' => $name],
                ['is_active' => true]
            );
        }
    }
}