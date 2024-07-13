<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hashtag My Business</title>
    <link rel="icon" type="image/x-icon" href="/public/logo/logo-no-background%201.svg" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">

<body class="bg-gray-200" dir="ltr" style="font-family: Cairo">
<div x-data="{ sidebarOpen: false }" class="relative flex h-screen text-gray-800 bg-white content">
    <div class="flex flex-col flex-1 overflow-hidden bg-gray-100">
        @yield('content')
    </div>
</div>
</body>
</html>
