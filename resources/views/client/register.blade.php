@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-10">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🧍‍♂️ Rejestracja klienta</h2>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('client.register.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-1">📧 E-mail *</label>
                <input type="email" name="email" required class="w-full border-gray-300 rounded-lg shadow-sm p-2" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">📮 Kod pocztowy *</label>
                    <input type="text" name="postal_code" required class="w-full border-gray-300 rounded-lg shadow-sm p-2" />
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">🏙️ Miasto *</label>
                    <input type="text" name="city" required class="w-full border-gray-300 rounded-lg shadow-sm p-2" />
                </div>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">📞 Telefon (opcjonalnie)</label>
                <input type="text" name="phone" class="w-full border-gray-300 rounded-lg shadow-sm p-2" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">🎂 Data urodzenia</label>
                    <input type="date" name="birth_date" class="w-full border-gray-300 rounded-lg shadow-sm p-2" />
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-1">🚻 Płeć</label>
                    <select name="gender" class="w-full border-gray-300 rounded-lg shadow-sm p-2">
                        <option value="">-- wybierz --</option>
                        <option value="male">Mężczyzna</option>
                        <option value="female">Kobieta</option>
                        <option value="other">Inna</option>
                    </select>
                </div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg border mt-4">
                <p class="text-gray-700 font-semibold mb-2">📝 Zgody marketingowe</p>
                <p class="text-sm text-gray-500 mb-3">Za każdą zgodę otrzymasz <strong>+100 Top Points</strong> 🎁</p>

                <label class="block mb-2">
                    <input type="checkbox" name="consent_sms" value="1" class="mr-2">
                    Zgadzam się na otrzymywanie ofert handlowych przez SMS.
                </label>
                <label class="block mb-2">
                    <input type="checkbox" name="consent_email" value="1" class="mr-2">
                    Zgadzam się na otrzymywanie ofert handlowych przez e-mail.
                </label>
                <label class="block">
                    <input type="checkbox" name="consent_personal" value="1" class="mr-2">
                    Zgadzam się na przetwarzanie moich danych osobowych w celach marketingowych.
                </label>
            </div>

            <div class="text-center mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg shadow">
                    ✨ Zarejestruj się
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
