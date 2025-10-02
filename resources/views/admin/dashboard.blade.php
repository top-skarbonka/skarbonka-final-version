@extends('layouts.admin')

@section('content')
<div class="container py-5">

    <!-- Nagłówek -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">⚡ Top-Skarbonka — Panel Admina</h1>
        <p class="text-muted">Zarządzaj firmami, klientami i całym systemem lojalnościowym w jednym miejscu.</p>
    </div>

    <!-- Komunikaty -->
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Karty akcji -->
    <div class="row g-4">
        <!-- Firmy -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3">🏢</div>
                    <h4 class="card-title mb-3">Firmy</h4>
                    <p class="text-muted">Przeglądaj, dodawaj i edytuj firmy w systemie.</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('companies.index') }}" class="btn btn-primary">📋 Lista firm</a>
                        <a href="{{ route('companies.create') }}" class="btn btn-success">➕ Rejestruj firmę</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Klienci -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3">🧑‍🤝‍🧑</div>
                    <h4 class="card-title mb-3">Klienci</h4>
                    <p class="text-muted">Podgląd danych klientów i ich punktów.</p>
                    <button class="btn btn-secondary" disabled>🚧 Wkrótce</button>
                </div>
            </div>
        </div>

        <!-- Ustawienia -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100 hover-card">
                <div class="card-body text-center">
                    <div class="display-4 mb-3">⚙️</div>
                    <h4 class="card-title mb-3">Ustawienia</h4>
                    <p class="text-muted">Zarządzaj ustawieniami programu lojalnościowego.</p>
                    <button class="btn btn-secondary" disabled>🚧 Wkrótce</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Style dla efektów hover -->
<style>
    .hover-card:hover {
        transform: translateY(-5px);
        transition: 0.3s ease-in-out;
    }
</style>
@endsection
