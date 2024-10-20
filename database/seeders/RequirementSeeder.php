<?php

namespace Database\Seeders;

use App\Models\Requirement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RequirementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=1; $i < 3; $i++) { 
            Requirement::factory()->create([
                'name' => 'BUILDING FORMS',
                'subcategory_id' => 1,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'ELECTRICAL FORMS',
                'subcategory_id' => 1,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Sanitary/ Plumbing Permit',
                'subcategory_id' => 1,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Fencing Permit',
                'subcategory_id' => 1,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Mechanical Permit',
                'subcategory_id' => 1,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Zoning/ Locational Clearance',
                'subcategory_id' => 1,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Certified true copy of TCT',
                'subcategory_id' => 2,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Tax Declaration (Updated & Authenticated from Assessors Office)',
                'subcategory_id' => 2,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Current Real Property Tax Receipts',
                'subcategory_id' => 2,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Duly notarized copy of the Contract of Lease',
                'subcategory_id' => 3,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Duly notarized copy of Deed of Absolute Sale',
                'subcategory_id' => 3,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Duly notarized of the Contract Sale',
                'subcategory_id' => 3,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Lot Plan',
                'subcategory_id' => 4,
                'permit_type' => $i,
            ]);
    
            Requirement::factory()->create([
                'name' => 'Perspective with the Site Development',
                'subcategory_id' => 5,
                'permit_type' => $i,
            ]);
            
            Requirement::factory()->create([
                'name' => 'Building Plans',
                'subcategory_id' => 6,
                'permit_type' => $i,
            ]);
            
            Requirement::factory()->create([
                'name' => 'Structural Plans & Details',
                'subcategory_id' => 7,
                'permit_type' => $i,
            ]);
            
            Requirement::factory()->create([
                'name' => 'Sanitary Plans/Plumbing Plans',
                'subcategory_id' => 8,
                'permit_type' => $i,
            ]);
        }

        Requirement::factory()->create([
            'name' => 'Previous Assessment/O.R. & Certification',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
        Requirement::factory()->create([
            'name' => 'Sanitary Permit to Operate',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
        Requirement::factory()->create([
            'name' => 'Barangay Business Clearance',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
        Requirement::factory()->create([
            'name' => 'Zoning Clearance Certificate (MPDO)',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
        Requirement::factory()->create([
            'name' => 'Printed Pictures of Building (exterior & interior)',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
        Requirement::factory()->create([
            'name' => 'Affidavit of Undertaking',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
        Requirement::factory()->create([
            'name' => 'Contract of Lease',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
        Requirement::factory()->create([
            'name' => 'Bureau of Fire Protection Fire Safety Inspection Clearance (BFP FSIC)',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
        Requirement::factory()->create([
            'name' => 'Department of Trade and Industry (DTI)',
            'subcategory_id' => 9,
            'permit_type' => 3,
        ]);
    }
}
