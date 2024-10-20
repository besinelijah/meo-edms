<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{ChangeStatusBuildingPermitFormRequest, StoreBusinessPermitFormRequest};
use App\Models\{
    BusinessPermitForm,
    Client
};
use Carbon\Carbon;
use Illuminate\Http\{
    JsonResponse,
    RedirectResponse,
    Request
};
use Illuminate\Support\Facades\{
    Auth,
    Redirect,
    Storage
};

class BusinessPermitFormController extends Controller
{
    /**
     * Store new business_permit_form record
     * 
     * @param Request $request
     * @return RedirectResponse 
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->all();

            $files = $request->allFiles();
            foreach ($files as $key => $file) {
                if (is_array($file)) {
                    foreach ($file as $inputId => $uploadedFile) {
                        $path = $uploadedFile->store('applicationforms', 'public');
                        BusinessPermitForm::updateOrCreate(
                            [
                                'isNew' => $validated['isNew'],
                                'project_title' => $validated['project_title'],
                                'client_no' => auth()->user()->client_id,
                                'requirement_id' => $inputId
                            ],
                            [
                                'category' => $validated['category'],
                                'client_no' => auth()->user()->client_id,
                                'file_path' => $path,
                                'isNew' => $validated['isNew'],
                                'latitude' => $validated['latitude'] ?? null,
                                'longitude' => $validated['longitude'] ?? null,
                                'project_title' => $validated['project_title'],
                                'requirement_id' => $inputId,
                                'status' => "Pending"
                            ]
                        );
                    }
                } else {
                    $file->store('uploads', 'public'); // Save file to storage
                }
            }
            return Redirect::route('applicationform')
                ->withToast('success', 'Application form submitted successfully!');
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

    /**
     * Calculate age based on birtdate
     * 
     * @param string|null $date. Date of Birth
     * @return int|null
     */
    private function calculateAge(?string $date): ?int
    {
        if (is_null($date)) {
            return null;
        }
    
        $birthdate = Carbon::parse($date);
        $today = Carbon::now();
        $age = $today->diffInYears($birthdate);

        return $age;
    }
}
