<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edytuj Firmę</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen">

<header class="bg-blue-700 text-white shadow-md">
    <div class="container mx-auto flex justify-between items-center p-4">
        <h1 class="text-xl font-bold">⚡ Top-Skarbonka — Edycja Firmy</h1>
        <a href="{{ route('companies.index') }}" class="bg-gray-500 px-4 py-2 rounded-lg hover:bg-gray-600">
            ⬅️ Powrót
        </a>
    </div>
</header>

<main class="container mx-auto p-6">
    <div class="bg-white rounded-xl shadow-md p-8 max-w-2xl mx-auto">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edytuj firmę</h2>

        <form action="{{ route('companies.update', $company) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700">Nazwa firmy</label>
                <input type="text" name="name" value="{{ old('name', $company->name) }}" required
                       class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kod pocztowy</label>
                    <input type="text" name="postal_code" value="{{ old('postal_code', $company->postal_code) }}"
                           class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Miasto</label>
                    <input type="text" name="city" value="{{ old('city', $company->city) }}"
                           class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Ulica i nr</label>
                <input type="text" name="street" value="{{ old('street', $company->street) }}"
                       class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">NIP</label>
                    <input type="text" name="nip" value="{{ old('nip', $company->nip) }}"
                           class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Telefon</label>
                    <input type="text" name="phone" value="{{ old('phone', $company->phone) }}"
                           class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Adres e-mail</label>
                <input type="email" name="email" value="{{ old('email', $company->email) }}"
                       class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="active" {{ $company->status === 'active' ? 'selected' : '' }}>Aktywna</option>
                    <option value="suspended" {{ $company->status === 'suspended' ? 'selected' : '' }}>Zawieszona</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-lg hover:bg-yellow-600">
                    💾 Zapisz zmiany
                </button>
            </div>
        </form>
    </div>
</main>

</body>
</html>
