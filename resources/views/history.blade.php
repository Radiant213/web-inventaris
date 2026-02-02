@extends('layouts.app')

@section('title', 'Riwayat Saya - Inventaris PPLG')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Header -->
    <div class="mb-10">
        <h1 class="font-serif text-3xl lg:text-4xl font-semibold text-charcoal mb-2">Riwayat Peminjaman</h1>
        <p class="text-charcoal/60">Lihat status dan riwayat peminjaman Anda</p>
    </div>

    @if($borrowings->count() > 0)
        <!-- Desktop Table -->
        <div class="hidden md:block bg-white border border-charcoal/10 rounded-2xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-cream/50">
                    <tr>
                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Peralatan</th>
                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Jumlah</th>
                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Tanggal Pinjam</th>
                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Tanggal Kembali</th>
                        <th class="text-left text-sm font-semibold text-charcoal px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-charcoal/10">
                    @foreach($borrowings as $borrowing)
                        <tr class="hover:bg-cream/30 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-cream rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-6 h-6 text-earthy/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium text-charcoal">{{ $borrowing->item->name }}</p>
                                        <p class="text-sm text-charcoal/50">{{ $borrowing->item->brand ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-charcoal">{{ $borrowing->amount }} unit</td>
                            <td class="px-6 py-4 text-charcoal">{{ $borrowing->borrow_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-charcoal">{{ $borrowing->return_date->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @switch($borrowing->status)
                                    @case('pending')
                                        <span class="inline-flex items-center gap-1.5 bg-yellow-50 text-yellow-700 px-3 py-1 rounded-full text-sm font-medium">
                                            <span class="w-1.5 h-1.5 bg-yellow-500 rounded-full"></span>
                                            Menunggu
                                        </span>
                                        @break
                                    @case('approved')
                                        <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                                            <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span>
                                            Disetujui
                                        </span>
                                        @break
                                    @case('rejected')
                                        <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-700 px-3 py-1 rounded-full text-sm font-medium">
                                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full"></span>
                                            Ditolak
                                        </span>
                                        @break
                                    @case('returned')
                                        <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-sm font-medium">
                                            <span class="w-1.5 h-1.5 bg-blue-500 rounded-full"></span>
                                            Dikembalikan
                                        </span>
                                        @break
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="md:hidden space-y-4">
            @foreach($borrowings as $borrowing)
                <div class="bg-white border border-charcoal/10 rounded-2xl p-5">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-cream rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-earthy/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-charcoal">{{ $borrowing->item->name }}</p>
                                <p class="text-sm text-charcoal/50">{{ $borrowing->amount }} unit</p>
                            </div>
                        </div>
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
                    </div>
                    <div class="flex gap-6 text-sm text-charcoal/70">
                        <div>
                            <span class="text-charcoal/50">Pinjam:</span> {{ $borrowing->borrow_date->format('d M Y') }}
                        </div>
                        <div>
                            <span class="text-charcoal/50">Kembali:</span> {{ $borrowing->return_date->format('d M Y') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-20 bg-white border border-charcoal/10 rounded-2xl">
            <svg class="w-16 h-16 text-charcoal/20 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            <h3 class="font-serif text-xl text-charcoal mb-2">Belum Ada Riwayat</h3>
            <p class="text-charcoal/60 mb-6">Anda belum pernah melakukan peminjaman.</p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 bg-earthy text-cream px-6 py-3 rounded-full hover:bg-earthy-dark transition font-medium">
                Lihat Katalog
            </a>
        </div>
    @endif
</div>
@endsection
