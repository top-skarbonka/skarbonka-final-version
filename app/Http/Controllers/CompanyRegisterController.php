<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Company;
use Illuminate\Support\Str;

class CompanyRegisterController extends Controller
{
    /**
     * Formularz rejestracji firmy
     */
    public function showForm()
    {
        return view('company.register');
    }

    /**
     * Zapis nowej firmy do bazy + wysłanie maila z danymi
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:255',
            'postal_code'  => 'required|string|max:10',
            'city'         => 'required|string|max:100',
            'street'       => 'required|string|max:255',
            'nip'          => 'required|string|max:20',
            'email'        => 'required|email|unique:companies,email',
            'phone'        => 'required|string|max:20',
            'point_ratio'  => 'required|numeric|min:0.01',
            'start_points' => 'nullable|numeric|min:0',
        ]);

        // 🔑 Generowanie ID firmy, hasła i kodu polecającego
        $companyId = strtoupper(Str::random(6));
        $plainPassword = Str::random(8);
        $inviteCode = strtoupper(substr($validated['name'], 0, 3)) . '-' . strtoupper(Str::random(5));

        // 💾 Zapis firmy w bazie danych
        $company = Company::create([
            'company_id'   => $companyId,
            'invite_code'  => $inviteCode,
            'name'         => $validated['name'],
            'postal_code'  => $validated['postal_code'],
            'city'         => $validated['city'],
            'street'       => $validated['street'],
            'nip'          => $validated['nip'],
            'email'        => $validated['email'],
            'phone'        => $validated['phone'],
            'point_ratio'  => $validated['point_ratio'] ?? 1.00,
            'start_points' => $validated['start_points'] ?? 0,
            'password'     => Hash::make($plainPassword),
        ]);

        // 📧 Treść wiadomości e-mail
        $messageBody = <<<EOT
Witaj {$company->name}!

Twoja firma została pomyślnie zarejestrowana w systemie Top Skarbonka 🎉

Dane logowania:
🆔 ID firmy: {$companyId}
🔑 Hasło: {$plainPassword}
🎟️ Kod polecający: {$inviteCode}

💰 Przelicznik punktów: 1 zł = {$company->point_ratio} Top Points
🎁 Punkty startowe: {$company->start_points}

Zaloguj się tutaj:
👉 http://35.205.107.27/company/login

Pozdrawiamy,
Zespół Top Skarbonka 💙
EOT;

        // 📤 Wysyłka maila przez Mailtrap
        try {
            Mail::raw($messageBody, function ($message) use ($company) {
                $message->to($company->email)
                        ->subject('Twoje dane logowania do systemu Top Skarbonka');
            });
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Firma została zapisana, ale nie udało się wysłać maila.');
        }

        // ✅ Powrót do logowania z komunikatem
        return redirect()->route('company.login')
            ->with('success', '✅ Firma została zarejestrowana i dane logowania wysłano na e-mail.');
    }
}
