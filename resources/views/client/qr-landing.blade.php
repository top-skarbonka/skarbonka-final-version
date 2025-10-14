<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja zakończona sukcesem!</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9f9ff;
            font-family: 'Inter', sans-serif;
        }
        .shadow-soft {
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body class="flex flex-col items-center justify-center min-h-screen py-10">

    {{-- 🔹 LOGA --}}
    <div class="flex items-center justify-center gap-6 mb-8">
        <img src="http://top-price.com.pl/wp-content/uploads/2025/09/top-skarbonka.png" alt="Top Skarbonka" style="height: 5cm;">
        <img src="http://top-price.com.pl/wp-content/uploads/2024/10/logo-1.png" alt="Logo partnera" style="height: 5cm;">
    </div>

    {{-- 🔹 Nagłówek --}}
    <div class="bg-white rounded-2xl shadow-soft p-8 text-center max-w-lg mx-auto">
        <h1 class="text-3xl font-extrabold text-purple-700 mb-3">🎉 Rejestracja zakończona sukcesem!</h1>
        <p class="text-lg text-gray-700 mb-2">Dziękujemy, <strong>{{ $client->name }}</strong>!</p>

        <p class="text-gray-600 mt-4">Twój unikalny numer klienta, na który zbierasz punkty w firmach:</p>

        {{-- 🔹 Kod klienta --}}
        <div class="mt-4 mb-3 bg-purple-100 rounded-lg py-3 px-6 inline-flex items-center text-purple-700 font-extrabold text-3xl shadow-md">
            🏷️ {{ $client->client_code }}
        </div>

        {{-- 🔹 Opis pod numerem --}}
        <p class="text-sm text-gray-500 mt-1 mb-4">
            💡 To Twój <strong>kod ID klienta</strong> – zapamiętaj go lub zachowaj, aby firmy mogły przyznawać Ci punkty!
        </p>

        <p class="text-gray-600 mb-5">
            Zeskanuj poniższy kod QR lub przekaż swój numer firmie, by odebrać punkty:
        </p>

        {{-- 🔹 Kod QR --}}
        <div class="flex justify-center mb-6">
            <img src="{{ $qrPath }}" alt="Kod QR klienta" class="rounded-xl border-4 border-purple-400 shadow-lg">
        </div>

        {{-- 🔹 Przycisk pobrania kodu QR --}}
        <a href="{{ $qrPath }}" download class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 px-6 rounded-full shadow-md transition">
            ⬇️ Pobierz kod QR
        </a>

        {{-- 🔹 Przycisk rejestracji nowego klienta --}}
        <div class="mt-6">
            <a href="{{ route('client.register') }}" class="bg-purple-200 hover:bg-purple-300 text-purple-700 font-semibold py-2 px-5 rounded-full transition">
                ➕ Zarejestruj kolejnego klienta
            </a>
        </div>
    </div>

</body>
</html>
