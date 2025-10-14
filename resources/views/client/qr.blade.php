@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md p-6 bg-white rounded-2xl shadow-lg text-center mt-10">
    <h2 class="text-2xl font-bold text-purple-700 mb-4">🎉 Gratulacje, {{ $client->name }}!</h2>
    <p class="text-gray-700 mb-3">Twój unikalny kod klienta:</p>
    <p class="text-lg font-mono text-gray-900 mb-4">{{ $client->client_code }}</p>

    <img src="{{ $qrPath }}" alt="Kod QR" class="mx-auto mb-4 w-64 h-64 rounded-xl shadow">

    @if($banner)
        <div class="mt-4">
            <img src="{{ $banner }}" alt="Baner" class="mx-auto rounded-lg shadow" style="width:400px; height:80px; object-fit:contain;">
        </div>
    @endif

    <p class="mt-4 text-green-600 font-semibold">🎁 Otrzymałeś {{ $bonusPoints }} Top Points za zgody marketingowe!</p>
</div>
@endsection
