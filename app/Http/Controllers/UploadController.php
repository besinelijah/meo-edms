<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class UploadController extends Controller
{
    public function index() {
        $requirements = Requirement::getRequirements(5);

        return Inertia::render('Admin/Upload/Index', [
            'requirements' => $requirements,
        ]);
    }

    public function upload(Request $request)
    {
        $files = $request->allFiles();
        
        if ($request->hasFile('template')) {
            $path = Storage::disk('public')->put('templates', $request->template);
            $requirement = Requirement::find($request->requirement);
            $requirement->update(['template_file_path' => $path]);
        }
       
        return Redirect::route('admin.uploads.index');
    }
}