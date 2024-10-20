<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessPermitFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'affidavit_of_undertaking' => 'nullable|file',
            // 'as_built_plan' => 'nullable|file',
            // 'bldg_form' => 'nullable|file',
            // 'bldg_pictures' => 'nullable|file',
            // 'bldg_plan' => 'nullable|file',
            // 'brgy_clearance' => 'nullable|file',
            // 'brgy_bussiness_clearance' => 'nullable|file',
            // 'cedula' => 'nullable|file',
            // 'completion_certificate' => 'nullable|file',
            // 'construction_logbook' => 'nullable|file',
            // 'construction_specs' => 'nullable|file',
            // 'contract_lease_clearance' => 'nullable|file',
            // 'contract_lease' => 'nullable|file',
            // 'contract_sale' => 'nullable|file',
            // 'deed_of_sale' => 'nullable|file',
            // 'dti_certificate' => 'nullable|file',
            // 'electrical_form' => 'nullable|file',
            // 'electrical_plan' => 'nullable|file',
            // 'electronics_plan' => 'nullable|file',
            // 'environmental_certificate' => 'nullable|file',
            // 'fencing_plan' => 'nullable|file',
            // 'fencing_form' => 'nullable|file',
            // 'fire_code_reqs' => 'nullable|file',
            // 'fire_safety_certificate' => 'nullable|file',
            // 'health_certificate' => 'nullable|file',
            // 'locational_clearance' => 'nullable|file',
            // 'lot_plan' => 'nullable|file',
            // 'logbook' => 'nullable|file',
            // 'material_cost_estimate' => 'nullable|file',
            // 'mechanical_plan' => 'nullable|file',
            // 'mechanical_permit' => 'nullable|file',
            // 'perspective_site_devt' => 'nullable|file',
            // 'prop_tax_receipt' => 'nullable|file',
            // 'right_of_way' => 'nullable|file',
            // 'sanitary_permit' => 'nullable|file',
            // 'sanitary_plan' => 'nullable|file',
            // 'structural_design' => 'nullable|file',
            // 'structural_plan' => 'nullable|file',
            // 'tax_declaration' => 'nullable|file',
            // 'tct' => 'nullable|file',
            // 'zoning_clearance' => 'nullable|file',
            // 'zoning_clearance_certificate' => 'nullable|file',
            // 'zoning_location_clearance' => 'nullable|file',
            'category' => 'string',
            'isNew' => 'string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'project_title' => 'nullable|string',
            'files' => 'nullable|array',
            // 'files.files' => 'array',
            'files.files.*' => 'file|array',
        ];
    }
}
