@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8fafc;
        font-family: 'Inter', sans-serif;
    }

    .dashboard-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        padding: 25px;
    }

    h2 {
        font-weight: 700;
        color: #1e293b;
    }

    .section-title {
        font-size: 1.4rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 15px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th {
        background: #e2e8f0;
        color: #1e293b;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.9rem;
        padding: 12px;
    }

    td {
        padding: 10px 12px;
        border-bottom: 1px solid #e2e8f0;
    }

    tr:hover {
        background: #f1f5f9;
    }

    .form-control {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px;
        width: 100%;
        margin-bottom: 15px;
    }

    .stats-number {
        font-size: 2rem;
        font-weight: 700;
        color: #2563eb;
    }

    .chart-container {
        position: relative;
        height: 300px;
    }

    .btn-logout {
        background-color: #ef4444;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 20px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-logout:hover {
        background-color: #dc2626;
    }
</style>

<div class="container py-4">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:25px;">
        <h2>👑 Panel Administratora</h2>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Wyloguj się</button>
        </form>
    </div>

    <p class="text-muted mb-4">Zarządzaj firmami, klientami i monitoruj wyniki programu.</p>

    <!-- Lista firm -->
    <div class="dashboard-card">
        <h4 class="section-title">🏢 Lista firm</h4>
        <input type="text" class="form-control" placeholder="🔍 Szukaj po ID lub e-mailu">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa</th>
                    <th>Email</th>
                    <th>Miasto</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->city ?? '-' }}</td>
                    <td>
                        ✏️ ⏸️ 🗑️ 🔁
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Lista klientów -->
    <div class="dashboard-card">
        <h4 class="section-title">👥 Lista klientów</h4>
        <input type="text" class="form-control" placeholder="🔍 Szukaj po ID lub e-mailu">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imię i nazwisko</th>
                    <th>Email</th>
                    <th>Miasto</th>
                    <th>Punkty</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
                <tr>
                    <td>{{ $client->id }}</td>
                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->city ?? '-' }}</td>
                    <td>{{ $client->points ?? 0 }}</td>
                    <td>
                        ✏️ ⏸️ 🗑️
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Statystyki tygodniowe -->
    <div class="dashboard-card">
        <h4 class="section-title">📊 Statystyki tygodniowe</h4>
        <div style="display:flex; justify-content:space-around; text-align:center;">
            <div>
                <div class="stats-number">{{ $weeklyClients ?? 0 }}</div>
                <p>Nowych klientów (7 dni)</p>
            </div>
            <div>
                <div class="stats-number">{{ $weeklyCompanies ?? 0 }}</div>
                <p>Nowych firm (7 dni)</p>
            </div>
            <div>
                <div class="stats-number">{{ $weeklyPoints ?? 0 }}</div>
                <p>Przyznanych punktów</p>
            </div>
        </div>

        <div class="chart-container mt-4">
            <canvas id="pointsChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('pointsChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels ?? []),
            datasets: [{
                label: 'Punkty przyznane (7 dni)',
                data: @json($chartData ?? []),
                borderColor: '#2563eb',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>
@endsection
