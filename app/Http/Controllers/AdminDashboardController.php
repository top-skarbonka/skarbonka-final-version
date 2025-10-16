<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Client;
use App\Models\PointTransaction;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    /**
     * Główna strona panelu administratora
     */
    public function index()
    {
        $companies = Company::orderBy('id', 'asc')->get();
        $clients = Client::orderBy('id', 'asc')->get();

        // Statystyki tygodniowe
        $weeklyCompanies = Company::where('created_at', '>=', now()->subDays(7))->count();
        $weeklyClients = Client::where('created_at', '>=', now()->subDays(7))->count();
        $weeklyPoints = PointTransaction::where('created_at', '>=', now()->subDays(7))->sum('points');

        // Dane do wykresu
        $chartLabels = [];
        $chartPoints = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = $day;
            $chartPoints[] = PointTransaction::whereDate('created_at', $day)->sum('points');
        }

        return view('admin.dashboard', compact(
            'companies',
            'clients',
            'weeklyCompanies',
            'weeklyClients',
            'weeklyPoints',
            'chartLabels',
            'chartPoints'
        ));
    }

    /**
     * Edycja firmy
     */
    public function editCompany($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.edit-company', compact('company'));
    }

    /**
     * Zawieszanie / odwieszanie firmy
     */
    public function toggleCompany($id)
    {
        $company = Company::findOrFail($id);
        $company->active = !$company->active;
        $company->save();

        Log::info('🔄 Zmieniono status firmy: ' . $company->email);

        return redirect()->back()->with('success', 'Status firmy został zaktualizowany.');
    }

    /**
     * Reset hasła firmy
     */
    public function resetCompanyPassword($id)
    {
        $company = Company::findOrFail($id);
        $newPassword = 'Firma' . rand(1000, 9999);
        $company->password = Hash::make($newPassword);
        $company->save();

        Log::info("🔐 Zresetowano hasło firmy {$company->email} — nowe: {$newPassword}");

        return redirect()->back()->with('success', "Hasło firmy zostało zresetowane. Nowe hasło: {$newPassword}");
    }

    /**
     * Usunięcie firmy
     */
    public function deleteCompany($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();

        Log::warning("🗑️ Usunięto firmę: {$company->email}");

        return redirect()->back()->with('success', 'Firma została usunięta.');
    }

    /**
     * Edycja klienta
     */
    public function editClient($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.edit-client', compact('client'));
    }

    /**
     * Zawieszanie / odwieszanie klienta
     */
    public function toggleClient($id)
    {
        $client = Client::findOrFail($id);
        $client->active = !$client->active;
        $client->save();

        Log::info('🔄 Zmieniono status klienta: ' . $client->email);

        return redirect()->back()->with('success', 'Status klienta został zaktualizowany.');
    }

    /**
     * Usunięcie klienta
     */
    public function deleteClient($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        Log::warning("🗑️ Usunięto klienta: {$client->email}");

        return redirect()->back()->with('success', 'Klient został usunięty.');
    }
}
