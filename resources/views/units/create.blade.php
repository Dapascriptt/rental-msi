@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4">

    <div class="bg-slate-50 p-8 rounded-lg border border-gray-200 shadow-sm">
        
        <!-- Header Dinamis -->
        <div class="flex items-center justify-between mb-6 border-b border-gray-200 pb-4">
            <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider">
                {{ isset($unit) ? 'Edit Data Unit' : 'Tambah Unit Baru' }}
            </h2>
            <a href="{{ route('units.index') }}" 
               class="text-xs font-bold text-gray-500 uppercase tracking-widest hover:text-yellow-600 transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali
            </a>
        </div>

        <!-- Form Action Dinamis -->
        <form method="POST" action="{{ isset($unit) ? route('units.update', $unit->id) : route('units.store') }}">
            @csrf
            @if(isset($unit))
                @method('PUT')
            @endif

            <!-- Pilihan Barang -->
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Pilih Alat Berat</label>
                <select name="barang_id" required
                        class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-3 outline-none transition uppercase shadow-sm">
                    <option value="" disabled {{ !isset($unit) ? 'selected' : '' }}>-- Pilih Alat Berat --</option>
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}" 
                            {{ (isset($unit) && $unit->barang_id == $barang->id) || old('barang_id') == $barang->id ? 'selected' : '' }}>
                            {{ strtoupper($barang->nama_barang) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Toggle Mode Single/Bulk -->
            @if(!isset($unit))
            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Mode Penambahan</label>
                <div class="flex items-center space-x-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="mode" value="single"
                               {{ old('mode', 'single') === 'single' ? 'checked' : '' }}
                               class="w-4 h-4 text-yellow-500 bg-slate-50 border-gray-300 focus:ring-yellow-500">
                        <span class="text-sm font-medium text-gray-700">Single</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="mode" value="bulk"
                               {{ old('mode') === 'bulk' ? 'checked' : '' }}
                               class="w-4 h-4 text-yellow-500 bg-slate-50 border-gray-300 focus:ring-yellow-500">
                        <span class="text-sm font-medium text-gray-700">Bulk</span>
                    </label>
                </div>
            </div>
            @endif

            <!-- Form Mode Single  -->
            <div id="single-field" class="mb-5 {{ (!isset($unit) && old('mode') === 'bulk') ? 'hidden' : '' }}">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Kode Unit <span class="text-red-500">*</span></label>
                <input type="text" name="kode_unit" 
                       value="{{ old('kode_unit', $unit->kode_unit ?? '') }}" 
                       {{ !isset($unit) && old('mode') !== 'bulk' ? 'required' : '' }}
                       class="w-full bg-slate-50 text-yellow-600 font-bold border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-4 outline-none transition uppercase tracking-wider shadow-sm placeholder-gray-400"
                       placeholder="Contoh: EXC-001">
            </div>

            <!-- Field Serials  -->
            <div id="serial-fields" class="mb-5 {{ (!isset($unit) && old('mode') === 'bulk') ? 'hidden' : '' }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Serial Machine</label>
                        <input type="text" name="serial_machine" 
                               value="{{ old('serial_machine', $unit->serial_machine ?? '') }}"
                               class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-4 outline-none transition shadow-sm uppercase placeholder-gray-400"
                               placeholder="Opsional">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Serial Engine</label>
                        <input type="text" name="serial_engine" 
                               value="{{ old('serial_engine', $unit->serial_engine ?? '') }}"
                               class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-4 outline-none transition shadow-sm uppercase placeholder-gray-400"
                               placeholder="Opsional">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Tahun Migrasi</label>
                        <input type="number" name="tahun_migrasi" 
                               value="{{ old('tahun_migrasi', $unit->tahun_migrasi ?? '') }}" min="1900" max="{{ date('Y') }}"
                               class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-4 outline-none transition shadow-sm placeholder-gray-400"
                               placeholder="Contoh: 2023">
                    </div>
                </div>
            </div>

            <!-- Form Mode Bulk -->
            @if(!isset($unit))
            <div id="bulk-field" class="mb-5 {{ old('mode', 'single') === 'single' ? 'hidden' : '' }}">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Quantity <span class="text-red-500">*</span></label>
                <input type="number" name="qty" value="{{ old('qty') }}" min="1"
                       class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-3 outline-none transition shadow-sm placeholder-gray-400"
                       placeholder="Jumlah unit yang akan dibuat">
                <p class="text-[10px] text-gray-400 mt-1 italic">*Kode Unit akan di-generate secara otomatis sesuai ID sistem.</p>
            </div>
            @endif

            <!-- Pilihan Status -->
            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Status Unit <span class="text-red-500">*</span></label>
                
                @if(isset($unit) && strtolower($unit->status) === 'booked')
                    <!-- Jika mode edit dan status sedang booked -->
                    <div class="w-full bg-gray-100 text-gray-500 border border-gray-300 rounded-md py-2.5 px-4 cursor-not-allowed font-bold">
                        BOOKED (Terkunci)
                    </div>
                    <input type="hidden" name="status" value="booked">
                    <p class="text-[10px] text-gray-400 mt-1 italic">Status tidak bisa diubah manual karena sedang disewa.</p>
                @else
                    <!-- Dropdown  -->
                    <select name="status" required
                            class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-3 outline-none transition shadow-sm font-semibold">
                        <option value="available" {{ old('status', $unit->status ?? '') == 'available' ? 'selected' : '' }}>AVAILABLE</option>
                        <option value="maintenance" {{ old('status', $unit->status ?? '') == 'maintenance' ? 'selected' : '' }}>MAINTENANCE</option>
                    </select>
                @endif
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center justify-end gap-4 border-t border-gray-100 pt-5">
                <a href="{{ route('units.index') }}" 
                   class="text-xs font-bold text-gray-500 uppercase tracking-widest hover:text-gray-800 transition">
                    Batal
                </a>
                <button type="submit" class="bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-md hover:bg-yellow-500 transition shadow-sm">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modeRadios = document.getElementsByName('mode');
        
        if (modeRadios.length > 0) {
            const singleField = document.getElementById('single-field');
            const bulkField = document.getElementById('bulk-field');
            const serialFields = document.getElementById('serial-fields');
            const kodeUnitInput = document.querySelector('input[name="kode_unit"]');

            function toggleFields() {
                const isSingle = document.querySelector('input[name="mode"][value="single"]:checked');
                if (isSingle) {
                    singleField.classList.remove('hidden');
                    bulkField.classList.add('hidden');
                    serialFields.classList.remove('hidden');
                    kodeUnitInput.setAttribute('required', 'required');
                } else {
                    singleField.classList.add('hidden');
                    bulkField.classList.remove('hidden');
                    serialFields.classList.add('hidden');
                    kodeUnitInput.removeAttribute('required'); 
                }
            }

            modeRadios.forEach(radio => {
                radio.addEventListener('change', toggleFields);
            });

            // Initialize state
            toggleFields();
        }
    });
</script>
@endpush