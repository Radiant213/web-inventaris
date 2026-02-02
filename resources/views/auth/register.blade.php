@extends('layouts.app')

@section('title', 'Register - Inventaris PPLG')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white border border-charcoal/10 rounded-2xl p-8 shadow-sm">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="font-serif text-3xl font-semibold text-charcoal mb-2">Buat Akun</h1>
                <p class="text-charcoal/60">Daftar untuk mulai meminjam peralatan</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-charcoal mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal placeholder-charcoal/40 focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition @error('name') border-red-500 @enderror"
                           placeholder="Nama lengkap Anda">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-charcoal mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal placeholder-charcoal/40 focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition @error('email') border-red-500 @enderror"
                           placeholder="nama@email.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-charcoal mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal placeholder-charcoal/40 focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition @error('password') border-red-500 @enderror"
                           placeholder="Minimal 8 karakter">
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-charcoal mb-2">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal placeholder-charcoal/40 focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition"
                           placeholder="Ulangi password">
                </div>

                <button type="submit" class="w-full bg-earthy text-cream py-4 rounded-full hover:bg-earthy-dark transition font-medium text-lg">
                    Daftar
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-8 text-center">
                <p class="text-charcoal/60">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-earthy hover:text-earthy-dark font-medium transition">Masuk</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
