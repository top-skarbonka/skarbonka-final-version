<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Mail\CompanyRegisteredMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Lista firm
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Formularz dodawania nowej firmy
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Zapis nowej firmy
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'city'        => 'nullable|string|max:100',
            'street'      => 'nullable|string|max:255',
            'nip'         => 'nullable|string|max:20',
            'email'       => 'required|email|unique:companies,email',
            'phone'       => 'nullable|string|max:50',
            'point_ratio' => 'nullable|numeric|min:0.1|max:10',
        ]);

        // wygeneruj hasło plain
        $plainPassword = Str::random(10);

        // utwórz firmę
        $company = Company::create(array_merge($validated, [
            'password'       => bcrypt($plainPassword),
            'plain_password' => $plainPassword,
        ]));

        // wyślij maila
        Mail::to($company->email)->send(new CompanyRegisteredMail($company, $plainPassword));

        // komunikat sukcesu z ID i hasłem
        return redirect()->route('companies.index')
            ->with('success', "
                ✅ Firma została zarejestrowana pomyślnie!<br>
                📌 ID firmy: <strong>{$company->company_code}</strong><br>
                🔑 Hasło: <strong>{$plainPassword}</strong><br>
                ✉️ Dane logowania zostały wysłane również na e-mail: {$company->email}
            ");
    }

    /**
     * Formularz edycji
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Aktualizacja danych
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'city'        => 'nullable|string|max:100',
            'street'      => 'nullable|string|max:255',
            'nip'         => 'nullable|string|max:20',
            'email'       => 'required|email|unique:companies,email,' . $company->id,
            'phone'       => 'nullable|string|max:50',
            'status'      => 'nullable|string|max:50',
            'point_ratio' => 'nullable|numeric|min:0.1|max:10',
        ]);

        $company->update($validated);

        return redirect()->route('companies.index')
            ->with('success', '✅ Dane firmy zostały zaktualizowane.');
    }

    /**
     * Usuwanie
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', '🗑️ Firma została usunięta.');
    }
}
