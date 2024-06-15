<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'INC Hymns') }}</title>

        <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Other head elements -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* Adjust the body padding to account for fixed headers */
            body {
                padding-top: 100px; /* Adjust as necessary to match the combined height of Navigation and Page Heading */
            }
            .fixed-header {
                position: fixed;
                top: 0;
                width: 100%;
                z-index: 50;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            }
            .fixed-page-heading {
                position: fixed;
                top: 60px; /* Adjust based on the height of the navigation */
                width: 100%;
                z-index: 40;
                box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>

    <body class="font-sans antialiased">

    @if(Request::is('musics'))
        <!-- Fixed Icon -->
        <div id="fixedIcon" class="fixed top-1/2 transform -translate-y-1/2 left-0 z-50" style="margin-top:300px;">
            <button id="showCategoriesModal" class="text-white bg-gray-800 rounded-full p-3 focus:outline-none hover:bg-gray-700">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    @endif

        <div class="min-h-screen bg-white-100 dark:bg-gray-900">
            <!-- Navigation -->
            <div class="fixed-header">
                @include('layouts.navigation')
            </div>

            <!-- Page Heading -->
            @if (isset($header))
                <header class="fixed-page-heading bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="mt-24">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
