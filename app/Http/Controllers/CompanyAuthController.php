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
     * Logowanie firmy
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'company_id' => 'required|string',
            'password'   => 'required|string',
        ]);

        // ✅ Próba logowania przez guard "company"
        if (Auth::guard('company')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('company.dashboard');
        }

        // ❌ Nieprawidłowe dane logowania
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

        return redirect()->route('company.login');
    }
}
