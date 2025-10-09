<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Wyświetla listę firm
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Formularz dodawania nowej firmy
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Zapisuje nową firmę w bazie
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
        ]);

        Company::create($validated);

        return redirect()->route('companies.index')
            ->with('success', 'Firma została zarejestrowana.');
    }

    /**
     * Wyświetla szczegóły firmy (opcjonalne)
     */
    public function show(Company $company)
    {
        return view('admin.companies.show', compact('company'));
    }

    /**
     * Formularz edycji firmy
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Aktualizuje firmę
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
        ]);

        $company->update($validated);

        return redirect()->route('companies.index')
            ->with('success', 'Dane firmy zostały zaktualizowane.');
    }

    /**
     * Usuwa firmę (soft delete)
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Firma została usunięta.');
    }
}
