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
        Schema::table('building_permit_forms', function (Blueprint $table) {
            $table->integer('requirement_id')->nullable();
            $table->string('file_path')->nullable();
            $table->dropColumn('applicant_fname');
            $table->dropColumn('applicant_mname');
            $table->dropColumn('applicant_lname');
            $table->dropColumn('applicant_age');
            $table->dropColumn('applicant_sex');
            $table->dropColumn('applicant_street');
            $table->dropColumn('applicant_brgy');
            $table->dropColumn('applicant_municipality');
            $table->dropColumn('applicant_province');

            $table->dropColumn('affidavit_of_undertaking');
            $table->dropColumn('as_built_plan');
            $table->dropColumn('bldg_form');
            $table->dropColumn('bldg_pictures');
            $table->dropColumn('bldg_plan');
            $table->dropColumn('brgy_clearance');
            $table->dropColumn('brgy_bussiness_clearance');
            $table->dropColumn('cedula');
            $table->dropColumn('completion_certificate');
            $table->dropColumn('construction_logbook');
            $table->dropColumn('construction_specs');
            $table->dropColumn('contract_lease_clearance');
            $table->dropColumn('contract_lease');
            $table->dropColumn('contract_sale');
            $table->dropColumn('deed_of_sale');
            $table->dropColumn('dti_certificate');
            $table->dropColumn('electrical_form');
            $table->dropColumn('electrical_plan');
            $table->dropColumn('electronics_plan');
            $table->dropColumn('environmental_certificate');
            $table->dropColumn('fencing_plan');
            $table->dropColumn('fencing_form');
            $table->dropColumn('fire_code_reqs');
            $table->dropColumn('fire_safety_certificate');
            $table->dropColumn('health_certificate');
            $table->dropColumn('locational_clearance');
            $table->dropColumn('lot_plan');
            $table->dropColumn('logbook');
            $table->dropColumn('material_cost_estimate');
            $table->dropColumn('mechanical_plan');
            $table->dropColumn('mechanical_permit');
            $table->dropColumn('perspective_site_devt');
            $table->dropColumn('prop_tax_receipt');
            $table->dropColumn('right_of_way');
            $table->dropColumn('sanitary_permit');
            $table->dropColumn('sanitary_plan');
            $table->dropColumn('structural_design');
            $table->dropColumn('structural_plan');
            $table->dropColumn('tax_declaration');
            $table->dropColumn('tct');
            $table->dropColumn('zoning_clearance');
            $table->dropColumn('zoning_clearance_certificate');
            $table->dropColumn('zoning_location_clearance');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('building_permit_forms', function (Blueprint $table) {
            $table->dropColumn('requirement_id');
            $table->dropColumn('file_path');
            $table->string('applicant_fname');
            $table->string('applicant_mname');
            $table->string('applicant_lname');
            $table->string('applicant_age');
            $table->string('applicant_sex');
            $table->string('applicant_street');
            $table->string('applicant_brgy');
            $table->string('applicant_municipality');
            $table->string('applicant_province');
            $table->string('affidavit_of_undertaking')->nullable();
            $table->string('as_built_plan')->nullable();
            $table->string('bldg_form')->nullable();
            $table->string('bldg_pictures')->nullable();
            $table->string('bldg_plan')->nullable();
            $table->string('brgy_clearance')->nullable();
            $table->string('brgy_bussiness_clearance')->nullable();
            $table->string('cedula')->nullable();
            $table->string('completion_certificate')->nullable();
            $table->string('construction_logbook')->nullable();
            $table->string('construction_specs')->nullable();
            $table->string('contract_lease_clearance')->nullable();
            $table->string('contract_lease')->nullable();
            $table->string('contract_sale')->nullable();
            $table->string('deed_of_sale')->nullable();
            $table->string('dti_certificate')->nullable();
            $table->string('electrical_form')->nullable();
            $table->string('electrical_plan')->nullable();
            $table->string('electronics_plan')->nullable();
            $table->string('environmental_certificate')->nullable();
            $table->string('fencing_plan')->nullable();
            $table->string('fencing_form')->nullable();
            $table->string('fire_code_reqs')->nullable();
            $table->string('fire_safety_certificate')->nullable();
            $table->string('health_certificate')->nullable();
            $table->string('locational_clearance')->nullable();
            $table->string('lot_plan')->nullable();
            $table->string('logbook')->nullable();
            $table->string('material_cost_estimate')->nullable();
            $table->string('mechanical_plan')->nullable();
            $table->string('mechanical_permit')->nullable();
            $table->string('perspective_site_devt')->nullable();
            $table->string('prop_tax_receipt')->nullable();
            $table->string('right_of_way')->nullable();
            $table->string('sanitary_permit')->nullable();
            $table->string('sanitary_plan')->nullable();
            $table->string('structural_design')->nullable();
            $table->string('structural_plan')->nullable();
            $table->string('tax_declaration')->nullable();
            $table->string('tct')->nullable();
            $table->string('zoning_clearance')->nullable();
            $table->string('zoning_clearance_certificate')->nullable();
            $table->string('zoning_location_clearance')->nullable();
        });
    }
};
