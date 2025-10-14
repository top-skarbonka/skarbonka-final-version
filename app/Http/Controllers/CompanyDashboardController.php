<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Point;
use Illuminate\Support\Facades\Log;

class CompanyDashboardController extends Controller
{
    public function index()
    {
        // ✅ Pobierz zalogowaną firmę
        $company = auth('company')->user();

        if (!$company) {
            return redirect()->route('company.login')->with('error', 'Musisz być zalogowany jako firma.');
        }

        // ✅ Statystyki
        $weeklyPoints = Point::where('company_id', $company->id)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->sum('points_awarded');

        $monthlyPoints = Point::where('company_id', $company->id)
            ->whereMonth('created_at', now()->month)
            ->sum('points_awarded');

        $yearlyPoints = Point::where('company_id', $company->id)
            ->whereYear('created_at', now()->year)
            ->sum('points_awarded');

        $chartData = Point::where('company_id', $company->id)
            ->orderBy('created_at')
            ->get(['created_at', 'points_awarded']);

        // ✅ PRZEKAZUJEMY $company do widoku!
        return view('company.dashboard', [
            'company' => $company,
            'weeklyPoints' => $weeklyPoints,
            'monthlyPoints' => $monthlyPoints,
            'yearlyPoints' => $yearlyPoints,
            'chartData' => $chartData,
        ]);
    }

    public function addPoints(Request $request)
    {
        try {
            Log::info('📥 addPoints() dane wejściowe:', $request->all());

            $validated = $request->validate([
                'client_id' => 'required|string',
                'receipt_number' => 'required|string|max:255',
                'amount' => 'required|numeric|min:1',
            ]);

            $company = auth('company')->user();
            if (!$company) {
                Log::error('❌ Firma nie jest zalogowana!');
                return back()->with('error', 'Błąd autoryzacji firmy.');
            }

            $ratio = $company->point_ratio ?? 0.5;
            $points = $validated['amount'] * $ratio;

            Point::create([
                'company_id' => $company->id,
                'client_id' => $validated['client_id'],
                'receipt_number' => $validated['receipt_number'],
                'amount' => $validated['amount'],
                'points_awarded' => $points,
            ]);

            Log::info('✅ Punkty zapisane pomyślnie!', [
                'client_id' => $validated['client_id'],
                'company_id' => $company->id,
                'points' => $points,
            ]);

            return back()->with('success', 'Punkty dodane pomyślnie!');
        } catch (\Exception $e) {
            Log::error('❌ Błąd addPoints(): ' . $e->getMessage());
            return back()->with('error', 'Błąd podczas dodawania punktów.');
        }
    }
}
