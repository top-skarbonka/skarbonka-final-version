<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Company;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class ClientRegisterController extends Controller
{
    /**
     * Formularz rejestracji klienta
     */
    public function showForm()
    {
        return view('client.register');
    }

    /**
     * Rejestracja klienta + generowanie QR + przypisanie firmy
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'referral_code' => 'nullable|string|max:10',
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:clients,email',
            'phone'         => 'nullable|string|max:20',
            'postal_code'   => 'required|string|max:10',
            'city'          => 'required|string|max:100',
            'birth_year'    => 'nullable|integer|min:1900|max:' . date('Y'),
            'gender'        => 'nullable|string|max:20',
            'accept_terms'  => 'required|boolean',
            'accept_rodo'   => 'required|boolean',
            'accept_marketing' => 'nullable|boolean',
            'accept_phone'     => 'nullable|boolean',
            'accept_profiling' => 'nullable|boolean',
        ]);

        // 🪪 Unikalny identyfikator klienta
        $clientCode = strtoupper(Str::random(8));

        // 🎯 Sprawdzenie kodu polecającego
        $companyId = null;
        if (!empty($validated['referral_code'])) {
            $company = Company::where('company_id', $validated['referral_code'])->first();
            if ($company) {
                $companyId = $company->id;
            }
        }

        // 🎁 Punkty startowe za zgody
        $bonusPoints = 0;
        if (!empty($validated['accept_marketing'])) $bonusPoints += 100;
        if (!empty($validated['accept_phone'])) $bonusPoints += 100;
        if (!empty($validated['accept_profiling'])) $bonusPoints += 100;

        // 💾 Zapis klienta
        $client = Client::create([
            'client_code'     => $clientCode,
            'name'            => $validated['name'],
            'email'           => $validated['email'],
            'phone'           => $validated['phone'] ?? null,
            'postal_code'     => $validated['postal_code'],
            'city'            => $validated['city'],
            'birth_year'      => $validated['birth_year'] ?? null,
            'gender'          => $validated['gender'] ?? null,
            'accept_terms'    => $validated['accept_terms'],
            'accept_rodo'     => $validated['accept_rodo'],
            'accept_marketing'=> $validated['accept_marketing'] ?? false,
            'accept_phone'    => $validated['accept_phone'] ?? false,
            'accept_profiling'=> $validated['accept_profiling'] ?? false,
            'points'          => $bonusPoints,
            'company_id'      => $companyId,
            'password'        => Hash::make(Str::random(10)), // placeholder
        ]);

        // 🧠 Baner przypisany po kodzie pocztowym (np. firmy lokalne)
        $bannerPath = $this->assignBanner($validated['postal_code']);

        // 🧩 Generowanie QR z logo w środku
        $qrPath = 'qrcodes/' . $clientCode . '.png';
        $logoUrl = 'http://top-price.com.pl/wp-content/uploads/2025/09/top-skarbonka.png';
        $qr = QrCode::format('png')
            ->size(300)
            ->merge($logoUrl, 0.3, true)
            ->color(100, 40, 150)
            ->backgroundColor(255, 255, 255)
            ->generate("https://35.205.107.27/client/qr/{$clientCode}");

        Storage::disk('public')->put($qrPath, $qr);

        // ✉️ Ewentualne wysłanie maila z potwierdzeniem (opcjonalne)
        // Mail::to($client->email)->send(new ClientWelcomeMail($client));

        return view('client.qr', [
            'client' => $client,
            'qrPath' => $qrPath,
            'bannerPath' => $bannerPath,
        ]);
    }

    /**
     * Funkcja przypisująca baner po regionie (kodzie pocztowym)
     */
    private function assignBanner($postalCode)
    {
        $region = substr($postalCode, 0, 2);
        switch ($region) {
            case '35': return 'banners/rzeszow.png';
            case '00': return 'banners/warszawa.png';
            case '80': return 'banners/gdansk.png';
            default:   return 'banners/default.png';
        }
    }
}
