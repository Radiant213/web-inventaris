<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Admin Inventaris PPLG</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
<body class="bg-cream min-h-screen" x-data="{ sidebarOpen: false, showAddModal: false, showEditModal: false, editId: null, editName: '' }">
    <div class="flex">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-charcoal/10 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto">
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

            <nav class="p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-charcoal/70 hover:bg-cream transition">
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
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-earthy/10 text-earthy font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Kelola Kategori
                </a>
                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-charcoal/70 hover:bg-cream transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"></path>
                    </svg>
                    Lihat Katalog
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-charcoal/10">
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
            <header class="h-20 bg-white border-b border-charcoal/10 flex items-center justify-between px-6">
                <button @click="sidebarOpen = true" class="lg:hidden text-charcoal p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h1 class="font-serif text-2xl font-semibold text-charcoal">Kelola Kategori</h1>
                <button @click="showAddModal = true" class="bg-earthy text-cream px-5 py-2.5 rounded-xl hover:bg-earthy-dark transition font-medium text-sm flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Kategori
                </button>
            </header>

            <div class="p-6">
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

                <!-- Categories Grid -->
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @forelse($categories as $category)
                        <div class="bg-white border border-charcoal/10 rounded-2xl p-5">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-12 h-12 bg-earthy/10 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-earthy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <span class="text-xs text-charcoal/50">{{ $category->items_count }} barang</span>
                            </div>
                            <h3 class="font-semibold text-charcoal text-lg mb-4">{{ $category->name }}</h3>
                            <div class="flex items-center gap-2">
                                <button @click="editId = {{ $category->id }}; editName = '{{ $category->name }}'; showEditModal = true" 
                                        class="flex-1 bg-blue-500 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-600 transition text-center">
                                    Edit
                                </button>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-500 text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12 bg-white border border-charcoal/10 rounded-2xl">
                            <p class="text-charcoal/60">Belum ada kategori. Klik "Tambah Kategori" untuk menambahkan.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div x-show="showAddModal" x-transition class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="min-h-screen px-4 flex items-center justify-center">
            <div class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm" @click="showAddModal = false"></div>
            
            <div class="relative bg-cream rounded-2xl shadow-xl max-w-md w-full p-8 border border-charcoal/10">
                <button @click="showAddModal = false" class="absolute top-4 right-4 text-charcoal/40 hover:text-charcoal transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <h3 class="font-serif text-2xl font-semibold text-charcoal mb-6">Tambah Kategori Baru</h3>

                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-2">Nama Kategori *</label>
                        <input type="text" name="name" required class="w-full bg-white border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition">
                    </div>
                    <button type="submit" class="w-full bg-earthy text-cream py-4 rounded-full hover:bg-earthy-dark transition font-medium text-lg">
                        Simpan Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div x-show="showEditModal" x-transition class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="min-h-screen px-4 flex items-center justify-center">
            <div class="fixed inset-0 bg-charcoal/50 backdrop-blur-sm" @click="showEditModal = false"></div>
            
            <div class="relative bg-cream rounded-2xl shadow-xl max-w-md w-full p-8 border border-charcoal/10">
                <button @click="showEditModal = false" class="absolute top-4 right-4 text-charcoal/40 hover:text-charcoal transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>

                <h3 class="font-serif text-2xl font-semibold text-charcoal mb-6">Edit Kategori</h3>

                <form :action="'{{ route('admin.categories.update', '') }}/' + editId" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-charcoal mb-2">Nama Kategori *</label>
                        <input type="text" name="name" x-model="editName" required class="w-full bg-white border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition">
                    </div>
                    <button type="submit" class="w-full bg-earthy text-cream py-4 rounded-full hover:bg-earthy-dark transition font-medium text-lg">
                        Update Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
