@extends('layouts.app')

@section('title', 'Katalog - Inventaris PPLG')

@section('content')
<style>
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
    }
    .animate-fade-in {
        animation: fadeIn 1s ease-out forwards;
    }
    .delay-100 { animation-delay: 0.1s; opacity: 0; }
    .delay-200 { animation-delay: 0.2s; opacity: 0; }
    .delay-300 { animation-delay: 0.3s; opacity: 0; }
    
    /* Interactive Card Hover */
    .item-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .item-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -5px rgba(44, 44, 44, 0.1);
    }
    
    /* Smooth Image Zoom */
    .img-zoom-container {
        overflow: hidden;
    }
    .img-zoom {
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .item-card:hover .img-zoom {
        transform: scale(1.1);
    }
</style>

<div x-data="{ 
    openModal: false, 
    selectedItem: null,
    openItem(item) {
        this.selectedItem = item;
        this.openModal = true;
    }
}" class="overflow-x-hidden">
    <!-- Hero Section -->
    <section class="bg-cream relative overflow-hidden">
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-earthy/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-earthy/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/4"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-24 items-center">
                <!-- Text Content -->
                <div class="animate-fade-in-up">
                    <span class="inline-block px-4 py-1.5 rounded-full border border-earthy/30 bg-white/50 backdrop-blur-sm text-earthy text-sm font-semibold tracking-wide mb-6">
                        INVENTARIS LABORATORIUM
                    </span>
                    <h1 class="font-serif text-5xl lg:text-7xl font-bold text-charcoal leading-[1.1] mb-8">
                        Pinjam Alat<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-earthy to-[#C1A88B]">Praktikum PPLG</span>
                    </h1>
                    <p class="text-charcoal/70 text-lg lg:text-xl leading-relaxed mb-10 max-w-lg delay-100 animate-fade-in-up">
                        Sistem peminjaman alat praktikum modern. Temukan, pinjam, dan kembalikan peralatan dengan mudah dan terorganisir.
                    </p>
                    <div class="flex flex-wrap gap-4 delay-200 animate-fade-in-up">
                        <a href="#katalog" class="group relative px-8 py-4 bg-earthy text-cream rounded-full overflow-hidden shadow-lg shadow-earthy/20 hover:shadow-earthy/40 transition-all duration-300">
                            <div class="absolute inset-0 w-full h-full bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                            <span class="relative font-medium text-lg flex items-center gap-2">
                                Lihat Katalog
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                        </a>
                        <a href="{{ route('history') }}" class="px-8 py-4 border border-charcoal/20 text-charcoal rounded-full hover:bg-white hover:border-earthy hover:text-earthy transition-all duration-300 font-medium text-lg">
                            Riwayat Saya
                        </a>
                    </div>
                </div>

                <!-- Hero Image / Logo with Float Animation -->
                <div class="relative lg:h-[600px] flex items-center justify-center delay-300 animate-fade-in-up">
                    <div class="relative w-full max-w-lg aspect-square">
                        <!-- Background Circle -->
                        <div class="absolute inset-0 bg-gradient-to-br from-white to-cream rounded-full shadow-2xl border-4 border-white/50 backdrop-blur-xl animate-float"></div>
                        
                        <!-- Logo Image -->
                        <div class="absolute inset-0 flex items-center justify-center animate-float" style="animation-delay: -3s;">
                            <img src="{{ asset('images/logo-pplg.png') }}" 
                                 alt="Logo PPLG" 
                                 class="w-3/4 h-3/4 object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500">
                        </div>

                        <!-- Floating Cards Decorations -->
                        <div class="absolute -right-8 top-1/4 bg-white p-4 rounded-2xl shadow-xl border border-charcoal/5 animate-float" style="animation-delay: -1s;">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-charcoal/50 font-medium">Status</p>
                                    <p class="text-sm font-bold text-charcoal">Tersedia</p>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -left-4 bottom-1/4 bg-white p-4 rounded-2xl shadow-xl border border-charcoal/5 animate-float" style="animation-delay: -4s;">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-earthy/20 rounded-full flex items-center justify-center text-earthy">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-charcoal/50 font-medium">Peminjaman</p>
                                    <p class="text-sm font-bold text-charcoal">Cepat & Mudah</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Catalog Section -->
    <section id="katalog" class="bg-white relative py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16" x-intersect="$el.classList.add('animate-fade-in-up')">
                <h2 class="font-serif text-4xl lg:text-5xl font-semibold text-charcoal mb-4">Katalog Peralatan</h2>
                <div class="w-24 h-1 bg-earthy mx-auto rounded-full mb-6"></div>
                <p class="text-charcoal/60 max-w-2xl mx-auto text-lg">Jelajahi koleksi peralatan praktikum berkualitas tinggi yang siap menunjang pembelajaran Anda.</p>
            </div>

            <!-- Search & Filter -->
            <div class="mb-16 sticky top-20 z-40 bg-white/80 backdrop-blur-md py-4 rounded-3xl border border-charcoal/5 shadow-sm transition-all duration-300">
                <form method="GET" action="{{ route('home') }}" class="max-w-5xl mx-auto px-4">
                    <div class="flex flex-col md:flex-row gap-6 items-center justify-center">
                        <!-- Search Input -->
                        <div class="w-full md:w-96 relative group">
                            <input type="text" name="search" value="{{ request('search') }}" 
                                   placeholder="Cari peralatan..." 
                                   class="w-full bg-cream border-2 border-transparent focus:bg-white focus:border-earthy rounded-full px-6 py-3 pl-14 text-charcoal placeholder-charcoal/40 focus:outline-none focus:ring-4 focus:ring-earthy/10 transition-all duration-300 shadow-inner">
                            <svg class="w-5 h-5 text-charcoal/40 absolute left-5 top-1/2 -translate-y-1/2 group-focus-within:text-earthy transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <!-- Category Pills -->
                        <div class="flex flex-wrap justify-center gap-3">
                            <a href="{{ route('home', ['search' => request('search')]) }}" 
                               class="px-6 py-2.5 rounded-full border-2 transition-all duration-300 font-medium text-sm {{ !request('category') ? 'bg-earthy text-cream border-earthy shadow-lg shadow-earthy/20 scale-105' : 'bg-transparent text-charcoal/60 border-charcoal/10 hover:border-earthy hover:text-earthy hover:bg-earthy/5' }}">
                                Semua
                            </a>
                            @foreach($categories as $category)
                                <a href="{{ route('home', ['category' => $category->id, 'search' => request('search')]) }}" 
                                   class="px-6 py-2.5 rounded-full border-2 transition-all duration-300 font-medium text-sm {{ request('category') == $category->id ? 'bg-earthy text-cream border-earthy shadow-lg shadow-earthy/20 scale-105' : 'bg-transparent text-charcoal/60 border-charcoal/10 hover:border-earthy hover:text-earthy hover:bg-earthy/5' }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>

            <!-- Items Grid -->
            @if($items->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($items as $item)
                        <div class="item-card bg-cream border border-charcoal/5 rounded-[2rem] overflow-hidden group h-full flex flex-col relative">
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4 z-20">
                                <span class="bg-white/90 backdrop-blur-md text-charcoal text-xs font-bold px-4 py-1.5 rounded-full shadow-sm border border-charcoal/5">
                                    {{ $item->category->name }}
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="aspect-[4/3] bg-white relative img-zoom-container">
                                @if($item->image_url)
                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="img-zoom w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                        <svg class="w-16 h-16 text-earthy/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                <!-- Overlay on Hover -->
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/5 transition-colors duration-300"></div>
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex flex-col flex-1">
                                <div class="flex-1">
                                    <h3 class="font-serif text-xl font-bold text-charcoal mb-1 line-clamp-1 group-hover:text-earthy transition-colors">{{ $item->name }}</h3>
                                    <p class="text-charcoal/50 text-sm mb-4 font-medium">{{ $item->brand ?? 'No Brand' }}</p>
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-charcoal/10 flex items-center justify-between gap-4">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-charcoal/50 font-medium uppercase tracking-wider">Stok</span>
                                        <span class="font-bold {{ $item->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                                            {{ $item->stock > 0 ? $item->stock . ' Unit' : 'Habis' }}
                                        </span>
                                    </div>

                                    @if($item->stock > 0)
                                        @auth
                                            <button @click="openItem({ id: {{ $item->id }}, name: '{{ addslashes($item->name) }}', stock: {{ $item->stock }} })" 
                                                    class="flex-shrink-0 w-10 h-10 bg-earthy text-cream rounded-full flex items-center justify-center hover:bg-earthy-dark hover:scale-110 active:scale-95 transition-all shadow-md shadow-earthy/20">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" 
                                               class="flex-shrink-0 w-10 h-10 bg-earthy text-cream rounded-full flex items-center justify-center hover:bg-earthy-dark hover:scale-110 active:scale-95 transition-all shadow-md shadow-earthy/20">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                            </a>
                                        @endauth
                                    @else
                                        <button disabled class="flex-shrink-0 w-10 h-10 bg-gray-200 text-gray-400 rounded-full flex items-center justify-center cursor-not-allowed">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-20 px-4 text-center">
                    <div class="w-24 h-24 bg-cream rounded-full flex items-center justify-center mb-6 animate-pulse">
                        <svg class="w-10 h-10 text-charcoal/20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-serif text-2xl font-bold text-charcoal mb-2">Tidak Ditemukan</h3>
                    <p class="text-charcoal/60 max-w-md">Maaf, kami tidak dapat menemukan peralatan yang Anda cari. Coba kata kunci lain atau kategori berbeda.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Borrowing Modal with Animation -->
    <div x-show="openModal" class="relative z-50">
        <!-- Backdrop -->
        <div x-show="openModal" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="transition ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-charcoal/60 backdrop-blur-sm" 
             @click="openModal = false"></div>
        
        <!-- Modal Content -->
        <div class="fixed inset-0 overflow-y-auto">
            <div class="flex min-h-full items-center justify-center p-4 text-center">
                <div x-show="openModal" 
                     x-transition:enter="transition ease-out duration-300" 
                     x-transition:enter-start="opacity-0 scale-90 translate-y-4" 
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0" 
                     x-transition:leave="transition ease-in duration-200" 
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0" 
                     x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                     class="w-full max-w-md transform overflow-hidden rounded-3xl bg-white p-8 text-left align-middle shadow-2xl transition-all border border-charcoal/5 relative">
                    
                    <!-- Decorative background pattern -->
                    <div class="absolute top-0 right-0 w-32 h-32 bg-earthy/5 rounded-bl-full -z-10"></div>
                    
                    <button @click="openModal = false" class="absolute top-4 right-4 text-charcoal/30 hover:text-charcoal transition-colors p-2 rounded-full hover:bg-cream">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <div class="mb-8">
                        <span class="inline-block px-3 py-1 bg-earthy/10 text-earthy text-xs font-bold rounded-full mb-3">FORM PEMINJAMAN</span>
                        <h3 class="font-serif text-3xl font-bold text-charcoal mb-2" x-text="selectedItem ? selectedItem.name : ''"></h3>
                        <p class="text-charcoal/60 text-sm">Lengkapi formulir di bawah ini untuk mengajukan peminjaman.</p>
                    </div>

                    <form action="{{ route('borrowings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="item_id" :value="selectedItem ? selectedItem.id : ''">
                        
                        <div>
                            <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Jumlah Barang</label>
                            <div class="relative flex items-center">
                                <button type="button" onclick="this.parentNode.querySelector('input').stepDown()" class="absolute left-0 w-10 h-full text-charcoal/50 hover:text-charcoal hover:bg-cream rounded-l-xl transition">-</button>
                                <input type="number" name="amount" min="1" :max="selectedItem ? selectedItem.stock : 1" value="1" required
                                       class="w-full bg-cream border border-charcoal/10 rounded-xl py-3 text-center text-charcoal font-bold focus:outline-none focus:ring-2 focus:ring-earthy/20 transition appearance-none">
                                <button type="button" onclick="this.parentNode.querySelector('input').stepUp()" class="absolute right-0 w-10 h-full text-charcoal/50 hover:text-charcoal hover:bg-cream rounded-r-xl transition">+</button>
                            </div>
                            <p class="text-xs text-right text-charcoal/40 mt-1.5" x-text="selectedItem ? 'Tersedia: ' + selectedItem.stock + ' unit' : ''"></p>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Tanggal Pinjam</label>
                                <input type="date" name="borrow_date" required min="{{ date('Y-m-d') }}"
                                       class="w-full bg-white border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition text-sm">
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-charcoal uppercase tracking-wider mb-2">Tanggal Kembali</label>
                                <input type="date" name="return_date" required min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       class="w-full bg-white border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition text-sm">
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-earthy text-cream py-4 rounded-xl hover:bg-earthy-dark hover:shadow-lg hover:shadow-earthy/20 hover:-translate-y-0.5 active:translate-y-0 active:shadow-none transition-all duration-200 font-bold text-lg tracking-wide">
                            Ajukan Peminjaman
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
