<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie firmy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .btn-custom {
            background-color: #0d6efd;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-custom:hover {
            background-color: #0b5ed7;
        }
    </style>
</head>
<body>
<div class="login-card text-center">
    <h3 class="mb-4">🔐 Logowanie firmy</h3>

    @if ($errors->any())
        <div class="alert alert-danger text-start">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('company.login.submit') }}">
        @csrf
        <div class="mb-3 text-start">
            <label for="company_id" class="form-label">ID firmy</label>
            <input type="text" class="form-control" id="company_id" name="company_id" required>
        </div>

        <div class="mb-3 text-start">
            <label for="password" class="form-label">Hasło</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-custom w-100">Zaloguj się</button>
    </form>
</div>
</body>
</html>
