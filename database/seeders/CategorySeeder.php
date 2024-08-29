<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'slug' => 'techno',
            'name' => 'Techno',
            'color' => 'cyan',
        ]);

        Category::create([
            'slug' => 'business',
            'name' => 'Business',
            'color' => 'purple',
        ]);

        Category::create([
            'slug' => 'economy',
            'name' => 'Economy',
            'color' => 'red',
        ]);

        Category::create([
            'slug' => 'healty',
            'name' => 'Healty',
            'color' => 'green',
        ]);
    }
}
