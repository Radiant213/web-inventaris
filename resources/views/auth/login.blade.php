@extends('layouts.app')

@section('title', 'Login - Inventaris PPLG')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <!-- Card -->
        <div class="bg-white border border-charcoal/10 rounded-2xl p-8 shadow-sm">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="font-serif text-3xl font-semibold text-charcoal mb-2">Selamat Datang</h1>
                <p class="text-charcoal/60">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-charcoal mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal placeholder-charcoal/40 focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition @error('email') border-red-500 @enderror"
                           placeholder="nama@email.com">
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-charcoal mb-2">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full bg-cream border border-charcoal/20 rounded-xl px-4 py-3 text-charcoal placeholder-charcoal/40 focus:outline-none focus:border-earthy focus:ring-2 focus:ring-earthy/20 transition"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-charcoal/30 text-earthy focus:ring-earthy/20">
                        <span class="text-sm text-charcoal/70">Ingat saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-earthy text-cream py-4 rounded-full hover:bg-earthy-dark transition font-medium text-lg">
                    Masuk
                </button>
            </form>

            <!-- Register Link -->
            <div class="mt-8 text-center">
                <p class="text-charcoal/60">
                    Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-earthy hover:text-earthy-dark font-medium transition">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
