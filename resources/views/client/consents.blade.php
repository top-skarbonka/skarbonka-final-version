@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-50 via-pink-50 to-red-50 py-12 px-6 flex flex-col items-center">

    {{-- 🔔 Nagłówek --}}
    <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-4">
        🔔 Zgody marketingowe
    </h1>

    {{-- 💎 Punkty klienta --}}
    <div class="bg-white rounded-2xl shadow-md p-6 text-center w-full max-w-md mb-8 border border-purple-100">
        <h2 class="text-lg text-gray-700 mb-1">Masz obecnie:</h2>
        <p class="text-3xl font-extrabold text-purple-700">{{ $points ?? 0 }} <span class="text-base font-semibold">Top Points</span></p>
    </div>

    {{-- ✅ Komunikat sukcesu --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-800 px-6 py-4 rounded-xl mb-6 text-center shadow-md text-lg font-medium">
            {{ session('success') }}
        </div>
    @endif

    {{-- 📄 Opis --}}
    <p class="text-gray-600 mb-10 text-center max-w-2xl leading-relaxed">
        Każda aktywna zgoda to 
        <span class="font-semibold text-purple-700">+100 Top Points 💎</span><br>
        Zaznacz, na co chcesz wyrazić zgodę i kliknij „Zapisz zmiany”.
    </p>

    {{-- 🧾 Formularz --}}
    <form method="POST" action="{{ route('client.consents.update') }}" 
          class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-2xl border border-gray-100">
        @csrf

        <div class="space-y-6">
            {{-- SMS --}}
            <label class="flex justify-between items-center text-lg text-gray-800 font-medium">
                <span class="flex items-center gap-2">📱 Zgoda na wiadomości SMS</span>
                <input type="checkbox" name="consent_sms" value="1" 
                    {{ $client->consent_sms ? 'checked' : '' }}
                    class="h-5 w-5 accent-purple-600 cursor-pointer transition-all duration-150">
            </label>

            {{-- E-mail --}}
            <label class="flex justify-between items-center text-lg text-gray-800 font-medium">
                <span class="flex items-center gap-2">📧 Zgoda na e-maile promocyjne</span>
                <input type="checkbox" name="consent_email" value="1" 
                    {{ $client->consent_email ? 'checked' : '' }}
                    class="h-5 w-5 accent-purple-600 cursor-pointer transition-all duration-150">
            </label>

            {{-- Dane osobowe --}}
            <label class="flex justify-between items-center text-lg text-gray-800 font-medium">
                <span class="flex items-center gap-2">🔒 Zgoda na przetwarzanie danych osobowych</span>
                <input type="checkbox" name="consent_personal" value="1" 
                    {{ $client->consent_personal ? 'checked' : '' }}
                    class="h-5 w-5 accent-purple-600 cursor-pointer transition-all duration-150">
            </label>
        </div>

        {{-- 💾 Przycisk zapisu --}}
        <div class="mt-10 flex flex-col items-center">
            <button type="submit"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-fuchsia-300 to-pink-300 
                       text-gray-800 font-medium py-2 px-12 rounded-full text-sm 
                       shadow-md hover:shadow-lg hover:scale-105 active:scale-95 
                       transition-all duration-200 border border-pink-200">
                💾 <span class="tracking-wide">Zapisz zmiany</span>
            </button>

            <p class="text-gray-500 text-sm mt-4 text-center">
                Za każdą aktywną zgodę otrzymasz 
                <span class="font-semibold text-purple-700">+100 Top Points 💎</span>
            </p>
        </div>
    </form>

</div>
@endsection
