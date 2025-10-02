<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Pokaż formularz logowania admina
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Obsłuż logowanie admina
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 👇 po zalogowaniu zawsze kieruj do panelu admina
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => '❌ Nieprawidłowe dane logowania.',
        ])->withInput();
    }

    /**
     * Wylogowanie admina
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login')->with('success', '✅ Wylogowano pomyślnie.');
    }
}
