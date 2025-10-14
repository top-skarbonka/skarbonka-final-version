<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel firmy - {{ $company->name ?? 'Panel firmy' }}</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body {font-family: 'Inter', sans-serif; background:#111827; color:white; margin:0; padding:0;}
        .container {max-width:900px; margin:40px auto; background:#1f2937; padding:30px; border-radius:16px;}
        h1 {color:#facc15; text-align:center; margin-bottom:25px;}
        input {padding:10px; border-radius:8px; border:none; outline:none; background:#374151; color:white; width:100%;}
        input::placeholder {color:#9ca3af;}
        button {background:#facc15; color:#111827; font-weight:600; padding:12px; border:none; border-radius:8px; cursor:pointer;}
        button:hover {background:#eab308;}
        .alert {padding:10px; border-radius:8px; text-align:center; font-weight:600; margin-bottom:15px;}
        .alert-success {background-color:#16a34a; color:white;}
        .alert-error {background-color:#dc2626; color:white;}
        .form-row {display:flex; gap:10px; justify-content:space-between; margin-bottom:20px;}
        .stats {display:flex; justify-content:space-around; margin-top:30px;}
        .stat {background:#111827; padding:15px; border-radius:10px; width:22%; text-align:center;}
        .stat h3 {color:#facc15; margin:0;}
        .chart-container {margin-top:40px; background:#111827; padding:20px; border-radius:12px;}
    </style>
</head>
<body>
<div class="container">
    <h1>🏢 Panel firmy: {{ $company->name }}</h1>

    {{-- 🔔 komunikat dynamiczny --}}
    <div id="responseMessage"></div>

    {{-- 🧾 Formularz --}}
    <form id="addPointsForm">
        @csrf
        <div class="form-row">
            <input type="text" name="client_id" placeholder="ID klienta (np. 5736)" required>
            <input type="text" name="receipt_number" placeholder="Numer paragonu / faktury" required>
            <input type="number" step="0.01" name="amount" placeholder="Kwota z paragonu (zł)" required>
        </div>
        <button type="submit">➕ Dodaj punkty</button>
    </form>

    {{-- 📊 Statystyki --}}
    <div class="stats">
        <div class="stat"><h3>Tydzień</h3><p id="week">{{ $weeklyPoints ?? 0 }}</p></div>
        <div class="stat"><h3>Miesiąc</h3><p id="month">{{ $monthlyPoints ?? 0 }}</p></div>
        <div class="stat"><h3>Rok</h3><p id="year">{{ $yearlyPoints ?? 0 }}</p></div>
        <div class="stat"><h3>Łącznie</h3><p id="total">{{ $totalPoints ?? 0 }}</p></div>
    </div>

    {{-- 📈 Wykres --}}
    <div class="chart-container">
        <canvas id="pointsChart"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('pointsChart').getContext('2d');
const chartData = @json($chartData ?? []);
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.map(i => i.date),
        datasets: [{
            label: 'Punkty przyznane (ostatnie 7 dni)',
            data: chartData.map(i => i.total),
            borderColor: '#facc15',
            backgroundColor: 'rgba(250,204,21,0.2)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
        }]
    },
    options: {scales:{x:{ticks:{color:'white'}},y:{ticks:{color:'white'}}},plugins:{legend:{labels:{color:'white'}}}}
});

// 🧠 AJAX obsługa formularza
$('#addPointsForm').on('submit', function(e) {
    e.preventDefault();
    $('#responseMessage').html('');

    $.ajax({
        url: "{{ route('company.addPoints') }}",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            $('#responseMessage').html('<div class="alert alert-success">✅ Punkty dodane pomyślnie!</div>');
            $('#addPointsForm')[0].reset();
        },
        error: function(xhr) {
            let msg = xhr.responseJSON?.message || '❌ Wystąpił błąd podczas dodawania punktów.';
            $('#responseMessage').html('<div class="alert alert-error">' + msg + '</div>');
        }
    });
});
</script>
</body>
</html>
