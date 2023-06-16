<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(UsersTableSeeder::class);
        // \App\Models\User::factory(2)->create();
        // \App\Models\Category::factory(2)->create();
        // \App\Models\Brand::factory(1)->create();
        \App\Models\Product::factory(30)->create();
        // \App\Models\Banner::factory(1)->create();
        

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

    }
}
