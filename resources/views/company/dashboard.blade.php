@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-white flex flex-col items-center justify-start py-10">
    <div class="w-full max-w-4xl bg-gray-800 rounded-2xl shadow-lg p-6">
        <div class="flex justify-between items-center mb-6 border-b border-gray-700 pb-3">
            <h1 class="text-3xl font-bold">📊 Panel firmy</h1>
            
            <!-- 🔓 Wylogowanie -->
            <form action="{{ route('company.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    🚪 Wyloguj
                </button>
            </form>
        </div>

        <!-- ✅ Komunikaty -->
        @if (session('success'))
            <div class="bg-green-600 text-white p-3 rounded mb-4">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-600 text-white p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        <!-- 🏪 Informacje o firmie -->
        <div class="mb-6">
            <p><strong>Nazwa firmy:</strong> {{ auth('company')->user()->name }}</p>
            <p><strong>E-mail:</strong> {{ auth('company')->user()->email }}</p>
            <p><strong>ID firmy:</strong> {{ auth('company')->user()->company_id }}</p>
            <p><strong>Przelicznik punktów:</strong> {{ auth('company')->user()->point_ratio }}</p>
        </div>

        <!-- ➕ Formularz dodawania punktów -->
        <h2 class="text-xl font-semibold mb-4">➕ Dodaj punkty klientowi</h2>

        <form method="POST" action="{{ route('company.addPoints') }}" class="space-y-4">
            @csrf
            <div>
                <label for="client_id" class="block mb-1">ID klienta:</label>
                <input type="text" name="client_id" id="client_id" class="w-full p-2 rounded bg-gray-700 text-white" required>
            </div>

            <div>
                <label for="receipt_number" class="block mb-1">Numer paragonu / faktury:</label>
                <input type="text" name="receipt_number" id="receipt_number" class="w-full p-2 rounded bg-gray-700 text-white" required>
            </div>

            <div>
                <label for="amount" class="block mb-1">Kwota (zł):</label>
                <input type="number" step="0.01" name="amount" id="amount" class="w-full p-2 rounded bg-gray-700 text-white" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded font-semibold">
                💰 Dodaj punkty
            </button>
        </form>

        <!-- 📈 Statystyki (placeholder) -->
        <div class="mt-10 border-t border-gray-700 pt-5">
            <h2 class="text-xl font-semibold mb-2">📊 Statystyki</h2>
            <p>Wkrótce tutaj będą wykresy i raporty punktów.</p>
        </div>
    </div>
</div>
@endsection
