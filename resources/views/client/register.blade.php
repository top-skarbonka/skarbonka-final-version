@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 via-white to-purple-100 py-12 flex justify-center">
    <div class="bg-white shadow-2xl rounded-2xl p-10 w-full max-w-lg border border-purple-100">
        
        {{-- 🔹 LOGA NA GÓRZE --}}
        <div class="flex justify-center items-center mb-8 space-x-6">
            <img src="http://top-price.com.pl/wp-content/uploads/2025/09/top-skarbonka.png" alt="Top Skarbonka" class="h-12 object-contain">
            <img src="http://top-price.com.pl/wp-content/uploads/2024/10/logo-1.png" alt="Logo Partnera" class="h-12 object-contain">
        </div>

        <h2 class="text-3xl font-bold text-center text-purple-700 mb-8">🧾 Rejestracja klienta</h2>

        {{-- Komunikaty błędów --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-3 mb-6 rounded-lg shadow">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('client.register.submit') }}" class="space-y-6">
            @csrf

            {{-- Pola obowiązkowe --}}
            <div>
                <label class="block font-semibold text-gray-800 mb-2">👤 Imię i nazwisko *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       class="w-full border-2 border-purple-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 px-4 py-3 transition-all duration-200 bg-purple-50/20">
            </div>

            <div>
                <label class="block font-semibold text-gray-800 mb-2">📧 Adres e-mail *</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                       class="w-full border-2 border-purple-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 px-4 py-3 transition-all duration-200 bg-purple-50/20">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block font-semibold text-gray-800 mb-2">📮 Kod pocztowy *</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code') }}" required
                           class="w-full border-2 border-purple-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 px-4 py-3 transition-all duration-200 bg-purple-50/20">
                </div>
                <div>
                    <label class="block font-semibold text-gray-800 mb-2">🏙️ Miasto *</label>
                    <input type="text" name="city" value="{{ old('city') }}" required
                           class="w-full border-2 border-purple-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 px-4 py-3 transition-all duration-200 bg-purple-50/20">
                </div>
            </div>

            <hr class="my-6 border-purple-200">
            <p class="text-center font-semibold text-gray-600 mb-4">💎 Dane opcjonalne (nagroda +100 pkt za każde)</p>

            {{-- Opcjonalne dane --}}
            <div>
                <label class="block font-semibold text-gray-800 mb-2">📞 Numer telefonu</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="w-full border-2 border-purple-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 px-4 py-3 transition-all duration-200 bg-purple-50/20">
            </div>

            <div>
                <label class="block font-semibold text-gray-800 mb-2">🎂 Rok urodzenia</label>
                <input type="number" name="birth_year" value="{{ old('birth_year') }}"
                       class="w-full border-2 border-purple-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 px-4 py-3 transition-all duration-200 bg-purple-50/20"
                       min="1900" max="{{ date('Y') }}">
            </div>

            <div>
                <label class="block font-semibold text-gray-800 mb-2">⚧️ Płeć</label>
                <select name="gender"
                        class="w-full border-2 border-purple-200 rounded-xl shadow-sm focus:ring-2 focus:ring-purple-400 focus:border-purple-500 px-4 py-3 transition-all duration-200 bg-purple-50/20">
                    <option value="">Nie podano</option>
                    <option value="male">Mężczyzna</option>
                    <option value="female">Kobieta</option>
                    <option value="other">Inna</option>
                </select>
            </div>

            {{-- Zgody --}}
            <div class="flex flex-col space-y-3 mt-6">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="consent_terms" required class="text-purple-600 w-5 h-5">
                    <span class="ml-2 text-sm text-gray-800">Akceptuję regulamin *</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" name="consent_rodo" required class="text-purple-600 w-5 h-5">
                    <span class="ml-2 text-sm text-gray-800">Wyrażam zgodę na przetwarzanie danych osobowych *</span>
                </label>

                <label class="inline-flex items-center">
                    <input type="checkbox" name="consent_sms" class="text-purple-600 w-5 h-5">
                    <span class="ml-2 text-sm text-gray-800">Zgoda na SMS (+100 pkt)</span>
                </label>
            </div>

            {{-- Przycisk --}}
            <div class="text-center mt-10">
                <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg transition-all duration-200 transform hover:scale-[1.02]">
                    ✨ Zarejestruj się
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
