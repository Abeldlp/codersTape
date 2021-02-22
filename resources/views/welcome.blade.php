<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-blue-900 dark:bg-gray-900 sm:items-center sm:pt-0 flex flex-col">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-blue-200 underline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-blue-200 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-blue-200 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="font-semibold text-2xl text-blue-200">Welcome to our contest!</div>

            <form action="/contest" method="POST">
                @csrf
                <input name="email" />
                <button>Enter Now</button>
            </form>
        </div>
    </body>
</html>
