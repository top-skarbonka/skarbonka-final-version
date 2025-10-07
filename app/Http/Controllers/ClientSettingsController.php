<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Point;

class ClientSettingsController extends Controller
{
    public function edit()
    {
        $client = Client::first(); // tymczasowo pierwszy klient (testowo)
        $points = Point::where('client_id', $client->id)->sum('amount');

        return view('client.consents', compact('client', 'points'));
    }

    public function update(Request $request)
    {
        $client = Client::first(); // tymczasowo pierwszy klient (testowo)

        // Zapisz stare zgody (przed zmianą)
        $oldConsents = [
            'sms' => $client->consent_sms,
            'email' => $client->consent_email,
            'personal' => $client->consent_personal,
        ];

        // Zaktualizuj zgody
        $client->update([
            'consent_sms' => $request->has('consent_sms'),
            'consent_email' => $request->has('consent_email'),
            'consent_personal' => $request->has('consent_personal'),
        ]);

        // Licznik nowych punktów
        $newPoints = 0;

        // Przyznaj punkty TYLKO jeśli wcześniej zgoda była NIEaktywna, a teraz TAK
        if (!$oldConsents['sms'] && $client->consent_sms) {
            $newPoints += 100;
        }
        if (!$oldConsents['email'] && $client->consent_email) {
            $newPoints += 100;
        }
        if (!$oldConsents['personal'] && $client->consent_personal) {
            $newPoints += 100;
        }

        // Jeśli są nowe zgody – dodaj punkty
        if ($newPoints > 0) {
            Point::create([
                'client_id' => $client->id,
                'amount' => $newPoints,
                'source' => 'Zgody marketingowe',
            ]);
        }

        // Oblicz aktualny stan punktów
        $totalPoints = Point::where('client_id', $client->id)->sum('amount');

        // Przygotuj komunikat
        $message = $newPoints > 0
            ? "Zgody zostały zaktualizowane ✅ i przyznano $newPoints Top Points 💎"
            : "Zgody zostały zaktualizowane ✅ (bez nowych punktów)";

        return back()->with([
            'success' => $message,
            'points' => $totalPoints,
        ]);
    }
}
