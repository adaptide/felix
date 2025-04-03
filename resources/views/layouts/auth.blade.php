<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite('resources/css/app.css')

    <!-- Scripts -->
    @vite('resources/js/app.js')
    @livewireStyles
</head>
<body class="font-sans antialiased bg-background text-foreground min-h-screen flex flex-col">
    <div class="flex min-h-screen">
        <div class="flex flex-col justify-center items-center w-full">
            <div class="w-full max-w-md px-8 py-12">
                <div class="flex justify-center mb-8">
                    <a href="{{ route('home') }}" class="text-2xl font-bold">            {{ config('app.name', 'Felix') }}
                    </a>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>

    @livewireScripts
</body>
</html>

