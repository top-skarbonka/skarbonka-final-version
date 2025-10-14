@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 max-w-lg bg-white p-6 rounded-xl shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">✏️ Edycja firmy: {{ $company->name }}</h2>

    <form method="POST" action="{{ route('admin.companies.update', $company) }}" class="space-y-3">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $company->name }}" placeholder="Nazwa firmy" class="border rounded w-full p-2" required>
        <input type="email" name="email" value="{{ $company->email }}" placeholder="Adres e-mail" class="border rounded w-full p-2" required>
        <input type="text" name="city" value="{{ $company->city }}" placeholder="Miasto" class="border rounded w-full p-2">
        <input type="text" name="postal_code" value="{{ $company->postal_code }}" placeholder="Kod pocztowy" class="border rounded w-full p-2">
        <input type="text" name="street" value="{{ $company->street }}" placeholder="Ulica" class="border rounded w-full p-2">
        <input type="text" name="phone" value="{{ $company->phone }}" placeholder="Telefon" class="border rounded w-full p-2">
        <input type="number" step="0.01" name="point_ratio" value="{{ $company->point_ratio }}" placeholder="Przelicznik zł → Top Points" class="border rounded w-full p-2">

        <button type="submit" class="bg-green-600 text-white py-2 rounded w-full">💾 Zapisz zmiany</button>
    </form>
</div>
@endsection
