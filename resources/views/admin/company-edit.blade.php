@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edycja firmy</h1>

    @if ($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('companies.update', $company) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nazwa firmy:</label>
            <input type="text" name="name" value="{{ $company->name }}" required>
        </div>
        <div>
            <label>Kod pocztowy:</label>
            <input type="text" name="postal_code" value="{{ $company->postal_code }}" required>
        </div>
        <div>
            <label>Miasto:</label>
            <input type="text" name="city" value="{{ $company->city }}" required>
        </div>
        <div>
            <label>Ulica i nr:</label>
            <input type="text" name="street" value="{{ $company->street }}" required>
        </div>
        <div>
            <label>NIP:</label>
            <input type="text" name="nip" value="{{ $company->nip }}" required>
        </div>
        <div>
            <label>Adres e-mail:</label>
            <input type="email" name="email" value="{{ $company->email }}" required>
        </div>
        <div>
            <label>Telefon:</label>
            <input type="text" name="phone" value="{{ $company->phone }}" required>
        </div>

        <button type="submit">Zapisz zmiany</button>
    </form>
</div>
@endsection
