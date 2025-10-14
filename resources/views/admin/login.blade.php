<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie — Panel Admina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen text-gray-100">

    <div class="bg-gray-800 p-8 rounded-2xl shadow-lg w-full max-w-md">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-teal-400 flex items-center justify-center gap-2">
                🔐 Logowanie — Panel Admina
            </h1>
        </div>

        @if ($errors->any())
            <div class="bg-red-700 text-white p-3 rounded mb-4 flex items-center gap-2">
                ❌ <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label for="email" class="block text-sm mb-1 text-gray-300">Adres e-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email', 'damianb1988@proton.me') }}"
                       class="w-full bg-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-teal-500 outline-none"
                       required autofocus>
            </div>

            <div class="relative">
                <label for="password" class="block text-sm mb-1 text-gray-300">Hasło</label>
                <input type="password" id="password" name="password"
                       value="lenovo"
                       class="w-full bg-gray-700 text-white rounded-lg p-3 focus:ring-2 focus:ring-teal-500 outline-none pr-10"
                       required>
                <button type="button" id="togglePassword"
                        class="absolute right-3 top-8 text-gray-400 hover:text-teal-400 focus:outline-none">
                    👁
                </button>
            </div>

            <button type="submit"
                    class="w-full bg-teal-500 hover:bg-teal-600 transition text-white font-semibold py-2 rounded-lg shadow-md">
                Zaloguj się
            </button>
        </form>
    </div>

    <script>
        // 👁 Przełącznik widoczności hasła
        const toggle = document.getElementById('togglePassword');
        const password = document.getElementById('password');
        toggle.addEventListener('click', () => {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            toggle.textContent = type === 'password' ? '👁' : '🙈';
        });
    </script>
</body>
</html>
