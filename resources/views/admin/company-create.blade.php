@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">➕ Rejestracja nowej firmy</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('companies.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nazwa firmy</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Kod pocztowy</label>
            <input type="text" name="postal_code" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Miasto</label>
            <input type="text" name="city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ulica i nr</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">NIP</label>
            <input type="text" name="nip" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Adres e-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Numer telefonu</label>
            <input type="text" name="phone" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Zarejestruj firmę</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">⬅ Powrót do listy</a>
    </form>
</div>
@endsection
