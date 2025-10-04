@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">✏️ Edytuj firmę</h1>

    <form action="{{ route('companies.update', $company->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">📛 Nazwa firmy</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">📧 Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">📞 Telefon</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $company->phone }}">
        </div>

        <div class="mb-3">
            <label for="point_ratio" class="form-label">⚖️ Przelicznik zł → TopPoints</label>
            <input type="number" step="0.01" class="form-control" id="point_ratio" name="point_ratio" value="{{ $company->point_ratio ?? 1 }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">⚙️ Status firmy</label>
            <select class="form-control" id="status" name="status">
                <option value="active" {{ $company->status == 'active' ? 'selected' : '' }}>✅ Aktywna</option>
                <option value="suspended" {{ $company->status == 'suspended' ? 'selected' : '' }}>⏸️ Zawieszona</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">💾 Zapisz zmiany</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">⬅️ Wróć</a>
    </form>
</div>
@endsection
