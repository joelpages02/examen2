<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Event;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Event::insert([
            'name' => 'Test Evento',
            'date' => '2012-12-12',
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}