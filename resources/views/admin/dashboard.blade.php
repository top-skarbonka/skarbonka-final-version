<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administratora</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto py-10 px-6">
        <h1 class="text-3xl font-bold mb-6">📊 Panel Administratora</h1>

        <!-- Statystyki -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gray-800 p-5 rounded-lg shadow">
                <p class="text-gray-400 text-sm">Liczba firm</p>
                <h2 class="text-2xl font-semibold">{{ $totalCompanies }}</h2>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow">
                <p class="text-gray-400 text-sm">Liczba klientów</p>
                <h2 class="text-2xl font-semibold">{{ $totalClients }}</h2>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow">
                <p class="text-gray-400 text-sm">Łączna liczba punktów</p>
                <h2 class="text-2xl font-semibold">{{ $totalPoints }}</h2>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow">
                <p class="text-gray-400 text-sm">Aktywne firmy</p>
                <h2 class="text-2xl font-semibold">{{ $activeCompanies }}</h2>
            </div>
        </div>

        <!-- Wykres -->
        <div class="bg-gray-800 p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4">Punkty przyznane w ostatnich 7 dniach</h2>
            <canvas id="pointsChart" height="100"></canvas>
        </div>

        <!-- Ostatnie firmy -->
        <div class="bg-gray-800 p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4">Ostatnio dodane firmy</h2>
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b border-gray-700 text-gray-400">
                        <th class="py-2">Nazwa</th>
                        <th class="py-2">Email</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Data dodania</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentCompanies as $company)
                    <tr class="border-b border-gray-800 hover:bg-gray-700 transition">
                        <td class="py-2">{{ $company->name }}</td>
                        <td class="py-2">{{ $company->email }}</td>
                        <td class="py-2">
                            <span class="px-3 py-1 text-sm rounded-full {{ $company->status === 'active' ? 'bg-green-600' : 'bg-gray-500' }}">
                                {{ $company->status ?? 'brak' }}
                            </span>
                        </td>
                        <td class="py-2">{{ $company->created_at->format('d.m.Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('pointsChart').getContext('2d');
        const pointsChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($pointsByDay->toArray())) !!},
                datasets: [{
                    label: 'Punkty',
                    data: {!! json_encode(array_values($pointsByDay->toArray())) !!},
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

</body>
</html>
