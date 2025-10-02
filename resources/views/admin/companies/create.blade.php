@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
        <h2 class="text-center mb-4">➕ Rejestracja firmy</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Błąd!</strong> Popraw dane:
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
                <label for="name" class="form-label">Nazwa firmy</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Wpisz nazwę firmy">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="postal_code" class="form-label">Kod pocztowy</label>
                    <input type="text" name="postal_code" id="postal_code" class="form-control" placeholder="00-000">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">Miasto</label>
                    <input type="text" name="city" id="city" class="form-control" placeholder="Miasto">
                </div>
            </div>

            <div class="mb-3">
                <label for="street" class="form-label">Ulica i numer</label>
                <input type="text" name="street" id="street" class="form-control" placeholder="np. Główna 15/2">
            </div>

            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="text" name="nip" id="nip" class="form-control" placeholder="NIP">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adres e-mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="firma@example.com">
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Telefon</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="123-456-789">
            </div>

            <div class="mb-3">
                <label for="point_ratio" class="form-label">Przelicznik zł → Top Points</label>
                <input type="number" step="0.01" name="point_ratio" id="point_ratio" class="form-control" value="1.00">
                <small class="text-muted">Np. 1 zł = 0.5 punktów → wpisz 0.5</small>
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">✅ Zarejestruj firmę</button>
        </form>
    </div>
</div>
@endsection
