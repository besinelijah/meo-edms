<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPermitForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'client_no',
        'file_path',
        'isNew',
        'latitude',
        'longitude',
        'project_title',
        'requirement_id',
        'status',
    ];
}
