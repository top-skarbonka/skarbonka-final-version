<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAuthController extends Controller
{
    // Formularz logowania
    public function showLoginForm()
    {
        return view('company.login');
    }

    // Obsługa logowania
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'company_id' => 'required|string',
            'password'   => 'required|string',
        ]);

        if (Auth::guard('company')->attempt([
            'company_id' => $credentials['company_id'],
            'password'   => $credentials['password'],
        ])) {
            $request->session()->regenerate();

            // ✅ poprawka — kierujemy na dashboard firmy
            return redirect()->route('company.dashboard');
        }

        return back()->with('error', '❌ Błędne ID lub hasło.');
    }

    // Wylogowanie
    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('company.login');
    }
}
