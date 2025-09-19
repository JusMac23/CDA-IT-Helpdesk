<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CDA-Helpdesk') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased m-0">
        <div class="min-h-screen flex items-center justify-center bg-gray-100">
            <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <div class="flex justify-center mb-4">
                    <a href="{{ route('login') }}" class="block">
                        <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" alt="Cooperative Development Authority Seal" class="w-20 h-20 object-contain" />
                    </a>
                </div>

                    <h2 class="text-center text-2xl font-semibold mb-6">
                        @php
                            $route = Route::currentRouteName();
                        @endphp

                        @if ($route === 'login')
                            Sign In
                        @elseif ($route === 'register')
                            Sign Up User
                        @elseif ($route === 'forgot-password')
                            Forgot Password
                        @elseif ($route === 'reset-password')
                            Reset Password
                        @else
                           
                        @endif
                    </h2>

                {{ $slot }}
            </div>
        </div>
    </body>
</html>
