<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AURA BY KIYARA</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased text-gray-900 bg-soft-white">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <!-- Navigation -->
        <nav class="bg-white border-b border-gold-200 shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center">
                            <img src="{{ asset('images/logo2.jpg') }}" alt="Logo" class="h-16 w-auto mr-3">
                            <span class="text-2xl font-serif font-bold tracking-widest text-charcoal-900">AURA BY KIYARA</span>
                        </a>
                    </div>

                    <!-- Desktop Navigation Links & Icons -->
                    <div class="hidden sm:flex sm:items-center space-x-8">
                        <a href="{{ route('home') }}" class="text-charcoal-900 hover:text-gold-600 font-bold uppercase text-sm tracking-widest transition duration-300">Home</a>
                        
                        <!-- Collection Dropdown -->
                        <div class="relative group" x-data="{ open: false }">
                            <button @mouseenter="open = true" @click="open = !open" class="flex items-center text-charcoal-900 hover:text-gold-600 font-bold uppercase text-sm tracking-widest transition duration-300">
                                <span>Collection</span>
                                <svg class="ml-1 w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @mouseleave="open = false" x-cloak class="absolute left-0 mt-2 w-48 bg-white border border-gold-200 shadow-xl z-50 py-2 transform transition-all duration-300 origin-top">
                                <a href="{{ route('shop') }}" class="block px-4 py-2 text-sm text-charcoal-800 hover:bg-gold-50 hover:text-gold-600 font-semibold uppercase tracking-wider">All Collection</a>
                                <div class="border-t border-gold-100 my-1"></div>
                                <a href="{{ route('shop', ['category' => 'Men']) }}" class="block px-4 py-2 text-sm text-charcoal-800 hover:bg-gold-50 hover:text-gold-600 font-semibold uppercase tracking-wider">Men</a>
                                <a href="{{ route('shop', ['category' => 'Women']) }}" class="block px-4 py-2 text-sm text-charcoal-800 hover:bg-gold-50 hover:text-gold-600 font-semibold uppercase tracking-wider">Women</a>
                                <a href="{{ route('shop', ['category' => 'Kids']) }}" class="block px-4 py-2 text-sm text-charcoal-800 hover:bg-gold-50 hover:text-gold-600 font-semibold uppercase tracking-wider">Kids</a>
                                <a href="{{ route('shop', ['category' => 'Gifts']) }}" class="block px-4 py-2 text-sm text-charcoal-800 hover:bg-gold-50 hover:text-gold-600 font-semibold uppercase tracking-wider">Gifts</a>
                            </div>
                        </div>
                        <a href="{{ route('about') }}" class="text-charcoal-900 hover:text-gold-600 font-medium uppercase text-sm tracking-wide transition duration-300">About Us</a>
                        <a href="{{ route('contact') }}" class="text-charcoal-900 hover:text-gold-600 font-medium uppercase text-sm tracking-wide transition duration-300">Contact</a>
                        
                        @auth
                            @if(Auth::user()->role == 1)
                                <a href="{{ route('admin.dashboard') }}" class="text-charcoal-900 hover:text-gold-600 font-medium uppercase text-sm tracking-wide transition duration-300">Dashboard</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="text-charcoal-900 hover:text-gold-600 font-medium uppercase text-sm tracking-wide transition duration-300">Dashboard</a>
                            @endif
                        @else
                             <a href="{{ route('login') }}" class="text-charcoal-900 hover:text-gold-600 transition duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </a>
                        @endauth

                        <a href="{{ route('cart') }}" class="text-charcoal-900 hover:text-gold-600 relative transition duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            @if(session('cart'))
                                <span class="absolute -top-2 -right-2 bg-gold-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                    </div>

                    <!-- Mobile Hamburger Button -->
                    <div class="flex items-center sm:hidden">
                        <a href="{{ route('cart') }}" class="text-charcoal-900 hover:text-gold-600 relative transition duration-300 mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            @if(session('cart'))
                                <span class="absolute -top-2 -right-2 bg-gold-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ count(session('cart')) }}
                                </span>
                            @endif
                        </a>
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-charcoal-900 hover:text-gold-600 focus:outline-none">
                            <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': mobileMenuOpen, 'inline-flex': !mobileMenuOpen }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !mobileMenuOpen, 'inline-flex': mobileMenuOpen }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" class="sm:hidden border-t border-gray-100 bg-white shadow-inner">
                <div class="pt-2 pb-4 space-y-1 px-4">
                    <a href="{{ route('home') }}" class="block px-3 py-3 rounded-md text-base font-bold text-charcoal-900 hover:text-gold-600 hover:bg-gray-50 uppercase tracking-widest">Home</a>
                    
                    {{-- Mobile Collections (Expanded) --}}
                    <div class="space-y-1 pl-4 border-l-2 border-gold-200 my-2">
                        <a href="{{ route('shop') }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gold-600">All Collections</a>
                        <a href="{{ route('shop', ['category' => 'Men']) }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gold-600">Men</a>
                        <a href="{{ route('shop', ['category' => 'Women']) }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gold-600">Women</a>
                        <a href="{{ route('shop', ['category' => 'Kids']) }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gold-600">Kids</a>
                        <a href="{{ route('shop', ['category' => 'Gifts']) }}" class="block px-3 py-2 text-sm font-medium text-gray-600 hover:text-gold-600">Gifts</a>
                    </div>

                    <a href="{{ route('about') }}" class="block px-3 py-3 rounded-md text-base font-bold text-charcoal-900 hover:text-gold-600 hover:bg-gray-50 uppercase tracking-widest">About Us</a>
                    <a href="{{ route('contact') }}" class="block px-3 py-3 rounded-md text-base font-bold text-charcoal-900 hover:text-gold-600 hover:bg-gray-50 uppercase tracking-widest">Contact</a>
                    
                    @auth
                        @if(Auth::user()->role == 1)
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-3 rounded-md text-base font-bold text-charcoal-900 hover:text-gold-600 hover:bg-gray-50 uppercase tracking-widest">Dashboard</a>
                        @else
                            <a href="{{ route('dashboard') }}" class="block px-3 py-3 rounded-md text-base font-bold text-charcoal-900 hover:text-gold-600 hover:bg-gray-50 uppercase tracking-widest">Dashboard</a>
                        @endif
                        
                        {{-- Mobile Logout --}}
                        <form method="POST" action="{{ route('logout') }}" class="mt-2 text-center">
                            @csrf
                            <button type="submit" class="w-full bg-charcoal-900 text-white px-4 py-2 rounded uppercase font-bold text-xs tracking-widest hover:bg-gold-500 transition">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-3 rounded-md text-base font-bold text-charcoal-900 hover:text-gold-600 hover:bg-gray-50 uppercase tracking-widest">Login / Register</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            @if (session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative shadow-md" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if (session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative shadow-md" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
            {{ $slot }}
        </main>
        
        <footer class="bg-charcoal-900 text-white py-12 border-t-4 border-gold-500">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                 <div>
                     <h3 class="text-2xl font-serif font-bold mb-4 text-gold-400">Aura by Kiyara</h3>
                     <p class="text-gray-300 leading-relaxed">Discover our exclusive collection of hand-crafted perfumes. Essence of Elegance.</p>
                 </div>
                 <div>
                     <h3 class="text-lg font-bold mb-4 uppercase tracking-wider text-gold-400">Quick Links</h3>
                     <ul class="space-y-2">
                         <li><a href="{{ route('shop') }}" class="text-gray-300 hover:text-gold-400 transition">Collections</a></li>
                         <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-gold-400 transition">About Us</a></li>
                         <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-gold-400 transition">Contact Us</a></li>
                     </ul>
                 </div>
                 <div>
                     <h3 class="text-lg font-bold mb-4 uppercase tracking-wider text-gold-400">Contact</h3>
                     <p class="text-gray-300">Email: info@aurabykiyara.com</p>
                     <p class="text-gray-300">Phone: 0112345678</p>
                     <p class="text-gray-300">5th Lane, Mahara, Kadawatha</p> <!-- Updated address per history -->
                 </div>
            </div>
            <div class="text-center mt-8 pt-8 border-t border-gray-800 text-gray-500 text-sm">
                &copy; {{ date('Y') }} Aura by Kiyara. All rights reserved.
            </div>
        </footer>
    </div>
</body>
</html>
