<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'Super Admin',
             'email' => 'admin@example.com',
             'password' => 'admin@example.com'
         ]);

        User::factory()->create([
            'name' => 'Editor',
            'email' => 'editor@example.com',
            'password' => 'editor@example.com'
        ]);

         $this->call(RoleSeeder::class);
         $this->call(CategorySeeder::class);
         $this->call(ProductSeeder::class);
    }
}
