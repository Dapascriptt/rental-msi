@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4">

    <div class="bg-slate-50 p-8 rounded-lg border border-gray-200 shadow-sm">
        <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider mb-6 border-b border-gray-200 pb-4">
            {{ isset($hargaBarang) ? 'Edit Harga' : 'Tambah Harga' }}
        </h2>

        <form method="POST"
              action="{{ isset($hargaBarang) ? route('harga-barangs.update', $hargaBarang->id) : route('harga-barangs.store') }}">
            @csrf
            @if(isset($hargaBarang))
                @method('PUT')
            @endif

            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Barang</label>
                <select name="barang_id"
                        class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-3 outline-none transition shadow-sm">
                    @foreach($barangs as $barang)
                        <option value="{{ $barang->id }}"
                            {{ (isset($hargaBarang) && $hargaBarang->barang_id == $barang->id) ? 'selected' : '' }}>
                            {{ strtoupper($barang->nama_barang) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Harga</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-500 text-sm font-medium">Rp</span>
                    <input type="number" name="harga"
                           value="{{ $hargaBarang->harga ?? '' }}"
                           class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 pl-12 pr-4 outline-none transition shadow-sm placeholder-gray-400"
                           placeholder="0">
                </div>
            </div>

            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Satuan</label>
                <select name="satuan"
                        class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-3 outline-none transition shadow-sm">
                    @foreach(['jam','hari','minggu','bulan'] as $s)
                        <option value="{{ $s }}"
                            {{ (isset($hargaBarang) && $hargaBarang->satuan == $s) ? 'selected' : '' }}>
                            {{ strtoupper($s) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('harga-barangs.index') }}" 
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