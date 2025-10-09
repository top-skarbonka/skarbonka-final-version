@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 text-gray-200 p-6">
    <div class="max-w-6xl mx-auto space-y-6">

        {{-- 🔹 Nagłówek --}}
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Panel Firmy: {{ $company->name }}</h1>

            <form action="{{ route('company.logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded text-white">
                    Wyloguj
                </button>
            </form>
        </div>

        {{-- 🔹 Statystyki --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="bg-gray-800 p-5 rounded-lg shadow text-center">
                <p class="text-gray-400">Łączna liczba punktów</p>
                <h2 class="text-3xl font-bold text-yellow-400">{{ number_format($totalPoints, 0, ',', ' ') }}</h2>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow text-center">
                <p class="text-gray-400">Punkty w tym miesiącu</p>
                <h2 class="text-3xl font-bold text-blue-400">{{ number_format($monthPoints, 0, ',', ' ') }}</h2>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow text-center">
                <p class="text-gray-400">Nowi klienci z polecenia</p>
                <h2 class="text-3xl font-bold text-green-400">{{ $clientsCount }}</h2>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow text-center">
                <p class="text-gray-400">Twój kod zaproszeniowy</p>
                <h2 class="text-xl font-semibold text-pink-400 select-all">{{ $company->invite_code }}</h2>
            </div>
        </div>

        {{-- 🔹 Formularz dodawania punktów --}}
        <div class="bg-gray-800 p-6 rounded-lg shadow space-y-4">
            <h2 class="text-xl font-semibold mb-3">Dodaj punkty</h2>

            <form action="{{ route('company.addQrPoints') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">ID Klienta / Kod QR</label>
                        <div class="flex space-x-2">
                            <input type="text" name="client_id" id="client_id"
                                class="w-full bg-gray-700 text-white rounded px-3 py-2 focus:ring focus:ring-yellow-400"
                                placeholder="Zeskanuj kod QR lub wpisz ID" required>
                            <button type="button" id="startScan"
                                class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-4 rounded">
                                📷
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Numer paragonu / FV</label>
                        <input type="text" name="receipt_number"
                            class="w-full bg-gray-700 text-white rounded px-3 py-2 focus:ring focus:ring-yellow-400"
                            placeholder="np. FV/2025/01" required>
                    </div>
                    <div>
                        <label class="block text-sm text-gray-400 mb-1">Kwota</label>
                        <input type="number" step="0.01" name="amount_spent"
                            class="w-full bg-gray-700 text-white rounded px-3 py-2 focus:ring focus:ring-yellow-400"
                            placeholder="np. 250.00" required>
                    </div>
                </div>

                <div class="col-span-full flex justify-end">
                    <button type="submit"
                        class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 font-semibold px-6 py-2 rounded-lg transition">
                        ➕ Dodaj punkty
                    </button>
                </div>
            </form>
        </div>

        {{-- 🔹 Wykresy --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-800 p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-3">Punkty w ostatnich dniach</h2>
                <canvas id="pointsBarChart"></canvas>
            </div>
            <div class="bg-gray-800 p-5 rounded-lg shadow">
                <h2 class="text-lg font-semibold mb-3">Udział klientów w punktach</h2>
                <canvas id="pointsPieChart"></canvas>
            </div>
        </div>

        {{-- 🔹 Ostatnie transakcje --}}
        <div class="bg-gray-800 p-5 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-3">Ostatnie dodane punkty</h2>
            <table class="min-w-full text-sm">
                <thead class="border-b border-gray-700 text-gray-400">
                    <tr>
                        <th class="px-3 py-2 text-left">ID Klienta</th>
                        <th class="px-3 py-2 text-left">Kwota</th>
                        <th class="px-3 py-2 text-left">Punkty</th>
                        <th class="px-3 py-2 text-left">Paragon / FV</th>
                        <th class="px-3 py-2 text-left">Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(\App\Models\Point::where('company_id', $company->id)->latest()->take(10)->get() as $point)
                        <tr class="border-b border-gray-700 hover:bg-gray-700/50 transition">
                            <td class="px-3 py-2">{{ $point->client_id }}</td>
                            <td class="px-3 py-2">{{ number_format($point->amount_spent, 2, ',', ' ') }} zł</td>
                            <td class="px-3 py-2 text-yellow-400 font-semibold">{{ $point->points_awarded }}</td>
                            <td class="px-3 py-2">{{ $point->receipt_number }}</td>
                            <td class="px-3 py-2">{{ $point->created_at->format('d.m.Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- 📷 Modal QR --}}
<div id="qrModal" class="hidden fixed inset-0 bg-black/80 flex items-center justify-center z-50">
    <div class="bg-gray-800 p-5 rounded-lg w-96 text-center">
        <h2 class="text-lg font-semibold mb-3 text-yellow-400">Skanuj kod QR</h2>
        <video id="preview" class="rounded w-full"></video>
        <button id="closeScan"
            class="mt-4 bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">Zamknij</button>
    </div>
</div>

{{-- 📈 Chart.js i QR Scanner --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
const barCtx = document.getElementById('pointsBarChart');
new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: {!! json_encode(array_keys($weeklyPoints->toArray())) !!},
        datasets: [{
            label: 'Punkty dziennie',
            data: {!! json_encode(array_values($weeklyPoints->toArray())) !!},
            backgroundColor: 'rgba(255, 206, 86, 0.8)',
        }]
    },
    options: {
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { color: '#ccc' }}, x: { ticks: { color: '#ccc' }}}
    }
});

const pieCtx = document.getElementById('pointsPieChart');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Nowi klienci', 'Stali klienci'],
        datasets: [{
            data: [{{ $clientsCount }}, {{ $totalPoints }}],
            backgroundColor: ['#4ade80', '#60a5fa']
        }]
    },
});

const startBtn = document.getElementById('startScan');
const modal = document.getElementById('qrModal');
const closeBtn = document.getElementById('closeScan');
let scanner;

startBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
    scanner = new Html5Qrcode("preview");
    scanner.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        qrCodeMessage => {
            document.getElementById('client_id').value = qrCodeMessage;
            stopScanner();
        },
        errorMessage => {}
    );
});

async function stopScanner() {
    try {
        if (scanner) {
            await scanner.stop();
            await scanner.clear();
        }
    } catch (e) {
        console.warn('Błąd przy zatrzymaniu skanera:', e);
    } finally {
        modal.classList.add('hidden');
    }
}

closeBtn.addEventListener('click', stopScanner);
</script>
@endsection
