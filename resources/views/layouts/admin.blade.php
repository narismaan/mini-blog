<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>
    @viteReactRefresh
    @vite('resources/js/admin.jsx')
</head>
<body class="bg-gray-100 h-screen w-screen">
    @yield('content')
</body>
</html>
