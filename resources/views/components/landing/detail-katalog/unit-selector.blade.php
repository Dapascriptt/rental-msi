@props(['units', 'inCartUnitIds' => []])

<div class="mb-10">
    <details class="group border border-gray-300 rounded-lg bg-slate-50 shadow-sm [&_summary::-webkit-details-marker]:hidden" open>
        <summary class="flex cursor-pointer items-center justify-between gap-1.5 p-4 text-white bg-gray-800 hover:bg-gray-700 rounded-lg transition">
            <span class="font-bold tracking-wider uppercase text-sm">Lihat Detail Ketersediaan Unit</span>
            <span class="transition duration-300 group-open:-rotate-180">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
            </span>
        </summary>

        <div class="p-6 border-t border-gray-200 bg-gray-50 rounded-b-lg">
            <p class="text-sm text-gray-500 mb-4">* Centang unit yang ingin disewa lalu klik Tambah ke Keranjang</p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @forelse($units as $unit)
                    @php
                        // Cek apakah unit ini sudah ada di dalam keranjang
                        $isInCart = in_array($unit->id, $inCartUnitIds);
                        // Unit bisa dipilih jika statusnya available dan belum ada di keranjang
                        $isAvailable = $unit->status == 'available' && !$isInCart;
                    @endphp
                    
                    <label class="relative border border-gray-200 bg-slate-50 p-4 rounded shadow-sm transition {{ $isAvailable ? 'cursor-pointer hover:border-yellow-500 hover:shadow-md' : 'opacity-60 cursor-not-allowed' }}">
                        
                        @if($isAvailable)
                            <input type="checkbox" name="units[]" value="{{ $unit->id }}" class="unit-checkbox absolute top-4 right-4 w-5 h-5 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500">
                        @elseif($isInCart)
                            <!-- Tanda Checklist jika sudah masuk keranjang -->
                            <div class="absolute top-4 right-4 flex items-center justify-center" title="Sudah di keranjang">
                                <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        @endif

                        <div class="text-gray-400 text-xs uppercase tracking-widest mb-1">Kode Unit</div>
                        <div class="text-gray-800 font-bold text-base mb-2">{{ $unit->kode_unit }}</div>

                        @if($unit->serial_machine)
                            <div class="text-gray-500 text-xs uppercase">Serial Machine: <span class="font-semibold text-gray-800">{{ $unit->serial_machine }}</span></div>
                        @endif

                        @if($unit->serial_engine)
                            <div class="text-gray-500 text-xs uppercase mt-1">Serial Engine: <span class="font-semibold text-gray-800">{{ $unit->serial_engine }}</span></div>
                        @endif

                        <div class="mt-3 text-xs font-bold uppercase tracking-wider 
                            {{ $isInCart ? 'text-blue-600 bg-blue-50 inline-block px-2 py-1 rounded' : 
                               ($unit->status == 'available' ? 'text-green-600 bg-green-50 inline-block px-2 py-1 rounded' : 'text-red-600 bg-red-50 inline-block px-2 py-1 rounded') }}">
                            {{ $isInCart ? 'Di Keranjang' : $unit->status }}
                        </div>
                    </label>
                @empty
                    <div class="col-span-2 text-center text-gray-500 text-sm py-6 border border-dashed border-gray-300 rounded">Tidak ada unit tersedia</div>
                @endforelse
            </div>
        </div>
    </details>
</div>