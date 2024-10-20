<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\{ChangeStatusBuildingPermitFormRequest, StoreBuildingPermitFormRequest, StoreBusinessPermitFormRequest};
use App\Models\{
    BuildingPermitForm,
    BusinessPermitForm,
    Client
};
use Carbon\Carbon;
use Illuminate\Http\{
    RedirectResponse,
};
use Illuminate\Support\Facades\{
    Auth,
    Redirect,
    Storage
};

class BuildingPermitFormController extends Controller
{
    /**
     * Store new building_permit_form record
     * 
     * @param StoreBuildingPermitFormRequest $request
     * @return RedirectResponse 
     */
    public function store(StoreBuildingPermitFormRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $client = Client::find(Auth::user()->client_id);

            if ($client) {
                $data = [
                    'applicant_fname' => $client->fname,
                    'applicant_mname' => $client->mname,
                    'applicant_lname' => $client->lname,
                    'applicant_age' => $this->calculateAge($client->birthday),
                    'applicant_sex' => $client->sex,
                    'applicant_street' => $client->street,
                    'applicant_brgy' => $client->brgy,
                    'applicant_municipality' => $client->municipality,
                    'applicant_province' => $client->province,
                    'client_no' => $client->id,
                    'status' => "Pending",
                ];

                $validated = array_merge($data, $validated);
            }

            $files = $request->allFiles();

            foreach ($files as $key => $file) {
                if ($request->hasFile($key)) {
                    $validated[$key] = Storage::disk('public')->put('applicationform', $file);
                }
            }

            BuildingPermitForm::create($validated);

            return Redirect::route('applicationform')
            ->withToast('success', 'Application form submitted successfully!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return Redirect::route('applicationform')
            ->withToast('error', $th->getMessage());
        }
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
