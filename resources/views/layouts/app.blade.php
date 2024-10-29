<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="flex">
        <!-- Sidebar -->
<nav class=" bg-gray-800 text-white min-h-screen">
    <div class="p-6">
        <h2 class="text-xl font-semibold mb-6">E-Vote</h2>
        <ul>
            <li class="mb-4">
                <a href="{{ route('vote.index') }}" class="hover:underline">Voting</a>
            </li>
            @if (Auth::check() && Auth::user()->role === 'admin')
                <li class="mb-4">
                    <a href="{{ route('candidates.index') }}" class="hover:underline">Candidates</a>
                </li>
                <li class="mb-4">
                    <a href="{{ route('candidates.create') }}" class="hover:underline">Add Candidate</a> <!-- New link -->
                </li>
                <li class="mb-4">
                    <a href="{{ route('results') }}" class="hover:underline">Voting Results</a>
                </li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left hover:underline">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>


        <div class="flex-1 min-h-screen bg-gray-100">
            <div class="">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white dark:bg-gray-800 shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>
</body>
</html>