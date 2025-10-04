@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>🎉 Witaj w panelu firmy!</h1>
    <p>Zalogowałeś się pomyślnie jako firma.</p>

    <a href="{{ route('company.logout') }}" 
       class="btn btn-danger mt-3"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
       🚪 Wyloguj się
    </a>

    <form id="logout-form" action="{{ route('company.logout') }}" method="POST" style="display:none;">
        @csrf
    </form>
</div>
@endsection
