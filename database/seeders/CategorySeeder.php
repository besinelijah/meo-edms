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
        Category::factory()->create(['category_name' => 'General Requirements']);
        Category::factory()->create(['category_name' => 'Building Plans']);
        Category::factory()->create(['category_name' => 'Supporting Documents']);
        Category::factory()->create(['category_name' => 'Clearance']);
        Category::factory()->create(['category_name' => 'Requirements for Certificate of Occupancy for Business Permit']);
        Category::factory()->create(['category_name' => 'Fees']);
        Category::factory()->create(['category_name' => 'Requirements of Application for Business Permit Renewal']);
    }
}
