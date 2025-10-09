<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyAuthController extends Controller
{
    /**
     * Formularz logowania firmy
     */
    public function showLoginForm()
    {
        return view('company.login');
    }

    /**
     * Logowanie firmy po ID i haśle
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'company_id' => 'required|string',
            'password'   => 'required|string',
        ]);

        // ✅ Próba logowania przy użyciu guard 'company'
        if (Auth::guard('company')->attempt([
            'company_id' => $credentials['company_id'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();
            return redirect()->route('company.dashboard')->with('success', 'Zalogowano pomyślnie ✅');
        }

        // ❌ Błąd logowania
        return back()->withErrors([
            'company_id' => '❌ Nieprawidłowe ID firmy lub hasło.',
        ])->onlyInput('company_id');
    }

    /**
     * Wylogowanie firmy
     */
    public function logout(Request $request)
    {
        Auth::guard('company')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('company.login')->with('success', 'Wylogowano pomyślnie.');
    }
}
