<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusBuildingPermitFormRequest;
use App\Http\Requests\StoreBusinessPermitFormRequest;
use App\Models\BusinessPermitForm;
use Illuminate\Http\JsonResponse;

class BusinessPermitFormController extends Controller
{
    /**
     * Store new business_permit_form record
     * 
     * @param StoreBusinessPermitFormRequest $request
     * @return JsonResponse
     */
    public function store(StoreBusinessPermitFormRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $businessPermitForm = BusinessPermitForm::create($validated);

            return response()->json([
                'message' => 'Business permit form created successfully!',
                'data' => $businessPermitForm
            ]);
        } catch (\Throwable $th) {
            return response()->json(["error" => $th->getMessage()]);
        }
    }

    /**
     * Get all records from building_permit_form table
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $buildingPermitForm = BusinessPermitForm::all();
        
        return response()->json(["data" => $buildingPermitForm]);
    }

    /**
     * Get a record from building_permit_form table
     * 
     * @param BusinessPermitForm $businessPermitForm
     * @return JsonResponse
     */
    public function show(BusinessPermitForm $businessPermitForm): JsonResponse
    {
        return response()->json(["data" => $businessPermitForm]);
    }

    /**
     * Change status of a record from building_permit_form table
     * 
     * @param ChangeStatusBuildingPermitFormRequest $request
     * @return JsonRReesponse
     */
    public function changeStatus(ChangeStatusBuildingPermitFormRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $record = BusinessPermitForm::find($validated['id']);
        $record->update(["status" => $validated['status']]);

        return response()->json([
            'message' => 'Building permit form updated successfully!',
            'data' => $record
        ]);
    }
}
