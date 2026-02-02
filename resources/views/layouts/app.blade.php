<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Inventaris PPLG')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        cream: '#F9F7F2',
                        charcoal: '#2C2C2C',
                        earthy: '#8D7B68',
                        'earthy-dark': '#746350',
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body class="bg-cream min-h-screen">
    <!-- Navbar -->
    <nav class="bg-cream border-b border-charcoal/10" x-data="{ open: false, dropdown: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-earthy rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-cream" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <span class="font-serif text-2xl font-semibold text-charcoal">Inventaris PPLG</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('home') }}" class="text-charcoal hover:text-earthy transition font-medium">Katalog</a>
                    @auth
                        <a href="{{ route('history') }}" class="text-charcoal hover:text-earthy transition font-medium">Riwayat Saya</a>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-charcoal hover:text-earthy transition font-medium">Dashboard Admin</a>
                        @endif
                    @endauth
                    
                    @guest
                        <a href="{{ route('login') }}" class="text-charcoal hover:text-earthy transition font-medium">Login</a>
                        <a href="{{ route('register') }}" class="bg-earthy text-cream px-6 py-2.5 rounded-full hover:bg-earthy-dark transition font-medium">Register</a>
                    @else
                        <div class="relative" x-data="{ dropdown: false }">
                            <button @click="dropdown = !dropdown" class="flex items-center gap-2 text-charcoal hover:text-earthy transition">
                                <div class="w-9 h-9 bg-earthy/20 rounded-full flex items-center justify-center">
                                    <span class="text-earthy font-semibold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                </div>
                                <span class="font-medium">Halo, {{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 transition-transform" :class="dropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="dropdown" @click.away="dropdown = false" x-transition
                                 class="absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-charcoal/10 py-2 z-50">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-charcoal hover:bg-cream transition">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                <!-- Mobile Menu Button -->
                <div class="flex items-center md:hidden">
                    <button @click="open = !open" class="text-charcoal p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden border-t border-charcoal/10">
            <div class="px-4 py-4 space-y-3">
                <a href="{{ route('home') }}" class="block text-charcoal hover:text-earthy transition py-2">Katalog</a>
                @auth
                    <a href="{{ route('history') }}" class="block text-charcoal hover:text-earthy transition py-2">Riwayat Saya</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block text-charcoal hover:text-earthy transition py-2">Dashboard Admin</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="pt-2 border-t border-charcoal/10">
                        @csrf
                        <button type="submit" class="text-charcoal hover:text-earthy transition py-2">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block text-charcoal hover:text-earthy transition py-2">Login</a>
                    <a href="{{ route('register') }}" class="block bg-earthy text-cream px-4 py-2 rounded-full text-center hover:bg-earthy-dark transition">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-cream border-t border-charcoal/10 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-earthy rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-cream" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <span class="font-serif text-lg font-medium text-charcoal">Inventaris PPLG</span>
                </div>
                <p class="text-charcoal/60 text-sm">© {{ date('Y') }} Inventaris PPLG. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
