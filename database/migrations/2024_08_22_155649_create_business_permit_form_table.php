<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('business_permit_forms', function (Blueprint $table) {
            $table->id();
            $table->string('affidavit_of_undertaking');
            $table->string('applicant_fname');
            $table->string('applicant_mname')->nullable();
            $table->string('applicant_lname');
            $table->string('applicant_age');
            $table->string('applicant_sex');
            $table->string('applicant_street')->nullable();
            $table->string('applicant_brgy');
            $table->string('applicant_municipality');
            $table->string('applicant_province');
            $table->string('as_built_plan')->comment('As-Built Plan');
            $table->string('bldg_form')->comment('Building form'); 
            $table->string('bldg_pictures')->comment('Pictures of Building');
            $table->string('bldg_plan')->comment('Building Plan');
            $table->string('brgy_clearance')->comment('Barangay Clearance');
            $table->string('brgy_bussiness_clearance')->comment('Barangay Business clearance');
            $table->string('category', 20);
            $table->string('cedula')->comment('Community Tax Certificate');
            $table->string('client_no');
            $table->string('completion_certificate')->comment('Certificate of Completion');
            $table->string('construction_logbook')->comment('Construction Logbook');
            $table->string('construction_specs')->comment('Construction Specifications');
            $table->string('contract_lease_clearance')->comment('Contract of Lease clearance');
            $table->string('contract_lease')->comment('Notarized Contract of Lease');
            $table->string('contract_sale')->comment('Notarized Contract Sale');
            $table->string('deed_of_sale')->comment('Notarized Deed of Absolute Sale');
            $table->string('dti_certificate')->comment('DTI Certificate');
            $table->string('electrical_form')->comment('Electrical form');
            $table->string('electrical_plan')->comment('Electrical Plan');
            $table->string('electronics_plan')->comment('Electronics Plan');
            $table->string('environmental_certificate')->comment('Environmental Clearance Certificate');
            $table->string('fencing_plan')->comment('Fencing Plans');
            $table->string('fencing_form')->comment('Fencing form');
            $table->string('fire_code_reqs')->comment('Fire Code Fee & Fire Safety Control Requirement');
            $table->string('fire_safety_certificate')->comment('BFP Fire Safety Inspection Certificate');
            $table->string('health_certificate')->comment('Health Certificate');
            $table->string('locational_clearance')->comment('Locational Clearance');
            $table->string('lot_plan')->comment('Lot Plan');
            $table->string('logbook')->comment('Logbook');
            $table->string('material_cost_estimate')->comment('Bill of Material & Cost Estimate');
            $table->string('mechanical_plan')->comment('Mechanical Plan');
            $table->string('mechanical_permit')->comment('Mechanical Permit form');
            $table->tinyInteger('isNew')->comment('New or Renewal');
            $table->string('perspective_site_devt')->comment('Perspective with the Site Development');
            $table->string('prop_tax_receipt')->comment('Real Property Tax Receipts');
            $table->string('right_of_way')->comment('Right of Way clearance');
            $table->string('sanitary_permit')->comment('Sanitary/Plumbing Permit form');
            $table->string('sanitary_plan')->comment('Sanitary Plans/Pumbling Plans');
            $table->string('status', 20);
            $table->string('structural_design')->comment('Structural Design');
            $table->string('structural_plan')->comment('Structural Plans & Details');
            $table->string('tax_declaration')->comment('Tax Declaration');
            $table->string('tct')->comment('TCT');
            $table->string('zoning_clearance')->comment('Zoning Clearance');
            $table->string('zoning_clearance_certificate')->comment('Zoning/Locational Clearance');
            $table->string('zoning_location_clearance')->comment('Zoning/Location Clearance form');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('business_permit_forms');
    }
};
