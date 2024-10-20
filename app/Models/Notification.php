<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'description',
        'client_id',
        'application_form_id',
        'is_viewed'
    ];

    public function applicationForm(): BelongsTo
    {
        return $this->belongsTo(ApplicationForm::class, 'application_form_id', 'id');
    }
}
