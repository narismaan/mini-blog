<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --soft-pink: #fff0f5;
            --glam-pink: #ff66b2;
            --rosy-beige: #eee7eb;
            --champagne-gold: #f4d4ba;
            --mauve-pink: #d88cb7;
            --deep-berry: #b13579;
            --charcoal-gray: #444444;
        }
    </style>
</head>
<body class="font-poppins bg-[var(--soft-pink)] min-h-screen flex flex-col justify-center items-center py-6">

    <div>
        <a href="{{ url('/') }}" class="flex items-center justify-center mb-6">
            <h1 class="font-playfair text-[var(--glam-pink)] text-4xl ml-4 font-bold">ANAIA MUSIC BLOG</h1>
        </a>
    </div>

    <div class="w-full max-w-md px-8 py-6 bg-white rounded-xl border-4 border-double border-[var(--deep-berry)] shadow-lg">
        {{ $slot }}
    </div>

</body>
</html>
