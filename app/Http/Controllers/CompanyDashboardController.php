<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Point;
use App\Models\Client;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        // 🔒 Pobierz zalogowaną firmę
        $company = Auth::guard('company')->user();

        // 🧮 Statystyki firmy
        $totalPoints = Point::where('company_id', $company->id)->sum('points_awarded');
        $clientsCount = Client::where('referred_by', $company->id)->count();
        $monthPoints = Point::where('company_id', $company->id)
            ->whereMonth('created_at', now()->month)
            ->sum('points_awarded');

        // 📊 Dane do wykresu — punkty z bieżącego tygodnia
        $weeklyPoints = Point::selectRaw('DATE(created_at) as day, SUM(points_awarded) as total')
            ->where('company_id', $company->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        // 🔁 Zwróć widok panelu z danymi
        return view('company.dashboard', compact(
            'company',
            'totalPoints',
            'clientsCount',
            'monthPoints',
            'weeklyPoints'
        ));
    }
}
