<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        'source',
    ];

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
