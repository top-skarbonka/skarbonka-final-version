<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Firm</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

<header class="bg-blue-700 text-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4">
        <h1 class="text-xl font-bold">⚡ Top-Skarbonka — Lista Firm</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 px-4 py-2 rounded-lg hover:bg-gray-600">
            ⬅️ Powrót
        </a>
    </div>
</header>

<main class="container mx-auto p-6">
    <div class="bg-white rounded-xl shadow-md p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">📋 Firmy</h2>
            <a href="{{ route('companies.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                ➕ Dodaj firmę
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="text-left py-3 px-4">ID</th>
                    <th class="text-left py-3 px-4">Nazwa</th>
                    <th class="text-left py-3 px-4">Email</th>
                    <th class="text-left py-3 px-4">Telefon</th>
                    <th class="text-left py-3 px-4">Status</th>
                    <th class="text-left py-3 px-4">Akcje</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4">{{ $company->id }}</td>
                        <td class="py-3 px-4 font-semibold">{{ $company->name }}</td>
                        <td class="py-3 px-4">{{ $company->email }}</td>
                        <td class="py-3 px-4">{{ $company->phone }}</td>
                        <td class="py-3 px-4">
                            @if($company->status === 'suspended')
                                <span class="px-2 py-1 bg-red-200 text-red-800 rounded">Zawieszona</span>
                            @else
                                <span class="px-2 py-1 bg-green-200 text-green-800 rounded">Aktywna</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 flex gap-2">
                            <a href="{{ route('companies.edit', $company) }}" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                ✏️ Edytuj
                            </a>
                            <form action="{{ route('companies.update', $company) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="{{ $company->status === 'active' ? 'suspended' : 'active' }}">
                                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                    {{ $company->status === 'active' ? '⏸️ Zawieś' : '✅ Aktywuj' }}
                                </button>
                            </form>
                            <button onclick="openModal('{{ route('companies.destroy', $company) }}')" 
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                ❌ Usuń
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500">
                            Brak zarejestrowanych firm.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

<!-- Modal potwierdzenia -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">
    <div class="bg-white p-6 rounded-xl shadow-lg max-w-sm w-full">
        <h2 class="text-lg font-bold text-gray-800 mb-4">❌ Potwierdź usunięcie</h2>
        <p class="text-gray-600 mb-6">Czy na pewno chcesz usunąć tę firmę? Tej operacji nie można cofnąć.</p>
        
        <div class="flex justify-end gap-3">
            <button onclick="closeModal()" class="px-4 py-2 rounded-lg bg-gray-400 hover:bg-gray-500 text-white">Anuluj</button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">Usuń</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        form.action = actionUrl;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

</body>
</html>
