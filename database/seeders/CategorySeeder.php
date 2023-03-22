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
        Category::factory()->root()->hasChildren(1)->create();
        Category::factory(1)->root()->create();
        Category::factory()->root()->hasChildren(3)->create();
        Category::factory()->root()->hasChildren(2)->create();
        Category::factory(1)->root()->create();
    }
}
