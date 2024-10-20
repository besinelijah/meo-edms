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
            $table->string('affidavit_of_undertaking')->nullable()->change();
            $table->string('as_built_plan')->nullable()->change();
            $table->string('bldg_form')->nullable()->change();
            $table->string('bldg_pictures')->nullable()->change();
            $table->string('bldg_plan')->nullable()->change();
            $table->string('brgy_clearance')->nullable()->change();
            $table->string('brgy_bussiness_clearance')->nullable()->change();
            $table->string('cedula')->nullable()->change();
            $table->string('completion_certificate')->nullable()->change();
            $table->string('construction_logbook')->nullable()->change();
            $table->string('construction_specs')->nullable()->change();
            $table->string('contract_lease_clearance')->nullable()->change();
            $table->string('contract_lease')->nullable()->change();
            $table->string('contract_sale')->nullable()->change();
            $table->string('deed_of_sale')->nullable()->change();
            $table->string('dti_certificate')->nullable()->change();
            $table->string('electrical_form')->nullable()->change();
            $table->string('electrical_plan')->nullable()->change();
            $table->string('electronics_plan')->nullable()->change();
            $table->string('environmental_certificate')->nullable()->change();
            $table->string('fencing_plan')->nullable()->change();
            $table->string('fencing_form')->nullable()->change();
            $table->string('fire_code_reqs')->nullable()->change();
            $table->string('fire_safety_certificate')->nullable()->change();
            $table->string('health_certificate')->nullable()->change();
            $table->string('locational_clearance')->nullable()->change();
            $table->string('lot_plan')->nullable()->change();
            $table->string('logbook')->nullable()->change();
            $table->string('material_cost_estimate')->nullable()->change();
            $table->string('mechanical_plan')->nullable()->change();
            $table->string('mechanical_permit')->nullable()->change();
            $table->string('perspective_site_devt')->nullable()->change();
            $table->string('prop_tax_receipt')->nullable()->change();
            $table->string('right_of_way')->nullable()->change();
            $table->string('sanitary_permit')->nullable()->change();
            $table->string('sanitary_plan')->nullable()->change();
            $table->string('structural_design')->nullable()->change();
            $table->string('structural_plan')->nullable()->change();
            $table->string('tax_declaration')->nullable()->change();
            $table->string('tct')->nullable()->change();
            $table->string('zoning_clearance')->nullable()->change();
            $table->string('zoning_clearance_certificate')->nullable()->change();
            $table->string('zoning_location_clearance')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('building_permit_forms', function (Blueprint $table) {
            $table->string('affidavit_of_undertaking')->nullable(false)->change();
            $table->string('as_built_plan')->nullable(false)->change();
            $table->string('bldg_form')->nullable(false)->change();
            $table->string('bldg_pictures')->nullable(false)->change();
            $table->string('bldg_plan')->nullable(false)->change();
            $table->string('brgy_clearance')->nullable(false)->change();
            $table->string('brgy_bussiness_clearance')->nullable(false)->change();
            $table->string('cedula')->nullable(false)->change();
            $table->string('completion_certificate')->nullable(false)->change();
            $table->string('construction_logbook')->nullable(false)->change();
            $table->string('construction_specs')->nullable(false)->change();
            $table->string('contract_lease_clearance')->nullable(false)->change();
            $table->string('contract_lease')->nullable(false)->change();
            $table->string('contract_sale')->nullable(false)->change();
            $table->string('deed_of_sale')->nullable(false)->change();
            $table->string('dti_certificate')->nullable(false)->change();
            $table->string('electrical_form')->nullable(false)->change();
            $table->string('electrical_plan')->nullable(false)->change();
            $table->string('electronics_plan')->nullable(false)->change();
            $table->string('environmental_certificate')->nullable(false)->change();
            $table->string('fencing_plan')->nullable(false)->change();
            $table->string('fencing_form')->nullable(false)->change();
            $table->string('fire_code_reqs')->nullable(false)->change();
            $table->string('fire_safety_certificate')->nullable(false)->change();
            $table->string('health_certificate')->nullable(false)->change();
            $table->string('locational_clearance')->nullable(false)->change();
            $table->string('lot_plan')->nullable(false)->change();
            $table->string('logbook')->nullable(false)->change();
            $table->string('material_cost_estimate')->nullable(false)->change();
            $table->string('mechanical_plan')->nullable(false)->change();
            $table->string('mechanical_permit')->nullable(false)->change();
            $table->string('perspective_site_devt')->nullable(false)->change();
            $table->string('prop_tax_receipt')->nullable(false)->change();
            $table->string('right_of_way')->nullable(false)->change();
            $table->string('sanitary_permit')->nullable(false)->change();
            $table->string('sanitary_plan')->nullable(false)->change();
            $table->string('structural_design')->nullable(false)->change();
            $table->string('structural_plan')->nullable(false)->change();
            $table->string('tax_declaration')->nullable(false)->change();
            $table->string('tct')->nullable(false)->change();
            $table->string('zoning_clearance')->nullable(false)->change();
            $table->string('zoning_clearance_certificate')->nullable(false)->change();
            $table->string('zoning_location_clearance')->nullable(false)->change();
        });
    }
};
