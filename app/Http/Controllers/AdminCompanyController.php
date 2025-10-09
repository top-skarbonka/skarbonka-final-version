public function create()
{
    return view('admin.companies.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:companies',
        'nip' => 'nullable|string|unique:companies',
        'point_ratio' => 'required|numeric|min:0',
    ]);

    // generowanie ID firmy
    $prefix = strtoupper(substr($validated['name'], 0, 2));
    $companyId = $prefix . rand(10000, 99999);

    // generowanie hasła
    $plainPassword = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 8);

    $company = \App\Models\Company::create([
        'company_id' => $companyId,
        'name' => $validated['name'],
        'email' => $validated['email'],
        'nip' => $validated['nip'],
        'point_ratio' => $validated['point_ratio'],
        'status' => $request->input('status'),
        'password' => bcrypt($plainPassword),
    ]);

    // wysyłka maila do firmy
    \Mail::raw("Witaj w systemie! Twoje dane do logowania:\nID: {$companyId}\nEmail: {$company->email}\nHasło: {$plainPassword}\n\nPanel: https://35.205.107.27/company/login", function ($message) use ($company) {
        $message->to($company->email)
                ->subject('Dane do logowania — Top Skarbonka');
    });

    return redirect()->route('admin.companies.index')->with('success', '✅ Firma została dodana i otrzymała dane logowania.');
}
