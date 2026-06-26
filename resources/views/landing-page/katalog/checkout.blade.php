@extends('layouts.landing')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    
    <!-- Header Section -->
    <div class="mb-10 text-center md:text-left">
        <h1 class="text-3xl font-extrabold text-slate-900 uppercase tracking-wider mb-2">Formulir Pemesanan</h1>
        <p class="text-slate-500 text-lg">Lengkapi data diri dan jadwal penyewaan di bawah ini untuk memproses pesanan.</p>
    </div>

    @if($errors->any())
        <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg shadow-sm">
            <div class="flex items-center mb-2">
                <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <h3 class="text-red-800 font-bold">Mohon periksa kembali isian Anda:</h3>
            </div>
            <ul class="list-disc ml-7 text-sm text-red-700 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
        
        <!-- Left Column: Form -->
        <div class="w-full lg:w-2/3">
            <form action="{{ route('checkout.process') }}" method="POST" class="bg-slate-50 border border-slate-200 p-8 md:p-10 rounded-2xl shadow-xl shadow-slate-200/40 relative overflow-hidden">
                @csrf
                
                <!-- Aksen Garis Atas Form -->
                <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#fca311] to-orange-500"></div>
                
                <div class="mb-8 border-b border-slate-100 pb-4">
                    <h3 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                        <span class="bg-orange-100 text-[#fca311] p-2 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        Informasi Pemesan
                    </h3>
                </div>
                
                <!-- Grid 2 Kolom untuk Info Pemesan -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    
                    <!-- Baris 1 -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Pemesan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pemesan" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#fca311]/50 focus:border-[#fca311] transition-all" placeholder="Contoh: Budi Santoso">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">No. HP / WhatsApp <span class="text-red-500">*</span></label>
                        <input type="text" name="no_hp" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#fca311]/50 focus:border-[#fca311] transition-all" placeholder="Contoh: 08123456789">
                    </div>

                    <!-- Baris 2 -->
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email <span class="text-red-500">*</span></label>
                        <input type="email" name="emails" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#fca311]/50 focus:border-[#fca311] transition-all" placeholder="nama@perusahaan.com">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nama Perusahaan <span class="text-slate-400 font-normal">(Opsional)</span></label>
                        <input type="text" name="perusahaan" class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#fca311]/50 focus:border-[#fca311] transition-all" placeholder="PT. Pembangunan Maju">
                    </div>
                    
                    <!-- Baris 3 (Full Width) -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Proyek / Pengiriman <span class="text-red-500">*</span></label>
                        <textarea name="alamat" required rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#fca311]/50 focus:border-[#fca311] transition-all" placeholder="Tuliskan alamat lengkap lokasi proyek..."></textarea>
                    </div>
                </div>

                <div class="mt-10 mb-8 border-b border-slate-100 pb-4">
                    <h3 class="text-2xl font-bold text-slate-800 flex items-center gap-3">
                        <span class="bg-orange-100 text-[#fca311] p-2 rounded-lg">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </span>
                        Jadwal Sewa
                    </h3>
                </div>
                
                <!-- Grid 2 Kolom untuk Jadwal -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#fca311]/50 focus:border-[#fca311] transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Selesai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_selesai" required class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#fca311]/50 focus:border-[#fca311] transition-all">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex flex-col-reverse md:flex-row justify-end gap-4 pt-6 border-t border-slate-100">
                    <a href="{{ route('units.katalog') }}" class="px-6 py-3.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors text-center">Kembali ke Katalog</a>
                    <button type="submit" class="px-8 py-3.5 bg-[#fca311] hover:bg-orange-500 text-slate-900 font-bold rounded-xl shadow-lg shadow-orange-500/30 transition-all text-center">Selesaikan Pesanan</button>
                </div>
            </form>
        </div>

        <!-- Right Column: Ringkasan -->
        <div class="w-full lg:w-1/3">
            <div class="bg-slate-50 border border-slate-200 p-8 rounded-2xl shadow-xl shadow-slate-200/40 sticky top-8">
                <h3 class="text-lg font-extrabold text-slate-800 mb-6 uppercase tracking-wider border-b border-slate-100 pb-4">Ringkasan Pesanan</h3>
                
                <div class="flex flex-col gap-5 mb-4 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between items-start border-b border-slate-100 pb-5 last:border-0 last:pb-0">
                            <div class="flex-1">
                                <h4 class="font-bold text-slate-800 mb-2">{{ $item->nama_barang ?? 'Unit Alat Berat' }}</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($item->selected_units as $u)
                                        <div class="inline-flex items-center bg-slate-50 rounded-lg overflow-hidden border border-slate-200 shadow-sm group">
                                            <span class="px-2.5 py-1 text-xs font-bold text-slate-700">#{{ $u->kode_unit }}</span>
                                            
                                            <a href="{{ route('cart.removeUnit', ['barangId' => $item->id, 'unitId' => $u->id]) }}" 
                                               class="px-2 py-1 bg-slate-100 group-hover:bg-red-500 group-hover:text-white text-slate-400 transition-colors flex items-center justify-center border-l border-slate-200" 
                                               title="Batal Sewa Unit Ini">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Hapus Semua Unit Button -->
                            <a href="{{ route('cart.remove', $item->id) }}" class="ml-4 p-2 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all" title="Hapus dari keranjang">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection