<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }} - @yield('title', 'Mini Blog')</title>
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

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="text-gray-700 min-h-screen flex flex-col" style="background-color: var(--soft-pink);">

    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto px-6 py-8 space-y-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[var(--glam-pink)] text-white py-6 text-center font-semibold">
        &copy; ANAIA BLOG {{ date('Y') }}
    </footer>

</body>
</html>
