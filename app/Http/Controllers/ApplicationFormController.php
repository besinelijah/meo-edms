<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApplicationFormRequest;
use App\Models\{
    ApplicationDocument,
    ApplicationForm,
    Client,
    Notification,
    Requirement,
    User
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ApplicationFormController extends Controller
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
            $data = [
                'category' => $validated['category'],
                'client_id' => auth()->user()->client_id,
                'status' => "Pending",
                'project_title' => $validated['project_title'],
                'latitude' => $validated['latitude'] ?? null,
                'longitude' => $validated['longitude'] ?? null,
                'type' => $validated['type'],
            ];
         
            // $form = ApplicationForm::where('client_id', auth()->user()->client_id)
            // ->where('type', $validated['type'])
            // ->whereIn('status', ['Pending', 'Returned'])
            // ->first();
            
            // if ($form) {
            //     $form->update($data);
            // } else {
                $form = ApplicationForm::create($data);
            // }
            // $form = ApplicationForm::updateOrCreate(
            //     [
            //         'client_id' => auth()->user()->client_id,
            //         'type' => $validated['type'],
            //         'status' => "Pending",
            //     ],
                
            // );

            $files = $request->allFiles();
            foreach ($files as $key => $file) {
                if (is_array($file)) {
                    foreach ($file as $inputId => $uploadedFile) {
                        $path = $uploadedFile->store('applicationforms', 'public');
                        ApplicationDocument::updateOrCreate(
                            [
                                'requirement_id' => $inputId,
                                'application_form_id' => $form->id,
                            ],
                            [
                                'file_path' => $path,
                                'requirement_id' => $inputId,
                                'application_form_id' => $form->id,
                            ]
                        );
                    }
                } else {
                    $file->store('uploads', 'public'); // Save file to storage
                }
            }

            $notification = Notification::create([
                'description' => 'You have submitted an application form',
                'client_id' => auth()->user()->client_id,
                'application_form_id' => $form->id,
                'is_viewed' => true
            ]);
            // dd('success');
            return Redirect::route('applicationform')
                ->withToast('success', 'Application form submitted successfully!');
        } catch (\Throwable $th) {
            // return response()->json(["error" => $th->getMessage()]);
            return back()->withErrors([
                'error' => $th->getMessage()
            ]);
            // ->withToast('error', $th->getMessage());
            // return Redirect::route('applicationform')->withToast('error', $th->getMessage());
        }
    }

    public function getBusinessReqs() {
        $requirements = Requirement::getRequirements(5, 1);

        return Inertia::render('Client/Forms/BusinessPermitForm', [
            'requirements' => $requirements
        ]);
    }

    public function getBusinessRenewalReqs() {
        $requirements = Requirement::getRequirements(5, 3);

        return Inertia::render('Client/Forms/RenewalForm', [
            'requirements' => $requirements
        ]);
    }

    
    public function getBuildingReqs() {
        $requirements = Requirement::getRequirements(5, 2);
    
        return Inertia::render('Client/Forms/BldgPermitForm', [
            'requirements' => $requirements
        ]);
    }

    public function getSubmittedForms() {
        $records = ApplicationForm::with(['client', 'checkedBy'])
            ->where('client_id', auth()->user()->client_id)
            ->paginate(5); // Pagination with 5 records per page
    
        return Inertia::render('Client/SubmittedForms', [
            'records' => $records, // Passing paginated data
        ]);
    }
    
    

    public function getRecord(Request $request) {
        $id = $request->id;
        
        $form = ApplicationForm::find($id);

        $type = $form->type;
        $clientId = $form->client_id;
        $record = Requirement::getRequirementsWithApplicationForm($id, $clientId, 5, $type);
        $isApprove = ApplicationDocument::where('application_form_id',$form->id)->get();

        $client = Client::find($clientId);
 
        return Inertia::render('Client/ApplicationFormView', [
            'form' => $form,
            'record' => $record,
            'client' => $client,
            'typeProp' => $type,
            'params' => $request->only(['id', 'type', 'clientId']),
            'fileApprove'=>$isApprove
        ]);
    }
}
