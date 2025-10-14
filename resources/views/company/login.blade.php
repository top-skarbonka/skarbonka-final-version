@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-purple-100 via-pink-100 to-red-100 flex flex-col justify-center items-center px-6 py-12">
    
    <div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-md fade-in-up">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-2">🏢 Logowanie firmy</h2>
        <p class="text-center text-gray-500 mb-8">Podaj swoje dane dostępowe wysłane przez administratora</p>

        {{-- Komunikat o błędzie --}}
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        {{-- Komunikat sukcesu --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('company.login.submit') }}" class="space-y-5">
            @csrf

            <div>
                <label for="company_id" class="block text-gray-700 font-medium mb-2">ID firmy</label>
                <input type="text" name="company_id" id="company_id" value="{{ old('company_id') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-purple-300" required autofocus>
            </div>

            <div>
                <label for="password" class="block text-gray-700 font-medium mb-2">Hasło</label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring focus:ring-purple-300" required>
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-2 text-gray-500">👁️</button>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-gray-700 text-sm">
                    <input type="checkbox" name="remember" class="mr-2 accent-purple-600">
                    Zapamiętaj mnie
                </label>
                <a href="#" class="text-sm text-purple-600 hover:underline">Nie pamiętasz hasła?</a>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-2 rounded-lg shadow hover:opacity-90 transition">
                🔐 Zaloguj się
            </button>
        </form>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
@endsection
