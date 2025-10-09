@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gradient-to-br from-purple-100 to-pink-100">
    <div class="bg-white shadow-lg rounded-2xl p-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🏢 Rejestracja firmy</h2>

        {{-- ✅ Komunikaty błędów --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- ✅ Komunikat sukcesu --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('company.register.store') }}" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="Nazwa firmy" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="postal_code" placeholder="Kod pocztowy" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="city" placeholder="Miasto" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="street" placeholder="Ulica i numer" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="nip" placeholder="NIP" class="border rounded-lg p-2 w-full" required>
            <input type="email" name="email" placeholder="Adres e-mail" class="border rounded-lg p-2 w-full" required>
            <input type="text" name="phone" placeholder="Numer telefonu" class="border rounded-lg p-2 w-full" required>
            <input type="number" step="0.01" name="start_points" placeholder="Punkty startowe" class="border rounded-lg p-2 w-full">
            <input type="number" step="0.01" name="point_ratio" placeholder="Przelicznik zł → Top Points (np. 1.0)" class="border rounded-lg p-2 w-full" required>

            <button type="submit"
                    class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-2 rounded-lg w-full shadow-md hover:opacity-90 transition">
                💾 Zarejestruj firmę
            </button>
        </form>

        <p class="text-center text-gray-600 mt-4">
            Masz już konto?
            <a href="{{ route('company.login') }}" class="text-purple-600 hover:underline">Zaloguj się</a>
        </p>
    </div>
</div>
@endsection
