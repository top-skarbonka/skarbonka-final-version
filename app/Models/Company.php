<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'company_id',
        'invite_code',
        'company_code',
        'name',
        'postal_code',
        'city',
        'street',
        'nip',
        'email',
        'phone',
        'point_ratio',
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 🔑 Klucz logowania — używamy company_id zamiast email
    public function getAuthIdentifierName()
    {
        return 'company_id';
    }
}
