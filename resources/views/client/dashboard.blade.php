<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Twoje punkty</title>
</head>
<body style="font-family: sans-serif; margin: 40px;">
    <h2>Witaj, {{ $client->name }}!</h2>
    <p>Twój aktualny stan punktów: <strong>{{ $points }}</strong></p>

    <h3>Historia punktów:</h3>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Data</th>
            <th>ID firmy</th>
            <th>Punkty</th>
            <th>Kwota</th>
        </tr>
        @foreach($history as $h)
        <tr>
            <td>{{ $h->created_at }}</td>
            <td>{{ $h->company_id }}</td>
            <td>{{ $h->points_awarded }}</td>
            <td>{{ $h->amount }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
