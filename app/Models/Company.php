<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'password',
        'status',
        'point_ratio',
        'postal_code',
        'city',
        'street',
        'nip',
        'phone',
        'banner_path',
        'invite_code',
        'company_code'
    ];

    protected $hidden = [
        'password',
    ];
}
