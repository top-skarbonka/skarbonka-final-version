<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Client;
use App\Models\PointTransaction;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // ✅ Lista firm i klientów
        $companies = Company::orderBy('id', 'asc')->get();
        $clients = Client::orderBy('id', 'asc')->get();

        // ✅ Statystyki tygodniowe
        $weeklyCompanies = Company::where('created_at', '>=', now()->subDays(7))->count();
        $weeklyClients = Client::where('created_at', '>=', now()->subDays(7))->count();
        $weeklyPoints = PointTransaction::where('created_at', '>=', now()->subDays(7))->sum('points');

        // ✅ Dane do wykresu — punkty przyznane w ostatnich 7 dniach
        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = Carbon::parse($day)->isoFormat('ddd'); // np. "pon", "wt", "śr"
            $chartData[] = PointTransaction::whereDate('created_at', $day)->sum('points');
        }

        // ✅ Zwrócenie widoku z danymi
        return view('admin.dashboard', compact(
            'companies',
            'clients',
            'weeklyCompanies',
            'weeklyClients',
            'weeklyPoints',
            'chartLabels',
            'chartData'
        ));
    }
}
