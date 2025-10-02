@extends('layouts.admin')

@section('content')
<div class="container mt-4">

    <h1 class="mb-4">📋 Lista firm</h1>

    {{-- komunikaty --}}
    @if(session('success'))
        <div class="card border-success mb-4 shadow-sm">
            <div class="card-body text-success">
                {!! session('success') !!}
            </div>
        </div>
    @endif

    <table class="table table-hover table-bordered align-middle shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID firmy</th>
                <th>Nazwa</th>
                <th>Email</th>
                <th>Telefon</th>
                <th>Status</th>
                <th>Hasło (plain)</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
            <tr>
                <td><strong>{{ $company->company_code }}</strong></td>
                <td>{{ $company->name }}</td>
                <td>{{ $company->email }}</td>
                <td>{{ $company->phone }}</td>
                <td>
                    @if($company->status === 'active')
                        <span class="badge bg-success">Aktywna</span>
                    @else
                        <span class="badge bg-secondary">Zawieszona</span>
                    @endif
                </td>
                <td>
                    @if($company->plain_password)
                        <code>{{ $company->plain_password }}</code>
                    @else
                        <span class="text-muted">ukryte</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-warning btn-sm">✏️ Edytuj</a>
                    <form action="{{ route('companies.destroy', $company) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Na pewno usunąć?')">🗑️ Usuń</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
