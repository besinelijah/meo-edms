<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApplicationForm extends Model
{
    use HasFactory;

    // protected $table = 'view_application_forms';
    // public $timestamps = false;

    protected $fillable = [
        'category',
        'client_id',
        'status',
        'project_title',
        'latitude',
        'longitude',
        'type',
        'remarks',
        'checked_by'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function checkedBy(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'checked_by', 'id');
    }

    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class, 'application_form_id', 'id');
    }

    public static function getTotalRecord(int $type)
    {
        return self::where('type', $type)->count();
    }

    public static function getTotalRecordToday(int $type)
    {
        return self::where('type', $type)
            ->whereDate('created_at', Carbon::today())
            ->count();
    }

    public static function getTotalApprove(int $type)
    {
        return self::where('type', $type)
            ->where('status',"Approved")
            ->whereDate('created_at', Carbon::today())
            ->count();
    }
}
