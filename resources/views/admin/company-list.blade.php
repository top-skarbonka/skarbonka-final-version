@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista firm</h1>

    @if(session('success'))
        <div style="color:green;">
            {{ session('success') }}
        </div>
    @endif

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nazwa</th>
                <th>Kod pocztowy</th>
                <th>Miasto</th>
                <th>Ulica</th>
                <th>NIP</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->postal_code }}</td>
                    <td>{{ $company->city }}</td>
                    <td>{{ $company->street }}</td>
                    <td>{{ $company->nip }}</td>
                    <td>{{ $company->email }}</td>
                    <td>{{ $company->phone }}</td>
                    <td>
                        <a href="{{ route('companies.edit', $company) }}">Edytuj</a> |
                        <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Na pewno chcesz usunąć?')">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('companies.create') }}">Dodaj nową firmę</a>
</div>
@endsection
