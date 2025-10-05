<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'client_id',
        'receipt_number',
        'amount',
        'points_awarded',
    ];

    // Relacja z firmą
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
