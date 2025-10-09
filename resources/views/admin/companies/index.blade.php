@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-16 px-8">
    <div class="max-w-6xl mx-auto bg-white shadow-lg rounded-xl p-10">
        <h2 class="text-3xl font-bold text-gray-800 mb-10 text-center">🏢 Lista firm</h2>

        {{-- 🔍 Wyszukiwarka --}}
        <form method="GET" action="{{ route('companies.index') }}" class="mb-8 flex gap-3 justify-center">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Szukaj po nazwie lub e-mailu..."
                   class="border rounded-lg px-4 py-2 w-1/2 focus:ring focus:ring-purple-200">
            <button type="submit"
                    class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-5 py-2 rounded-lg shadow hover:opacity-90 transition">
                🔍 Szukaj
            </button>
        </form>

        {{-- 📋 Tabela firm --}}
        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr class="text-left text-gray-600 uppercase text-sm">
                        <th class="px-4 py-3 border-b">ID</th>
                        <th class="px-4 py-3 border-b">Nazwa</th>
                        <th class="px-4 py-3 border-b">E-mail</th>
                        <th class="px-4 py-3 border-b">Punkty</th>
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b text-right">Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($companies as $company)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 border-b">{{ $company->id }}</td>
                            <td class="px-4 py-3 border-b font-medium text-gray-800">{{ $company->name }}</td>
                            <td class="px-4 py-3 border-b">{{ $company->email }}</td>
                            <td class="px-4 py-3 border-b text-purple-600 font-semibold">{{ $company->points ?? '0' }}</td>
                            <td class="px-4 py-3 border-b">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full
                                    {{ $company->active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                    {{ $company->active ? 'Aktywna' : 'Zablokowana' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 border-b text-right">
                                <a href="{{ route('companies.edit', $company) }}"
                                   class="text-blue-600 hover:underline mr-3">✏️ Edytuj</a>
                                <form method="POST" action="{{ route('companies.destroy', $company) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Czy na pewno usunąć firmę?')"
                                            class="text-red-600 hover:underline">🗑 Usuń</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">
                                Brak firm w bazie.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 🔘 Przyciski --}}
        <div class="mt-10 text-center">
            <a href="{{ route('companies.create') }}"
               class="bg-gradient-to-r from-purple-600 to-pink-500 text-white px-6 py-3 rounded-lg font-semibold shadow hover:opacity-90 transition">
                ➕ Dodaj nową firmę
            </a>
        </div>
    </div>
</div>
@endsection
