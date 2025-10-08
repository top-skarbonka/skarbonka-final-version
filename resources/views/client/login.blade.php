@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-100 via-pink-100 to-red-100 flex items-center justify-center py-12 px-6">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-6">
            🔐 Logowanie do panelu klienta
        </h1>

        {{-- Komunikaty --}}
        @if(session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded mb-4 text-center font-semibold">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded mb-4 text-center font-semibold">
                {{ session('success') }}
            </div>
        @endif

        {{-- Formularz logowania --}}
        <form method="POST" action="{{ route('client.login.submit') }}" class="space-y-5">
            @csrf

            {{-- Email --}}
            <div>
                <label class="block text-gray-700 mb-2 font-medium">📧 Adres e-mail</label>
                <input type="email" name="email" required autofocus
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-purple-500 focus:outline-none">
            </div>

            {{-- Hasło --}}
            <div>
                <label class="block text-gray-700 mb-2 font-medium">🔑 Hasło</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:ring-2 focus:ring-purple-500 focus:outline-none">
                    <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-purple-600 focus:outline-none">
                        👁
                    </button>
                </div>
            </div>

            {{-- Zapamiętaj mnie --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center text-gray-700">
                    <input type="checkbox" name="remember" class="mr-2 rounded text-purple-600 focus:ring-purple-500">
                    Zapamiętaj mnie
                </label>
                <a href="#" class="text-sm text-purple-600 hover:underline">Nie pamiętasz hasła?</a>
            </div>

            {{-- Normalny guzik --}}
            <button type="submit"
                class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">
                Zaloguj się
            </button>
        </form>

        {{-- Link do rejestracji --}}
        <p class="text-center text-sm text-gray-600 mt-6">
            Nie masz konta?
            <a href="{{ route('client.register') }}" class="text-purple-600 font-semibold hover:underline">Zarejestruj się</a>
        </p>
    </div>
</div>

{{-- 👁 JS: pokaż/ukryj hasło --}}
<script>
document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const isPassword = passwordField.type === 'password';
    passwordField.type = isPassword ? 'text' : 'password';
    this.textContent = isPassword ? '🙈' : '👁';
});
</script>
@endsection
