@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-100 via-pink-100 to-red-100 flex flex-col items-center py-10 px-4">

    {{-- Nagłówek --}}
    <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-2">
        🎉 Witaj w swoim panelu klienta!
    </h1>
    <p class="text-gray-600 text-center mb-8">
        Zbieraj punkty, wymieniaj je na vouchery i odkrywaj promocje w Twojej okolicy 💎
    </p>

    {{-- Nawigacja --}}
    <div class="flex flex-wrap justify-center gap-4 mb-10">
        <a href="{{ route('client.dashboard') }}" class="bg-white hover:bg-purple-50 text-gray-800 font-semibold py-2 px-6 rounded-full shadow-md transition-all duration-200">
            🏠 Strona główna
        </a>

        <a href="{{ route('client.consents.edit') }}" class="bg-white hover:bg-pink-50 text-gray-800 font-semibold py-2 px-6 rounded-full shadow-md transition-all duration-200">
            📝 Zgody marketingowe
        </a>

        <a href="{{ route('client.history') }}" class="bg-white hover:bg-yellow-50 text-gray-800 font-semibold py-2 px-6 rounded-full shadow-md transition-all duration-200">
            📜 Historia punktów
        </a>

        <a href="#" class="bg-white hover:bg-blue-50 text-gray-800 font-semibold py-2 px-6 rounded-full shadow-md transition-all duration-200">
            🎁 Vouchery
        </a>

        <a href="#" class="bg-gradient-to-r from-fuchsia-200 to-pink-200 text-gray-900 font-bold py-2 px-8 rounded-full shadow-lg hover:scale-105 transition-all duration-200">
            💎 Kliknij, aby wymienić punkty na vouchery
        </a>
    </div>

    {{-- Punkty użytkownika --}}
    <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 text-center w-full max-w-md mb-10">
        <h2 class="text-xl text-gray-700 mb-2">Masz obecnie:</h2>
        <p class="text-4xl font-extrabold text-purple-600">{{ $points ?? 0 }} <span class="text-gray-700 text-xl">Top Points</span></p>
    </div>

    {{-- Dane klienta --}}
    <div class="bg-white rounded-2xl shadow-md p-6 w-full max-w-3xl mb-10">
        <h3 class="text-xl font-bold mb-4 text-gray-700">🧾 Twoje dane</h3>
        <div class="grid md:grid-cols-2 gap-4 text-gray-700">
            <p><strong>Email:</strong> {{ $client->email }}</p>
            <p><strong>Kod klienta:</strong> {{ $client->client_code }}</p>
            <p><strong>Miasto:</strong> {{ $client->city ?? '-' }}</p>
            <p><strong>Kod pocztowy:</strong> {{ $client->postal_code ?? '-' }}</p>
            <p><strong>Telefon:</strong> {{ $client->phone ?? '-' }}</p>
        </div>
    </div>

    {{-- Kod QR --}}
    <div class="bg-white rounded-2xl shadow-md p-6 text-center w-full max-w-md mb-10">
        <h3 class="text-lg font-semibold mb-3 text-gray-700">📱 Twój kod QR</h3>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::size(200)->generate(url('/company/login?client=' . $client->id))) !!}" alt="Kod QR" class="mx-auto">
    </div>

    {{-- Banery reklamowe --}}
    <div class="w-full max-w-5xl">
        <h3 class="text-2xl font-bold text-center mb-6 text-gray-800">🎯 Promocje w Twojej okolicy</h3>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <img src="https://placehold.co/400x150/FFDEE9/333?text=10%25+RABATU" alt="Promocja lokalna" class="w-full">
                <div class="p-4 text-gray-700 font-semibold">🛍️ Promocja lokalna – 10% rabatu!</div>
            </div>
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <img src="https://placehold.co/400x150/DEE9FF/333?text=Pizza+Gratis" alt="Pizzeria Roma" class="w-full">
                <div class="p-4 text-gray-700 font-semibold">🍕 Pizzeria Roma – darmowy napój do pizzy!</div>
            </div>
            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                <img src="https://placehold.co/400x150/E9FFDE/333?text=20%25+ZNIZKI" alt="Salon Urody Bella" class="w-full">
                <div class="p-4 text-gray-700 font-semibold">💅 Salon Urody Bella – 20% zniżki!</div>
            </div>
        </div>
    </div>
</div>
@endsection
