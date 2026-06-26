@props(['cartItems'])

<div id="cart-modal" class="fixed inset-0 z-[100] hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            
            <div class="relative transform flex flex-col bg-slate-50 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] text-left transition-all">
                
                <div class="px-4 sm:px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50 rounded-t-lg shrink-0">
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 uppercase tracking-wider">Keranjang Sewa</h3>
                    <button type="button" onclick="document.getElementById('cart-modal').classList.add('hidden')" class="text-gray-400 hover:text-red-500 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <div class="px-4 sm:px-6 py-4 overflow-y-auto flex-grow bg-slate-50">
                    @if(isset($cartItems) && count($cartItems) > 0)
                        <div class="flex flex-col gap-4">
                            @foreach($cartItems as $item)
                                @php
                                    $qty = count($item->selected_units);
                                @endphp
                                <div class="border border-gray-200 rounded p-4 flex flex-col sm:flex-row justify-between sm:items-start gap-4">
                                    <div class="flex-1 w-full">
                                        <div class="flex justify-between items-start mb-2">
                                            <div>
                                                <h4 class="font-bold text-lg text-gray-800">{{ $item->nama_barang }}</h4>
                                                <div class="text-sm text-gray-500">Total Unit Dipilih: <span class="font-bold text-black">{{ $qty }} Unit</span></div>
                                            </div>
                                            <!-- Tombol Hapus Pindah ke atas untuk UI yang lebih rapi -->
                                            <a href="{{ route('cart.remove', $item->id) }}" class="inline-flex p-2 text-red-500 bg-red-50 hover:bg-red-100 hover:text-red-700 rounded-md transition shadow-sm shrink-0" title="Hapus Item">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </a>
                                        </div>
                                        
                                        <!-- Section Baru: Estimasi Harga Akumulasi -->
                                        @if(isset($item->hargaBarangs) && count($item->hargaBarangs) > 0)
                                            <div class="my-3 bg-blue-50/50 p-3 rounded border border-blue-100">
                                                <p class="text-xs text-blue-800 uppercase tracking-wider mb-2 font-bold">Estimasi Subtotal (x{{ $qty }} Unit):</p>
                                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2">
                                                    @foreach($item->hargaBarangs as $harga)
                                                        @php
                                                            $hargaPerUnit = is_numeric($harga->harga) ? $harga->harga : 0;
                                                            $subtotal = $hargaPerUnit * $qty;
                                                        @endphp
                                                        <div class="flex justify-between items-center text-sm border-b border-blue-100/50 pb-1 last:border-0 last:pb-0">
                                                            <span class="text-gray-600">{{ $harga->satuan }}</span>
                                                            <span class="font-bold text-gray-800">
                                                                @if($hargaPerUnit > 0)
                                                                    Rp. {{ number_format($subtotal, 0, ',', '.') }}
                                                                @else
                                                                    {{ $harga->harga }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <div class="flex flex-wrap gap-2 mt-3 pt-3 border-t border-gray-100">
                                            @foreach($item->selected_units as $u)
                                                <div class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-semibold rounded border border-yellow-300 overflow-hidden">
                                                    <span class="px-2.5 py-1">Kode: {{ $u->kode_unit }}</span>
                                                    <a href="{{ route('cart.removeUnit', ['barangId' => $item->id, 'unitId' => $u->id]) }}" 
                                                       class="px-2 py-1 bg-yellow-200 hover:bg-red-500 hover:text-white transition flex items-center justify-center border-l border-yellow-300" 
                                                       title="Hapus Unit Ini">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8 text-gray-500 italic">
                            Keranjang Anda masih kosong.
                        </div>
                    @endif
                </div>

                <div class="px-4 sm:px-6 py-4 border-t border-gray-200 bg-gray-50 flex flex-col-reverse sm:flex-row items-center justify-between gap-3 rounded-b-lg shrink-0">
                    <div class="w-full sm:w-auto text-center sm:text-left mt-2 sm:mt-0">
                        @if(isset($cartItems) && count($cartItems) > 0)
                            <a href="{{ route('cart.clear') }}" class="text-sm text-red-500 hover:text-red-700 font-semibold underline transition">
                                Kosongkan Semua
                            </a>
                        @endif
                    </div>

                    <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-2">
                        <button type="button" onclick="document.getElementById('cart-modal').classList.add('hidden')" class="w-full sm:w-auto px-4 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded transition">
                            Tutup
                        </button>
                        @if(isset($cartItems) && count($cartItems) > 0)
                            <a href="{{ route('checkout.index') }}" class="w-full sm:w-auto px-6 py-2 bg-[#fca311] hover:bg-yellow-500 text-black font-bold rounded shadow-sm transition text-center whitespace-nowrap">
                                Lanjut Pemesanan
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>