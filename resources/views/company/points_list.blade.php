<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista punktów</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center py-10">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-3xl">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">📋 Historia przyznanych punktów</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($points->isEmpty())
            <p class="text-center text-gray-600">Brak zapisanych punktów.</p>
        @else
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="py-2 px-4 text-left">#</th>
                        <th class="py-2 px-4 text-left">Numer paragonu</th>
                        <th class="py-2 px-4 text-left">Kwota (zł)</th>
                        <th class="py-2 px-4 text-left">Przyznane punkty</th>
                        <th class="py-2 px-4 text-left">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($points as $index => $point)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4">{{ $index + 1 }}</td>
                            <td class="py-2 px-4">{{ $point->receipt_number }}</td>
                            <td class="py-2 px-4">{{ number_format($point->amount, 2, ',', ' ') }}</td>
                            <td class="py-2 px-4 font-semibold text-green-700">+{{ $point->points }}</td>
                            <td class="py-2 px-4 text-gray-600">{{ $point->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="text-center mt-6">
            <a href="{{ route('company.points.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition">
                ➕ Dodaj kolejne punkty
            </a>
        </div>
    </div>

</body>
</html>
