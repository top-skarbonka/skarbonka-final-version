<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    /**
     * Formularz logowania administratora
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Obsługa logowania administratora
     */
    public function login(Request $request)
    {
        // 🧩 Walidacja pól logowania
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:4',
        ]);

        Log::info('🔍 Próba logowania admina: ' . $credentials['email']);

        // ✅ Próba logowania przez guard 'admin'
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            Log::info('✅ Zalogowano pomyślnie: ' . $credentials['email']);
            return redirect()->route('admin.dashboard')->with('success', 'Zalogowano pomyślnie!');
        }

        // ❌ Jeśli dane błędne — log i komunikat
        Log::warning('❌ Błędne dane logowania admina: ' . $credentials['email']);
        return back()->withErrors([
            'email' => 'Nieprawidłowy adres e-mail lub hasło.',
        ]);
    }

    /**
     * Wylogowanie administratora
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Log::info('👋 Wylogowano administratora.');

        return redirect()->route('admin.login')->with('success', 'Wylogowano pomyślnie.');
    }
}
