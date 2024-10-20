<?php

namespace App\Http\Controllers;

use App\Models\{
    ApplicationForm,
    Category,
    History,
    Requirement
};
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    protected $history;

    public function __construct(History $history)
    {
        $this->history = $history;
    }

    public function index() {
        $history = $this->history->histories(5);
        $queue = ApplicationForm::with('client')->limit(5)->get();

        $applicationTypes = [
            'businessPermit' => 1,
            'building' => 2,
            'renewal' => 3,
        ];

        $totals = [];
        $totalsToday = [];
        $totalsApproved = [];

        foreach ($applicationTypes as $key => $type) {
            $totals[$key] = ApplicationForm::getTotalRecord($type);
            $totalsToday[$key] = ApplicationForm::getTotalRecordToday($type);
            $totalsApproved[$key] = ApplicationForm::getTotalApprove($type);
        } 
        return Inertia::render('Admin/Dashboard/Index', [
            'data' => compact([
                'history',
                'queue',
                'totals',
                'totalsToday',
                'totalsApproved'
            ]),
        ]);
    }

    public function addCategory(Request $request)
    {
        Category::createRecord($request->category);
    }
    
    public function getBusinessRenewalReqs() {
        $requirements = Requirement::getRequirements(null, 3);
        
        return Inertia::render('Admin/Dashboard/Partials/AdminDocumentViewRenewalPermit', [
            'requirements' => $requirements
        ]);
    }

    public function getBusinessReqs() {
        $requirements = Requirement::getRequirements(null, 1);

        return Inertia::render('Admin/Dashboard/Partials/AdminDocumentViewBusinessPermit', [
            'requirements' => $requirements
        ]);
    }

    public function getBuildingReqs() {
        $requirements = Requirement::getRequirements(null, 2);

        return Inertia::render('Admin/Dashboard/Partials/AdminDocumentViewBldgPermit', [
            'requirements' => $requirements
        ]);
    }
}