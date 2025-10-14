@extends('layouts.app')

@section('content')
<div class="min-h-screen flex justify-center items-center bg-gradient-to-br from-gray-100 to-blue-100">
    <div class="bg-white shadow-xl rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">🔐 Logowanie do panelu firmy</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('company.login.submit') }}" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 mb-1 font-medium">Adres e-mail</label>
                <input type="email" id="email" name="email" placeholder="Adres e-mail"
                       class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       required autofocus>
            </div>

            <div>
                <label for="password" class="block text-gray-700 mb-1 font-medium">Hasło</label>
                <input type="password" id="password" name="password" placeholder="Wpisz hasło"
                       class="border rounded-lg p-2 w-full focus:ring-2 focus:ring-blue-400 focus:outline-none"
                       required>
            </div>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg w-full shadow transition">
                Zaloguj się
            </button>
        </form>
    </div>
</div>
@endsection
