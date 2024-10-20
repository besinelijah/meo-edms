<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Requirement,
    Subcategory
};
use Illuminate\Http\Request;
use Inertia\Inertia;

class DocumentController extends Controller
{
    public function index()
    {
        $categories = Category::selectRaw(
            'id,
            category_name,
            id AS value,
            category_name as label'
        )->get();

        $subcategories = Subcategory::with('category')
            ->selectRaw(
                'category_id,
                id,
                subcategory_name,
                id AS value,
                subcategory_name as label',
            )
            ->get();

        $requirements = Requirement::getRequirements();

        return Inertia::render('Admin/Document/Index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'requirements' => $requirements,
        ]);
    }


    public function addCategory(Request $request)
    {
            Category::create(['category_name' => $request->category]);
        
    }

    public function deleteCategory(Category $id)
    {
        $id->delete();
    }

    public function addSubcategory(Request $request)
    {
        Subcategory::create([
            'subcategory_name' => $request->subcategory,
            'category_id' => $request->category,
        ]);
    }

    public function deleteSubcategory(Subcategory $id)
    {
        $id->delete();
    }

    public function addRequirement(Request $request)
    {
        Requirement::create([
            'subcategory_id' => $request->subcategory,
            'name' => $request->requirement,
            'permit_type' => $request->type,
        ]);
    }

    public function deleteRequirement(Requirement $id)
    {
        $id->delete();
    }
}
