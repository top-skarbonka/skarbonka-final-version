@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100 py-12 px-6 flex flex-col items-center">

    {{-- Tytuł --}}
    <h1 class="text-3xl font-extrabold text-gray-800 text-center mb-2 animate-fade-in">
        📜 Historia punktów
    </h1>
    <p class="text-gray-600 text-center mb-8 animate-fade-in delay-100">
        Sprawdź, jak zdobywałeś swoje Top Points 💎
    </p>

    {{-- Karta podsumowania --}}
    <div class="bg-white rounded-2xl shadow-lg p-6 w-full max-w-2xl mb-8 text-center animate-slide-up">
        <p class="text-lg text-gray-600">Masz obecnie:</p>
        <h2 class="text-5xl font-extrabold text-purple-600 my-2">
            {{ number_format($points->sum('amount'), 2) }}
            <span class="text-gray-700 text-2xl">Top Points</span>
        </h2>
        <p class="text-sm text-gray-500">
            🎁 Możesz wymienić punkty na nagrody w zakładce
            <span class="font-semibold text-purple-700">Vouchery</span>
        </p>
    </div>

    {{-- Tabela historii punktów --}}
    @if($points->isEmpty())
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-md p-6 text-center text-gray-600 max-w-2xl animate-fade-in">
            😔 Brak zapisanych punktów – zbieraj je, by wymieniać na nagrody!
        </div>
    @else
        <div class="bg-white/80 backdrop-blur-md rounded-2xl shadow-lg p-6 w-full max-w-4xl animate-slide-up">
            <table class="min-w-full text-left text-gray-800">
                <thead>
                    <tr class="border-b border-gray-200">
                        <th class="py-3 px-4 font-semibold text-gray-700">📅 Data</th>
                        <th class="py-3 px-4 font-semibold text-gray-700">📄 Źródło</th>
                        <th class="py-3 px-4 font-semibold text-gray-700 text-right">💎 Punkty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($points as $index => $p)
                        <tr class="border-b border-gray-100 hover:bg-purple-50 transition-all duration-200 {{ $index == 0 ? 'bg-purple-50/70 shadow-sm animate-pulse-once' : '' }}">
                            <td class="py-2 px-4 text-gray-600">{{ $p->created_at->format('d.m.Y H:i') }}</td>
                            <td class="py-2 px-4">{{ $p->source ?? 'Nieznane źródło' }}</td>
                            <td class="py-2 px-4 text-right font-bold {{ $p->amount > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $p->amount > 0 ? '+' : '' }}{{ number_format($p->amount, 2) }} pkt
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

{{-- Animacje CSS --}}
<style>
@keyframes fade-in {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes slide-up {
    from { opacity: 0; transform: translateY(40px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes pulse-once {
    0% { background-color: rgba(168, 85, 247, 0.2); }
    50% { background-color: rgba(168, 85, 247, 0.4); }
    100% { background-color: rgba(168, 85, 247, 0.2); }
}
.animate-fade-in { animation: fade-in 0.6s ease-out forwards; }
.animate-slide-up { animation: slide-up 0.7s ease-out forwards; }
.delay-100 { animation-delay: 0.1s; }
.animate-pulse-once { animation: pulse-once 1.8s ease-in-out; }
</style>
@endsection
