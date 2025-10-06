@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-6 text-center">
    <h1 class="text-2xl font-bold mb-4 text-green-600">🎉 Rejestracja zakończona!</h1>

    @if(session('success'))
        <p class="text-green-700 mb-4 font-semibold">{{ session('success') }}</p>
    @endif

    <p class="text-gray-700 mb-6">
        Dziękujemy za rejestrację, <strong>{{ $client->name }}</strong>!<br>
        Poniżej znajdziesz swój unikalny kod QR.
    </p>

    {{-- Kod QR --}}
    <div class="flex justify-center mb-6">
        {!! QrCode::size(200)->generate($qrUrl) !!}
    </div>

    <p class="text-gray-600 text-sm mb-4">
        Zeskanuj ten kod w dowolnej firmie uczestniczącej w programie,<br>
        aby otrzymywać punkty za zakupy 🎁
    </p>

    <a href="/" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow">
        Strona główna
    </a>
</div>
@endsection
