<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard Admin - Inventaris PPLG</title>
    
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
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-cream min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="flex">
        <!-- Sidebar Overlay (Mobile) -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" 
             class="fixed inset-0 bg-charcoal/50 z-40 lg:hidden" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:leave="transition-opacity ease-linear duration-300"></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-charcoal/10 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto">
            <!-- Logo -->
            <div class="h-20 flex items-center px-6 border-b border-charcoal/10">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-earthy rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-cream" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <span class="font-serif text-xl font-semibold text-charcoal">Inventaris PPLG</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-earthy/10 text-earthy font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.items.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-charcoal/70 hover:bg-cream transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Kelola Barang
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-charcoal/70 hover:bg-cream transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Kelola Kategori
                </a>
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-charcoal/70 hover:bg-cream transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    Katalog
                </a>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-charcoal/10">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 bg-earthy/20 rounded-full flex items-center justify-center">
                        <span class="text-earthy font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                    </div>
                    <div>
                        <p class="font-medium text-charcoal text-sm">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-charcoal/50">Administrator</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 text-charcoal/70 hover:text-charcoal py-2 rounded-xl hover:bg-cream transition text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 min-h-screen">
            <!-- Top Bar -->
            <header class="h-20 bg-white border-b border-charcoal/10 flex items-center justify-between px-6">
                <button @click="sidebarOpen = true" class="lg:hidden text-charcoal p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="font-serif text-2xl font-semibold text-charcoal">Dashboard</h1>
                <div></div>
            </header>

            <!-- Content -->
            <div class="p-6">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Stats Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    <div class="bg-white border border-charcoal/10 rounded-2xl p-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-charcoal">{{ $pendingBorrowings->count() }}</p>
                                <p class="text-sm text-charcoal/60">Menunggu</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white border border-charcoal/10 rounded-2xl p-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-charcoal">{{ $allBorrowings->where('status', 'approved')->count() }}</p>
                                <p class="text-sm text-charcoal/60">Disetujui</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white border border-charcoal/10 rounded-2xl p-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-red-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-charcoal">{{ $allBorrowings->where('status', 'rejected')->count() }}</p>
                                <p class="text-sm text-charcoal/60">Ditolak</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white border border-charcoal/10 rounded-2xl p-5">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-charcoal">{{ $allBorrowings->where('status', 'returned')->count() }}</p>
                                <p class="text-sm text-charcoal/60">Dikembalikan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Section -->
                <div class="bg-white border border-charcoal/10 rounded-2xl overflow-hidden mb-8">
                    <div class="px-6 py-5 border-b border-charcoal/10">
                        <h2 class="font-serif text-xl font-semibold text-charcoal">Permintaan Menunggu</h2>
                    </div>

                    @if($pendingBorrowings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-cream/50">
                                    <tr>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Peminjam</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Peralatan</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Jumlah</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Periode</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-charcoal/10">
                                    @foreach($pendingBorrowings as $borrowing)
                                        <tr class="hover:bg-cream/30 transition">
                                            <td class="px-6 py-4">
                                                <div>
                                                    <p class="font-medium text-charcoal">{{ $borrowing->user->name }}</p>
                                                    <p class="text-sm text-charcoal/50">{{ $borrowing->user->email }}</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="font-medium text-charcoal">{{ $borrowing->item->name }}</p>
                                                <p class="text-sm text-charcoal/50">{{ $borrowing->item->category->name }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-charcoal">{{ $borrowing->amount }} unit</td>
                                            <td class="px-6 py-4 text-charcoal text-sm">
                                                {{ $borrowing->borrow_date->format('d M') }} - {{ $borrowing->return_date->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2">
                                                    <form action="{{ route('admin.approve', $borrowing->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-600 transition">
                                                            Setujui
                                                        </button>
                                                    </form>
                                                    <form action="{{ route('admin.reject', $borrowing->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition">
                                                            Tolak
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <svg class="w-12 h-12 text-charcoal/20 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-charcoal/60">Tidak ada permintaan yang menunggu</p>
                        </div>
                    @endif
                </div>

                <!-- All Borrowings Section -->
                <div class="bg-white border border-charcoal/10 rounded-2xl overflow-hidden">
                    <div class="px-6 py-5 border-b border-charcoal/10">
                        <h2 class="font-serif text-xl font-semibold text-charcoal">Semua Peminjaman</h2>
                    </div>

                    @if($allBorrowings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-cream/50">
                                    <tr>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Peminjam</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Peralatan</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Jumlah</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Periode</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Status</th>
                                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-charcoal/10">
                                    @foreach($allBorrowings as $borrowing)
                                        <tr class="hover:bg-cream/30 transition">
                                            <td class="px-6 py-4">
                                                <p class="font-medium text-charcoal">{{ $borrowing->user->name }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-charcoal">{{ $borrowing->item->name }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-charcoal">{{ $borrowing->amount }}</td>
                                            <td class="px-6 py-4 text-charcoal text-sm">
                                                {{ $borrowing->borrow_date->format('d M') }} - {{ $borrowing->return_date->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @switch($borrowing->status)
                                                    @case('pending')
                                                        <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                                                            Menunggu
                                                        </span>
                                                        @break
                                                    @case('approved')
                                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                                            Disetujui
                                                        </span>
                                                        @break
                                                    @case('rejected')
                                                        <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                                            Ditolak
                                                        </span>
                                                        @break
                                                    @case('returned')
                                                        <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                                            Dikembalikan
                                                        </span>
                                                        @break
                                                @endswitch
                                            </td>
                                            <td class="px-6 py-4">
                                                @if($borrowing->status === 'approved')
                                                    <form action="{{ route('admin.returned', $borrowing->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        <button type="submit" class="bg-blue-500 text-white px-3 py-1.5 rounded-lg text-xs font-medium hover:bg-blue-600 transition">
                                                            Tandai Kembali
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-charcoal/40 text-sm">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <p class="text-charcoal/60">Belum ada data peminjaman</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
