<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subcategory_id',
        'name',
        'template_file_path',
        'isRequired',
        'permit_type',
    ];
    protected $table = 'requirements';

    public static function getRequirements(?int $page = null, $type = 0)
    {
        $result = self::selectRaw('
            categories.id AS category_id,
            categories.category_name AS category_name,
            requirements.id AS requirements_id,
            requirements.id AS value,
            requirements.name AS requirements_name,
            requirements.name AS label,
            requirements.template_file_path AS template_file_path,
            requirements.permit_type as permit_type,
            CASE requirements.permit_type
                WHEN 1 THEN "Business permit(new)"
                WHEN 3 THEN "Business permit(renew)"
                ELSE "Building permit"
            END AS permit_type_name,
            subcategories.id AS subcategory_id,
            subcategories.subcategory_name AS subcategory_name
        ')
        ->join('subcategories', 'subcategories.id', 'requirements.subcategory_id')
        ->join('categories', 'categories.id', 'subcategories.category_id')
        ->orderBy('categories.id')
        ->orderBy('subcategories.id')
        ->orderBy('requirements.id');

        if ($type != 0) {
            $result->where('permit_type', $type);
        }

        if (is_null($page)) {
            return $result->get();
        }

        return $result->paginate($page);
    }

    public static function getRequirementsWithApplicationForm(
        $id,
        $clientId,
        ?int $page = null,
        $type = null
    ) {
        $result = self::selectRaw('
            categories.id AS category_id,
            categories.category_name AS category_name,
            requirements.id AS requirements_id,
            requirements.name AS requirements_name,
            requirements.template_file_path AS template_file_path,
            requirements.permit_type as permit_type,
            CASE requirements.permit_type
                WHEN 1 THEN "Business permit(new)"
                WHEN 2 THEN "Business permit(renew)"
                ELSE "Building permit"
            END AS permit_type_name,
            subcategories.id AS subcategory_id,
            subcategories.subcategory_name AS subcategory_name,
            application_forms.category,
            application_forms.latitude,
            application_forms.longitude,
            application_forms.project_title,
            application_documents.id AS document_id,
            application_documents.remarks AS document_remarks,
            application_documents.file_path,
            application_documents.application_form_id
        ')
        ->join('subcategories', 'subcategories.id', 'requirements.subcategory_id')
        ->join('categories', 'categories.id', 'subcategories.category_id')
        ->leftJoin('application_documents', function ($join) use ($id) {
            $join->on('application_documents.requirement_id', 'requirements.id')
                ->where('application_documents.application_form_id', $id);
        })
        ->leftJoin('application_forms', function ($join) use ($type, $clientId) {
            $join->on('application_forms.id', 'application_documents.application_form_id')
            ->where('application_forms.type', $type);
            // ->where('application_forms.client_id', $clientId);
        })
        ->orderBy('categories.id')
        ->orderBy('subcategories.id')
        ->orderBy('requirements.id');

        $result->where('requirements.permit_type', $type);

        if (is_null($page)) {
            return $result->get();
        }

        return $result->paginate($page);
    }
}
