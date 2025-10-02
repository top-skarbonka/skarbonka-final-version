<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Formularz logowania
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Obsługa logowania
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
            // Zaloguj admina do sesji
            session(['admin_id' => $admin->id]);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Zalogowano pomyślnie!');
        }

        return back()->withErrors([
            'email' => 'Nieprawidłowy login lub hasło.',
        ]);
    }

    // Wylogowanie
    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        return redirect()->route('admin.login')
            ->with('success', 'Wylogowano pomyślnie!');
    }
}
