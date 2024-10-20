<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuildingPermitForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'affidavit_of_undertaking',
        'applicant_fname',
        'applicant_mname',
        'applicant_lname',
        'applicant_age',
        'applicant_sex',
        'applicant_street',
        'applicant_brgy',
        'applicant_municipality',
        'applicant_province',
        'as_built_plan',
        'bldg_form',
        'bldg_pictures',
        'bldg_plan',
        'brgy_clearance',
        'brgy_bussiness_clearance',
        'category',
        'cedula',
        'client_no',
        'completion_certificate',
        'construction_logbook',
        'construction_specs',
        'contract_lease_clearance',
        'contract_lease',
        'contract_sale',
        'deed_of_sale',
        'dti_certificate',
        'electrical_form',
        'electrical_plan',
        'electronics_plan',
        'environmental_certificate',
        'fencing_plan',
        'fencing_form',
        'fire_code_reqs',
        'fire_safety_certificate',
        'health_certificate',
        'locational_clearance',
        'lot_plan',
        'logbook',
        'material_cost_estimate',
        'mechanical_plan',
        'mechanical_permit',
        'perspective_site_devt',
        'prop_tax_receipt',
        'right_of_way',
        'sanitary_permit',
        'sanitary_plan',
        'status',
        'structural_design',
        'structural_plan',
        'tax_declaration',
        'tct',
        'zoning_clearance',
        'zoning_clearance_certificate',
        'zoning_location_clearance',
        'latitude',
        'longitude',
        'project_title',
    ];
}
