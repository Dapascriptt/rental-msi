@props(['barangLainnya', 'cartCount' => 0])

<div class="bg-gray-300 p-6 rounded-lg sticky top-8">
    <h3 class="text-xl font-bold text-black mb-4">Sewa Sekarang</h3>
    
    <button type="submit" id="btn-keranjang" disabled
        class="block w-full bg-[#fca311] hover:bg-yellow-500 text-black font-bold text-center py-3 rounded mb-3 transition disabled:opacity-50 disabled:cursor-not-allowed">
        Tambah ke Keranjang
    </button>
    
    <button type="button" onclick="document.getElementById('cart-modal').classList.remove('hidden')" 
        class="block w-full bg-slate-50 hover:bg-gray-50 border border-gray-300 text-black font-bold text-center py-3 rounded mb-3 transition shadow-sm">
        Lihat Keranjang ({{ $cartCount }})
    </button>
    
    <a href="https://wa.me/6281234567890" target="_blank" class="block w-full bg-[#7ec8ff] hover:bg-blue-400 text-white font-bold text-center py-3 rounded mb-8 transition">
        Whatsapp Kami
    </a>

    <h4 class="text-md font-bold text-black mb-4">Alat Berat Sejenis</h4>
    <div class="flex flex-col gap-3">
        @forelse($barangLainnya as $b)
            <a href="{{ url('/katalog/' . $b->id) }}" 
               class="flex items-center justify-center w-full bg-slate-50 hover:bg-gray-50 text-gray-800 hover:text-yellow-600 font-semibold text-center px-4 py-3 rounded transition shadow-sm border border-transparent hover:border-yellow-400">
                {{ $b->nama_barang }}
            </a>
        @empty
            <div class="text-center text-sm text-gray-500 italic py-2">Belum ada alat berat sejenis</div>
        @endforelse
    </div>
</div>