@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4">

    <!-- Header & Tombol Kembali -->
    <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-5">
        <div>
            <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider">Detail Pemesanan #{{ $pemesanan->id }}</h2>
        </div>
        <a href="{{ route('pemesanan.index') }}" 
           class="text-xs font-bold text-gray-500 uppercase tracking-widest hover:text-yellow-600 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Kiri: Detail Informasi Pesanan -->
        <div class="md:col-span-2 space-y-6">
            
            <!-- Box Data Diri Pelanggan -->
            <div class="bg-slate-50 p-6 rounded-lg border border-gray-200 shadow-sm">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4 border-b border-gray-100 pb-2">Informasi Pemesan</h3>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500 mb-1">Nama Lengkap</p>
                        <p class="font-bold text-gray-800">{{ $pemesanan->nama_pemesan }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Perusahaan</p>
                        <p class="font-bold text-gray-800">{{ $pemesanan->perusahaan ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Nomor HP</p>
                        <p class="font-bold text-gray-800">{{ $pemesanan->no_hp }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500 mb-1">Durasi Sewa</p>
                        <p class="font-bold text-gray-800">
                            {{ $pemesanan->tanggal_mulai ? $pemesanan->tanggal_mulai->format('d M Y') : '-' }} - 
                            {{ $pemesanan->tanggal_selesai ? $pemesanan->tanggal_selesai->format('d M Y') : '-' }}
                        </p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-500 mb-1">Alamat / Lokasi Proyek</p>
                        <p class="font-bold text-gray-800">{{ $pemesanan->alamat }}</p>
                    </div>
                </div>
            </div>

            <!-- Box Daftar Unit yang disewa -->
            <div class="bg-slate-50 p-6 rounded-lg border border-gray-200 shadow-sm">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4 border-b border-gray-100 pb-2">Alat Berat & Unit</h3>
                
                <div class="space-y-4">
                    @foreach($pemesanan->details as $detail)
                        <div class="border border-gray-100 rounded p-4 bg-gray-50">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="font-bold text-gray-800 uppercase">{{ $detail->barang->nama_barang ?? 'Barang Dihapus' }}</h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ $detail->qty }} Unit x Rp {{ number_format($detail->harga, 0, ',', '.') }} / {{ $detail->satuan }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-500">Durasi: {{ $detail->durasi }} {{ $detail->satuan }}</p>
                                </div>
                            </div>
                            
                            <!-- Menampilkan Unit Spesifik yang Dipilih -->
                            @if($detail->units && $detail->units->count() > 0)
                                <div class="flex flex-wrap gap-2 mt-2">
                                    @foreach($detail->units as $pu)
                                        <span class="inline-flex items-center px-2.5 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded border border-yellow-300">
                                            KODE: {{ $pu->unit->kode_unit ?? 'N/A' }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

        <!-- Kanan: Box Update Status (Action form yg kamu request) -->
        <div class="md:col-span-1">
            <div class="bg-slate-50 p-6 rounded-lg border border-gray-200 shadow-sm sticky top-6">
                <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4 border-b border-gray-100 pb-2">Update Status</h3>
                
                <!-- Ganti action form ini sesuai dengan nama route yang kamu daftarkan untuk updateStatus -->
                <form method="POST" action="{{ route('pemesanan.updateStatus', $pemesanan->id) }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Status Pesanan</label>
                        <select name="status" class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-3 outline-none transition shadow-sm font-semibold">
                            <option value="pending" {{ strtolower($pemesanan->status) == 'pending' ? 'selected' : '' }}>PENDING</option>
                            <option value="ongoing" {{ strtolower($pemesanan->status) == 'ongoing' ? 'selected' : '' }}>ONGOING</option>
                            <option value="confirmed" {{ strtolower($pemesanan->status) == 'confirmed' ? 'selected' : '' }}>CONFIRMED</option>
                            <option value="cancelled" {{ strtolower($pemesanan->status) == 'cancelled' ? 'selected' : '' }}>CANCELLED</option>
                        </select>
                        <p class="text-[10px] text-gray-400 mt-2 leading-relaxed">
                            *Mengubah status ke <b>ONGOING</b> otomatis mengubah status Unit menjadi <b>BOOKED</b>. <br>
                            *Mengubah ke <b>CONFIRMED/CANCELLED</b> mengembalikan Unit menjadi <b>AVAILABLE</b>.
                        </p>
                    </div>

                    <div class="mb-5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Keterangan / Pesan (Opsional)</label>
                        <textarea name="keterangan" rows="3" class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-3 outline-none transition shadow-sm text-sm placeholder-gray-400" placeholder="Tulis pesan atau alasan untuk dikirimkan ke email customer..."></textarea>
                    </div>

                    <button type="submit" class="w-full bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-md hover:bg-yellow-500 transition shadow-sm">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection