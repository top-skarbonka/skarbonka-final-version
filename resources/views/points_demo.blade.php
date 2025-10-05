<!doctype html>
<html lang="pl">
<head>
  <meta charset="utf-8">
  <title>Demo przyznawania punktów</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 30px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
    th { background: #f4f4f4; }
    .msg { background: #e6ffe6; border: 1px solid #9f9; padding: 10px; margin-bottom: 15px; }
    form div { margin-bottom: 10px; }
    input { padding: 5px; }
    button { padding: 6px 14px; cursor: pointer; }
  </style>
</head>
<body>
  <h1>Demo przyznawania punktów</h1>
  @if(session('error'))
  <div class="msg" style="background:#ffe6e6; border:1px solid #f99; padding:10px; margin-bottom:15px;">
    {{ session('error') }}
  </div>
  @endif
  @if(session('success'))
    <div class="msg">{{ session('success') }}</div>
  @endif

  <form method="POST" action="/points-demo">
    @csrf
    <div>
      <label>Company ID: <input type="number" name="company_id" value="1" required></label>
    </div>
    <div>
      <label>Client ID: <input type="number" name="client_id" value="5" required></label>
    </div>
    <div>
      <label>Numer paragonu: <input type="text" name="receipt_number" value="FV/TEST/2025" required></label>
    </div>
    <div>
      <label>Kwota wydana (zł): <input type="number" step="0.01" name="amount_spent" value="100.00" required></label>
    </div>
    <button type="submit">Dodaj punkty</button>
  </form>

  <h2>Ostatnie wpisy</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Firma</th>
        <th>Klient</th>
        <th>Paragon</th>
        <th>Kwota</th>
        <th>Punkty</th>
        <th>Data</th>
      </tr>
    </thead>
    <tbody>
      @forelse($points as $p)
        <tr>
          <td>{{ $p->id }}</td>
          <td>{{ $p->company_id }}</td>
          <td>{{ $p->client_id }}</td>
          <td>{{ $p->receipt_number }}</td>
          <td>{{ $p->amount_spent }}</td>
          <td>{{ $p->points_awarded }}</td>
          <td>{{ $p->created_at }}</td>
        </tr>
      @empty
        <tr><td colspan="7">Brak danych</td></tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
