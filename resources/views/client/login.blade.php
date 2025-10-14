<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Klienta</title>
</head>
<body style="font-family: sans-serif; text-align:center; margin-top: 60px;">
    <h2>Panel Klienta</h2>

    <form action="{{ route('client.login.qr') }}" method="POST">
        @csrf
        <label for="client_code">Twój kod klienta (QR):</label><br>
        <input type="text" name="client_code" placeholder="np. 4369" required><br><br>
        <button type="submit">Zaloguj się</button>
    </form>

    @if(session('error'))
        <p style="color:red; margin-top:10px;">{{ session('error') }}</p>
    @endif
</body>
</html>
