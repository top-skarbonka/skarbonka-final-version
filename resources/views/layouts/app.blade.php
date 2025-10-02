<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col">
        {{-- Górny pasek / menu --}}
        @include('layouts.navigation')

        {{-- Główna zawartość --}}
        <main class="flex-grow">
            @yield('content')
        </main>

        {{-- Stopka --}}
        <footer class="bg-gray-200 text-center py-4 mt-4">
            <p class="text-sm text-gray-600">© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. Wszelkie prawa zastrzeżone.</p>
        </footer>
    </div>
</body>
</html>
