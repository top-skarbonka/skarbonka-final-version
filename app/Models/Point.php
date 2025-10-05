<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',   // firma, która przyznała punkty
        'client_id',    // klient, który otrzymał punkty
        'receipt_number', // numer paragonu
        'amount',       // kwota paragonu
        'points',       // przeliczone punkty
    ];

    /**
     * Relacja z firmą
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
