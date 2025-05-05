<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Category::insert([
            'name' => 'Test Categoria',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
