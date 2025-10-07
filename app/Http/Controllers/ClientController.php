<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Point;
use App\Models\Banner;

class ClientController extends Controller
{
    /**
     * Formularz rejestracji klienta
     */
    public function showRegisterForm()
    {
        return view('client.register');
    }

    /**
     * Rejestracja nowego klienta
     */
    public function register(Request $request)
    {
        // Walidacja tylko tych pól, które istnieją
        $validated = $request->validate([
            'email' => 'required|email|unique:clients,email',
            'name' => 'nullable|string|max:255',
        ]);

        // Dodajemy domyślną nazwę jeśli nie podano
        $validated['name'] = $validated['name'] ?? 'Nowy Klient';

        // Tworzymy rekord klienta
        $client = Client::create([
            'email' => $validated['email'],
            'name'  => $validated['name'],
        ]);

        // Przygotowanie do przyszłych funkcji (bonusy, zgody itd.)
        $bonus = 0;

        // Na przyszłość: jeśli klient doda telefon lub zgody, tu przyznamy punkty
        // if ($request->has('consent_sms')) $bonus += 100; itd.

        if ($bonus > 0) {
            Point::create([
                'client_id'      => $client->id,
                'company_id'     => null,
                'receipt_number' => 'BONUS',
                'amount'         => 0,
                'points'         => $bonus,
            ]);
        }

        // Generujemy unikalny kod (na przyszłość do QR)
        $clientCode = strtoupper(Str::random(10));
        $client->update(['client_code' => $clientCode]);

        // Przekierowanie do QR
        return redirect()
            ->route('client.qr', ['id' => $client->id])
            ->with('success', "✅ Rejestracja zakończona! Przyznano $bonus punktów bonusowych.");
    }

    /**
     * Wyświetlanie kodu QR klienta
     */
    public function showQr($id)
    {
        $client = Client::findOrFail($id);
        $qrUrl = url('/company/login?client_id=' . $client->client_code);

        return view('client.qr', [
            'client' => $client,
            'qrUrl'  => $qrUrl,
        ]);
    }

    /**
     * Dashboard klienta
     */
    public function dashboard()
    {
        // Tymczasowo pobieramy pierwszego klienta (dopóki nie ma logowania)
        $client = Client::first();

        if (!$client) {
            return redirect()->route('client.register')->with('error', 'Brak danych klienta.');
        }

        // Suma punktów
        $points = Point::where('client_id', $client->id)->sum('points');

        // Pobieramy 3 aktywne banery dopasowane do kodu pocztowego
        $banners = Banner::where(function ($q) use ($client) {
                $q->where('postal_code', $client->postal_code)
                  ->orWhereNull('postal_code');
            })
            ->where('active', true)
            ->take(3)
            ->get();

        return view('client.dashboard', compact('client', 'points', 'banners'));
    }
}
