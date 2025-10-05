<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    // Dla pewności wskazujemy nazwę tabeli
    protected $table = 'clients';

    // Pola, które można wypełniać masowo
    protected $fillable = [
        'name',
        'email',
    ];
}
