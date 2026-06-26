@extends('layouts.landing')

@section('content')

@php
    // Ambil semua ID Unit yang sudah ada di dalam Cart agar tidak bisa dipilih lagi
    $inCartUnitIds = [];
    if(isset($cartItems)) {
        foreach($cartItems as $item) {
            if(isset($item->selected_units)) {
                foreach($item->selected_units as $u) {
                    $inCartUnitIds[] = $u->id;
                }
            }
        }
    }
@endphp

<div class="max-w-7xl mx-auto px-4 py-8 relative">

    <!-- Alert Messages -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Tombol Kembali -->
    <div class="mb-6">
        <a href="{{ route('units.katalog', ['tipe_id' => request('tipe_id')]) }}"
        class="inline-flex items-center gap-2 text-sm font-semibold uppercase tracking-wider text-gray-500 hover:text-yellow-600 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali ke Katalog
        </a>
    </div>

    <!-- Form Tambah ke Keranjang -->
    <form action="{{ route('cart.add') }}" method="POST" id="form-keranjang">
        @csrf
        <input type="hidden" name="barang_id" value="{{ $barang->id }}">

        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Kolom Kiri: Detail Barang -->
            <div class="w-full lg:w-2/3">
                <div class="mb-6">
                    <h1 class="text-3xl md:text-4xl font-bold text-black mb-2">{{ $barang->tipe->nama_tipe ?? '' }} - {{ $barang->nama_barang }}</h1>
                </div>

                <div class="flex flex-col md:flex-row gap-8 mb-8 items-center md:items-start">
                    <div class="w-full md:w-1/2 flex justify-center">
                        @if($barang->image)
                            <img src="{{ asset('images/' . $barang->image) }}"
                                alt="{{ $barang->nama_barang }}"
                                class="w-full object-contain drop-shadow-md">
                        @else
                            <div class="w-full h-48 bg-gray-100 border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center text-gray-400">
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>
                </div>

                @if($barang->hargaBarangs && $barang->hargaBarangs->isNotEmpty())
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-center border-t border-b border-gray-100 py-6 mb-10">
                        @foreach($barang->hargaBarangs as $harga)
                            <div>
                                <div class="text-gray-500 text-sm mb-2">{{ $harga->satuan }}</div>
                                <div class="text-black font-bold text-lg">
                                    @if(is_numeric($harga->harga))
                                        Rp. {{ number_format($harga->harga, 0, ',', '.') }}
                                    @else
                                        {{ $harga->harga }}
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if($barang->spesifikasis && $barang->spesifikasis->isNotEmpty())
                    <div class="mb-10">
                        <div class="flex flex-col border border-gray-200 overflow-hidden">
                            @foreach($barang->spesifikasis as $index => $spek)
                                <div class="flex justify-between px-6 py-3 text-sm {{ $index % 2 == 0 ? 'bg-gray-200/80' : 'bg-slate-50' }}">
                                    <div class="w-1/2 text-gray-700 font-medium">{{ $spek->key }}</div>
                                    <div class="w-1/2 text-gray-800">{{ $spek->value }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- PANGGIL KOMPONEN PILIHAN UNIT (Dari folder detail-katalog) -->
                <x-landing.detail-katalog.unit-selector :units="$barang->units" :inCartUnitIds="$inCartUnitIds" />
                
            </div>

            <!-- PANGGIL KOMPONEN SIDEBAR KANAN (Dari folder detail-katalog) -->
            <div class="w-full lg:w-1/3">
                <x-landing.detail-katalog.detail-sidebar 
                    :barangLainnya="$barangLainnya" 
                    :cartCount="session('cart') ? count(session('cart')) : 0" 
                />
            </div>

        </div>
    </form>
</div>

<!-- Pemanggilan Komponen Modal -->
<!-- (Diasumsikan cart-modal tetap di folder landing, jika dipindah sesuaikan juga ya) -->
<x-landing.cart-modal :cartItems="$cartItems ?? []" />

<!-- Script Interaksi Checkbox -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.unit-checkbox');
        const btnKeranjang = document.getElementById('btn-keranjang');

        function checkStatus() {
            // Cek jika ada minimal 1 checkbox yang tercentang
            let isChecked = Array.from(checkboxes).some(box => box.checked);
            
            // Toggle status disabled pada tombol
            btnKeranjang.disabled = !isChecked;
        }

        checkboxes.forEach(function(box) {
            box.addEventListener('change', checkStatus);
        });
    });
</script>
@endsection