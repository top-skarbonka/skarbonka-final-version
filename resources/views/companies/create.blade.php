@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card shadow-lg p-4" style="max-width: 600px; width: 100%;">
        <h2 class="text-center text-primary mb-4">➕ Rejestracja firmy</h2>

        {{-- Komunikaty błędów --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formularz --}}
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Nazwa firmy</label>
                <input type="text" name="name" class="form-control" placeholder="np. Skarbonka Sp. z o.o.">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Kod pocztowy</label>
                    <input type="text" name="postal_code" class="form-control" placeholder="np. 39-460">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Miasto</label>
                    <input type="text" name="city" class="form-control" placeholder="np. Rzeszów">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Ulica</label>
                <input type="text" name="street" class="form-control" placeholder="np. Główna 12">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">NIP</label>
                    <input type="text" name="nip" class="form-control" placeholder="np. 8130001234">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-bold">Telefon</label>
                    <input type="text" name="phone" class="form-control" placeholder="np. 600700800">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Adres e-mail</label>
                <input type="email" name="email" class="form-control" placeholder="np. firma@domena.pl">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Przelicznik (1 zł = X punktów)</label>
                <input type="number" step="0.01" name="point_ratio" class="form-control" placeholder="np. 1 lub 0.5">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg px-5">
                    🚀 Zarejestruj firmę
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
