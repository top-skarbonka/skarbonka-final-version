<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Point extends Model
{
    use HasFactory;

    protected $table = 'points';

    protected $fillable = [
        'company_id',
        'client_id',
        'receipt_number',
        'amount',
        'points_awarded',
    ];

    protected static function booted()
    {
        static::created(function ($point) {
            Log::info('💾 ZAPISANO REKORD DO BAZY:', $point->toArray());
        });
    }

    public function company()
    {
        return $this->belongsTo(\App\Models\Company::class, 'company_id');
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class, 'client_id');
    }
}
