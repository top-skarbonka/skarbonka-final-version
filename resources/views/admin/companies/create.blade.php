@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8 text-gray-200">
    <h1 class="text-3xl font-bold mb-6">➕ Dodaj nową firmę</h1>

    <form action="{{ route('admin.companies.store') }}" method="POST" class="bg-gray-800 p-6 rounded-xl shadow-xl">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-400 mb-2">Nazwa firmy</label>
                <input type="text" name="name" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block text-gray-400 mb-2">E-mail</label>
                <input type="email" name="email" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2" required>
            </div>
            <div>
                <label class="block text-gray-400 mb-2">Miasto</label>
                <input type="text" name="city" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-gray-400 mb-2">Kod pocztowy</label>
                <input type="text" name="postal_code" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-gray-400 mb-2">Ulica i nr</label>
                <input type="text" name="street" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-gray-400 mb-2">NIP</label>
                <input type="text" name="nip" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-gray-400 mb-2">Status</label>
                <select name="status" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2">
                    <option value="aktywny">Aktywny</option>
                    <option value="nieaktywny">Nieaktywny</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-400 mb-2">Przelicznik punktów (1 zł = ? punktów)</label>
                <input type="number" step="0.01" name="point_ratio" value="1.00" class="w-full bg-gray-700 border border-gray-600 rounded-lg px-4 py-2">
            </div>
        </div>

        <div class="mt-8 text-right">
            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-lg shadow">
                💾 Zapisz firmę
            </button>
        </div>
    </form>
</div>
@endsection
