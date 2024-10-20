<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'requirement_id',
        'application_form_id',
        'remarks',
        'is_file_approve'
    ];
    
}
