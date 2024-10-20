<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'client_id',
        'email',
        'password',
        'isAdmin',
        'contact_number',
        'username'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->isAdmin === 1;
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class, 'client_id', 'id');
    }

    public function client(): HasOne
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function sent_messages()
    {
        return $this->hasMany(ChatMessage::class, 'sender_id');
    }

    public function received_messages()
    {
        return $this->hasMany(ChatMessage::class, 'receiver_id');
    }

    public function latestMessage()
    {
        return $this->sent_messages()
            ->union($this->received_messages())
            ->latest('created_at')
            ->first();
    }
}
