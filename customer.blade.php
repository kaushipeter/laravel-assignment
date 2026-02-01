<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Customer</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">
    <div class="min-h-screen flex flex-col">
        <!-- Customer Navigation -->
        <nav class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Welcome Message -->
                        <div class="shrink-0 flex items-center">
                            <h2 class="text-lg font-medium text-gray-800">Welcome, {{ Auth::user()->email }}</h2>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('my.orders')" :active="request()->routeIs('my.orders')">
                                {{ __('My Orders') }}
                            </x-nav-link>
                            <x-nav-link :href="route('shop')" :active="request()->routeIs('shop')">
                                {{ __('Continue Shopping') }}
                            </x-nav-link>
                            <x-nav-link :href="route('my.messages')" :active="request()->routeIs('my.messages')">
                                {{ __('My Messages') }}
                            </x-nav-link>
                        </div>
                    </div>

                    <!-- Logout -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                         <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-red-600 hover:text-red-900 font-medium">
                                {{ __('Logout') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow p-6">
            @if(session('success'))
                <div class="max-w-7xl mx-auto mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
             @if(session('error'))
                <div class="max-w-7xl mx-auto mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{ $slot }}
        </main>
        
        <footer class="bg-gray-800 text-white py-4 text-center">
             <p>&copy; {{ date('Y') }} Aura by Kiyara. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>
