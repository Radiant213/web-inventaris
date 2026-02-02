<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang - Admin Inventaris PPLG</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
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
<body class="bg-cream min-h-screen">
    <div class="max-w-2xl mx-auto px-4 py-12">
        <!-- Back Button -->
        <a href="{{ route('admin.items.index') }}" class="inline-flex items-center gap-2 text-charcoal/70 hover:text-charcoal mb-6 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Barang
        </a>

        <div class="bg-white border border-charcoal/10 rounded-2xl p-8">
            <h1 class="font-serif text-2xl font-semibold text-charcoal mb-6">Edit Barang</h1>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-charcoal mb-2">Nama Barang *</label>
                    <input type="text" name="name" value="{{ old('name', $item->name) }}" required 
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-2">Kategori *</label>
                    <select name="category_id" required class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-2">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $item->brand) }}" 
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-2">Stok *</label>
                    <input type="number" name="stock" min="0" value="{{ old('stock', $item->stock) }}" required 
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition">
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal mb-2">Gambar</label>
                    @if($item->image_url)
                        <div class="mb-3">
                            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-32 h-32 object-cover rounded-xl">
                            <p class="text-xs text-charcoal/50 mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*" 
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition">
                    <p class="text-xs text-charcoal/50 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                </div>

                <div class="flex gap-3 pt-4">
                    <a href="{{ route('admin.items.index') }}" class="flex-1 bg-charcoal/10 text-charcoal py-4 rounded-full hover:bg-charcoal/20 transition font-medium text-lg text-center">
                        Batal
                    </a>
                    <button type="submit" class="flex-1 bg-earthy text-cream py-4 rounded-full hover:bg-earthy-dark transition font-medium text-lg">
                        Update Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
