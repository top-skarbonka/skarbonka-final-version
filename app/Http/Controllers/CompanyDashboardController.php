<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CompanyDashboardController extends Controller
{
    // 📊 Panel główny firmy
    public function index()
    {
        $company = Auth::guard('company')->user();

        // 🧮 Statystyki punktów
        $weeklyPoints = Point::where('company_id', $company->id)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->sum('points_awarded');

        $monthlyPoints = Point::where('company_id', $company->id)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->sum('points_awarded');

        $yearlyPoints = Point::where('company_id', $company->id)
            ->where('created_at', '>=', Carbon::now()->subDays(365))
            ->sum('points_awarded');

        // 📈 Dane do wykresu (ostatnie 7 dni)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $points = Point::where('company_id', $company->id)
                ->whereDate('created_at', $date)
                ->sum('points_awarded');
            $chartData[] = ['date' => $date, 'points' => $points];
        }

        // 📋 Historia ostatnich 20 przyznań punktów
        $pointsHistory = Point::where('company_id', $company->id)
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('company.dashboard', compact(
            'company',
            'weeklyPoints',
            'monthlyPoints',
            'yearlyPoints',
            'chartData',
            'pointsHistory'
        ));
    }

    // 🪙 Dodawanie punktów
    public function addPoints(Request $request)
    {
        try {
            \Log::info('📥 addPoints() dane wejściowe:', $request->all());

            $validated = $request->validate([
                'client_id' => 'required|string',
                'receipt_number' => 'required|string|max:255',
                'amount' => 'required|numeric|min:1',
            ]);

            $company = auth('company')->user();

            if (!$company) {
                \Log::error('❌ Firma nie jest zalogowana!');
                return back()->with('error', 'Błąd autoryzacji firmy.');
            }

            $ratio = $company->point_ratio ?? 1.0;
            $points = $validated['amount'] * $ratio;

            $record = Point::create([
                'company_id' => $company->id,
                'client_id' => $validated['client_id'],
                'receipt_number' => $validated['receipt_number'],
                'amount' => $validated['amount'],
                'points_awarded' => $points,
            ]);

            \Log::info('💾 ZAPISANO REKORD DO BAZY:', $record->toArray());
            return back()->with('success', 'Punkty dodane pomyślnie!');
        } catch (\Exception $e) {
            \Log::error('❌ Błąd addPoints(): ' . $e->getMessage());
            return back()->with('error', 'Błąd podczas dodawania punktów.');
        }
    }
}
