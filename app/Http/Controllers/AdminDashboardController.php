<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Client;
use App\Models\Point;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // 📊 Statystyki globalne
        $totalCompanies = Company::count();
        $totalClients = Client::count();
        $totalPoints = Point::sum('points_awarded');
        $activeCompanies = Company::where('status', 'active')->count();

        // 🏢 Ostatnio dodane firmy
        $recentCompanies = Company::latest()->take(5)->get();

        // 📈 Wykres – punkty z ostatnich 7 dni
        $pointsByDay = Point::selectRaw('DATE(created_at) as day, SUM(points_awarded) as total')
            ->whereBetween('created_at', [now()->subDays(6), now()])
            ->groupBy('day')
            ->pluck('total', 'day');

        return view('admin.dashboard', compact(
            'totalCompanies',
            'totalClients',
            'totalPoints',
            'activeCompanies',
            'recentCompanies',
            'pointsByDay'
        ));
    }
}
