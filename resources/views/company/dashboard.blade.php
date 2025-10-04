@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: 80px auto; background: #fff; padding: 40px; border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); text-align: center;">
    <h1 style="font-size: 28px; color: #2d3748;">🎉 Witaj w panelu firmy!</h1>
    <p style="color: #4a5568; margin-top: 15px;">
        Zalogowano pomyślnie jako <strong>{{ Auth::guard('company')->user()->name }}</strong>
    </p>

    <form method="POST" action="{{ route('company.logout') }}" style="margin-top: 25px;">
        @csrf
        <button type="submit" style="background-color: #e53e3e; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer;">
            🚪 Wyloguj się
        </button>
    </form>
</div>
@endsection
