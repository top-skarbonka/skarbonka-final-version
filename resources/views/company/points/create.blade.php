@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-2xl shadow-md text-center">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">➕ Dodaj punkty ręcznie</h2>

    <form method="POST" action="{{ route('company.points.store') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Numer paragonu</label>
            <input type="text" name="receipt_number" required class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">Kwota (zł)</label>
            <input type="number" name="amount" step="0.01" min="0" required class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <div>
            <label class="block text-gray-700 font-semibold mb-1">ID klienta</label>
            <input type="text" name="client_id" required placeholder="np. CL12345" class="w-full border-gray-300 rounded-lg shadow-sm">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg mt-4">
            💰 Zapisz punkty
        </button>
    </form>

    <div class="mt-4 text-center">
        <a href="{{ route('company.points.index') }}" class="text-blue-600 hover:underline">
            📋 Zobacz listę punktów
        </a>
    </div>
</div>
@endsection
