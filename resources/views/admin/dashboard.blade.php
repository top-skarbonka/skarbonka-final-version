@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">👑 Panel Administratora</h2>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm">🚪 Wyloguj się</button>
        </form>
    </div>

    <p class="text-muted mb-4">Zarządzaj firmami, klientami i monitoruj wyniki programu lojalnościowego</p>

    <!-- Lista firm -->
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold text-secondary">🏢 Lista firm</h5>
                <a href="{{ route('company.register') }}" class="btn btn-outline-primary btn-sm">＋ Zarejestruj firmę</a>
            </div>

            <input type="text" id="searchCompany" class="form-control form-control-sm mb-3" placeholder="🔍 Szukaj po ID lub e-mailu">

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:5%">ID</th>
                            <th style="width:20%">Nazwa</th>
                            <th style="width:25%">Email</th>
                            <th style="width:20%">Miasto</th>
                            <th style="width:30%">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>{{ $company->id }}</td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->city ?? '—' }}</td>
                                <td>
                                    <a href="#" class="text-primary">✏️</a>
                                    <a href="#" class="text-warning">⏸️</a>
                                    <a href="#" class="text-danger">🗑️</a>
                                    <a href="#" class="text-info">🔄</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Lista klientów -->
    <div class="card mb-5 shadow-sm border-0">
        <div class="card-body">
            <h5 class="fw-bold text-secondary mb-3">🧍 Lista klientów</h5>

            <input type="text" id="searchClient" class="form-control form-control-sm mb-3" placeholder="🔍 Szukaj po ID lub e-mailu">

            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th style="width:5%">ID</th>
                            <th style="width:25%">Imię i nazwisko</th>
                            <th style="width:25%">Email</th>
                            <th style="width:20%">Miasto</th>
                            <th style="width:10%">Punkty</th>
                            <th style="width:15%">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->city ?? '—' }}</td>
                                <td>{{ $client->points ?? 0 }}</td>
                                <td>
                                    <a href="#" class="text-primary">✏️</a>
                                    <a href="#" class="text-warning">⏸️</a>
                                    <a href="#" class="text-danger">🗑️</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Statystyki -->
    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <h5 class="fw-bold text-secondary mb-4">📊 Statystyki tygodniowe</h5>
            <div class="row mb-4">
                <div class="col-md-4">
                    <h2 class="text-primary fw-bold">{{ $weeklyClients }}</h2>
                    <p class="text-muted">Nowych klientów (7 dni)</p>
                </div>
                <div class="col-md-4">
                    <h2 class="text-success fw-bold">{{ $weeklyCompanies }}</h2>
                    <p class="text-muted">Nowych firm (7 dni)</p>
                </div>
                <div class="col-md-4">
                    <h2 class="text-warning fw-bold">{{ $weeklyPoints }}</h2>
                    <p class="text-muted">Przyznanych punktów</p>
                </div>
            </div>
            <div style="height:300px;">
                <canvas id="pointsChart"></canvas>
            </div>
        </div>
    </div>
</div>

<style>
body { background:#f8fafc; }
.card { border-radius:12px; }
.table th { font-weight:600; }
.table td { font-size:0.95rem; }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx=document.getElementById('pointsChart');
new Chart(ctx,{
  type:'line',
  data:{
    labels:{!!json_encode($chartLabels)!!},
    datasets:[{label:'Punkty (7 dni)',data:{!!json_encode($chartPoints)!!},
    borderColor:'#4e73df',backgroundColor:'rgba(78,115,223,0.15)',borderWidth:2,tension:0.3,fill:true}]
  },
  options:{responsive:true,scales:{y:{beginAtZero:true}}}
});
</script>
@endsection
