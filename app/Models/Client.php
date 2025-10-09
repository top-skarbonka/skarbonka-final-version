<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // 🔹 Relacja z firmą, która poleciła klienta
    public function referrer()
    {
        return $this->belongsTo(\App\Models\Company::class, 'referred_by');
    }

    // 🔹 Relacja z punktami przypisanymi do klienta
    public function points()
    {
        return $this->hasMany(\App\Models\Point::class);
    }

    // 🔹 Nazwa tabeli w bazie
    protected $table = 'clients';

    // 🔹 Pola, które można wypełniać masowo
    protected $fillable = [
        'name',
        'email',
        'referred_by',
    ];
}
