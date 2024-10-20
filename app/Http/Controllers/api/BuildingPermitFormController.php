<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeStatusBuildingPermitFormRequest;
use App\Http\Requests\StoreBuildingPermitFormRequest;
use App\Models\BuildingPermitForm;
use Illuminate\Http\JsonResponse;

class BuildingPermitFormController extends Controller
{
    /**
     * Store new business_permit_form record
     * 
     * @param StoreBusinessPermitFormRequest $request
     * @return JsonResponse
     */
    public function store(StoreBuildingPermitFormRequest $request): JsonResponse
    {
        $validated = $request->validated();

        try {
            $businessPermitForm = BuildingPermitForm::create($validated);

            return response()->json([
                'message' => 'Building permit form created successfully!',
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
        $buildingPermitForm = BuildingPermitForm::all();

        return response()->json(["data" => $buildingPermitForm]);
    }

    /**
     * Get a record from building_permit_form table
     * 
     * @param BuildingPermitForm $buildingPermitForm
     * @return JsonResponse
     */
    public function show(BuildingPermitForm $buildingPermitForm): JsonResponse
    {
        return response()->json(["data" => $buildingPermitForm]);
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
        $record = BuildingPermitForm::find($validated['id']);
        $record->update(["status" => $validated['status']]);

        return response()->json([
            'message' => 'Building permit form updated successfully!',
            'data' => $record
        ]);
    }
}
