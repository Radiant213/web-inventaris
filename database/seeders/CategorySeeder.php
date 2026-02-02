<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Laptop',
            'IoT',
            'Network',
            'Multimedia',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
