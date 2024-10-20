<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasMany, HasOne};

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'birthday',
        'sex',
        'street',
        'brgy',
        'municipality',
        'province',
    ];

    public function log(): hasMany
    {
        return $this->hasMany(Log::class, 'client_id', 'id')->latest('id');
    }

    public function latestLogout(): HasOne
    {
        return $this->hasOne(Log::class, 'client_id', 'id')
            ->where('description', 'logout')
            ->latest('id');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'client_id');
    }

    public function clientUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'client_id')->where('isAdmin', 0);
    }
}
