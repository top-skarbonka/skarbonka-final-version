<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admina – Logowanie</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl p-8 animate-fadeIn">
        <div class="text-center mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.866-3.582 7-8 7m16 0c-4.418 0-8-3.134-8-7m0-4V5m0 0V3m0 2h2m-2 0H10" />
            </svg>
            <h1 class="text-3xl font-extrabold text-gray-800">Panel Admina</h1>
            <p class="text-gray-500 text-sm mt-1">Zaloguj się, aby zarządzać systemem</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Adres email</label>
                <input type="email" name="email" id="email" required
                       class="w-full mt-1 px-4 py-3 border rounded-xl focus:outline-none focus:ring-4 focus:ring-indigo-300 transition">
            </div>

            <!-- Hasło -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Hasło</label>
                <input type="password" name="password" id="password" required
                       class="w-full mt-1 px-4 py-3 border rounded-xl focus:outline-none focus:ring-4 focus:ring-indigo-300 transition">
            </div>

            <!-- Przycisk -->
            <div>
                <button type="submit"
                        class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-3 rounded-xl text-lg font-semibold shadow-lg hover:opacity-90 transition">
                    🔑 Zaloguj się
                </button>
            </div>
        </form>

        <p class="text-center text-xs text-gray-400 mt-5">
            &copy; {{ date('Y') }} Twój Panel Admina. Wszelkie prawa zastrzeżone.
        </p>
    </div>

</body>
</html>
