<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subcategory::factory()->create([
            'subcategory_name' => 'Accomplished Application Forms - (Building, Electrical & Sanitary/Plumbing Permit, Fencing, Mechanical (if required) & Zoning/Locational Clearance)',
            'category_id' => 1,
        ]);

        Subcategory::factory()->create([
            'subcategory_name' => 'In case the applicant is the registered owner of the lot:',
            'category_id' => 1,
        ]);

        Subcategory::factory()->create([
            'subcategory_name' => 'In case the applicant is not the registered owner of the lot:',
            'category_id' => 1,
        ]);

        Subcategory::factory()->create([
            'subcategory_name' => 'Lot Plan (Signed and sealed by geodetic Engineer)',
            'category_id' => 1,
        ]);

        Subcategory::factory()->create([
            'subcategory_name' => 'Perspective with the Site Development (Signed and sealed by the Architecture and Geodetic Engineer)',
            'category_id' => 2,
        ]);

        Subcategory::factory()->create([
            'subcategory_name' => 'Building Plans (Signed and sealed by the Architect/Civil Engineer)',
            'category_id' => 2,
        ]);

        Subcategory::factory()->create([
            'subcategory_name' => 'Structural Plans (Signed and sealed by Civil Engineer/Structural Engineer)',
            'category_id' => 2,
        ]);

        Subcategory::factory()->create([
            'subcategory_name' => 'Sanitary Plans/Plumbing Plans (Signed and sealed by Sanitary Engineer/Master Plumber/Civil Engineer)',
            'category_id' => 2,
        ]);
        
        Subcategory::factory()->create([
            'subcategory_name' => 'REQUIREMENTS FOR RENEWAL OF CERTIFICATE OF ANNUAL INSPECTION',
            'category_id' => 7,
        ]);
    }
}
