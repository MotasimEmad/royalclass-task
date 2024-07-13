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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300&display=swap" rel="stylesheet">

    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: white;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 50px;
            border: 2px solid #fff;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #374151;
        }
    </style>

    @yield('styles')
    @livewireStyles
</head>

<body class="bg-gray-200" dir="ltr" style="font-family: Cairo">
<div x-data="{ sidebarOpen: false }" class="relative flex h-screen text-gray-800 bg-white content">
    <div class="flex flex-col flex-1 overflow-hidden bg-gray-100">
        @include('components.header')
        <main class="flex-1 overflow-y-auto">
            <div class="px-4 py-8 sm:px-6">
                <div dir="rtl">
                    <div class="font-semibold mt-3 text-sm lg:items-center lg:flex whitespace-nowrap">
                        <a href="#" class="text-gray-600 hover:underline">
                            @stack('title')
                        </a>
                    </div>
                </div>
                <div class="mt-6">
                    @yield('content')
                </div>
            </div>
        </main>
    </div>
    @include('components.sidebar')
</div>
@yield('scripts')
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@livewireScripts
<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
</body>
</html>
