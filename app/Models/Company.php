<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class Company extends Authenticatable
{
    use HasFactory;

    // To nie zapisuje się do bazy – tylko do wysyłki mailem
    public $plain_password;

    protected $fillable = [
        'name',
        'postal_code',
        'city',
        'street',
        'nip',
        'email',
        'phone',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($company) {
            // company_id: 2 litery nazwy firmy + 5 cyfr
            $prefix = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $company->name), 0, 2));

            if (strlen($prefix) < 2) {
                $prefix = str_pad($prefix, 2, 'X'); // np. brak liter -> XX
            }

            $randomId = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $company->company_id = $prefix . $randomId;

            // Losowe hasło: 5 cyfr
            $plainPassword = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
            $company->password = Hash::make($plainPassword);

            // zapamiętujemy hasło w postaci jawnej (do wysyłki mailem)
            $company->plain_password = $plainPassword;
        });
    }

    // 🔹 Relacja: firma ma wielu klientów
    public function clients()
    {
        return $this->hasMany(\App\Models\Client::class, 'referred_by');
    }
}
