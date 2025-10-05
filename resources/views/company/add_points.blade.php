<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj punkty</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">➕ Dodaj punkty ręcznie</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('company.points.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Numer paragonu</label>
                <input type="text" name="receipt_number" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block font-semibold mb-1 text-gray-700">Kwota (zł)</label>
                <input type="number" step="0.01" name="amount" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500" required>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition">
                💰 Zapisz punkty
            </button>

            <div class="text-center mt-4">
                <a href="{{ route('company.points.index') }}" class="text-sm text-blue-600 hover:underline">📋 Zobacz listę punktów</a>
            </div>
        </form>
    </div>

</body>
</html>
