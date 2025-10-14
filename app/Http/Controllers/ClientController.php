<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ClientController extends Controller
{
    public function showRegisterForm()
    {
        return view('client.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'postal_code' => 'required|string|max:10',
            'city' => 'required|string|max:100',
            'phone' => 'nullable|string|max:20',
            'birth_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'gender' => 'nullable|string|in:male,female,other',
            'consent_terms' => 'accepted',
            'consent_rodo' => 'accepted'
        ]);

        // 🔢 Unikalny 4-cyfrowy kod klienta
        $clientCode = rand(1000, 9999);

        // 🎁 Punkty bonusowe
        $bonusPoints = 0;
        if ($request->filled('phone')) $bonusPoints += 100;
        if ($request->filled('birth_year')) $bonusPoints += 100;
        if ($request->filled('gender')) $bonusPoints += 100;

        // 📦 Zapis do bazy
        $client = Client::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'postal_code' => $validated['postal_code'],
            'city' => $validated['city'],
            'phone' => $request->phone,
            'birth_year' => $request->birth_year,
            'gender' => $request->gender,
            'client_code' => $clientCode,
            'points' => $bonusPoints
        ]);

        // 🌐 Link QR do logowania firmy z ID klienta
        $qrUrl = url('/company/login?client_id=' . $client->client_code);

        // 📸 Generowanie kodu QR
        $qrFile = 'storage/qrcodes/client_' . $client->id . '.png';
        $qrPath = public_path($qrFile);

        if (!is_dir(dirname($qrPath))) {
            mkdir(dirname($qrPath), 0755, true);
        }

        QrCode::format('png')
            ->size(300)
            ->color(87, 0, 255)
            ->generate($qrUrl, $qrPath);

        // ✅ Potwierdzenie rejestracji
        return view('client.qr-landing', [
            'client' => $client,
            'qrPath' => asset($qrFile),
            'bonusPoints' => $bonusPoints
        ]);
    }
}
