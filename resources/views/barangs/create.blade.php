@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4">

    <div class="bg-slate-50 p-8 rounded-lg border border-gray-200 shadow-sm">
        <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider mb-6 border-b border-gray-200 pb-4">
            {{ isset($barang) ? 'Edit Barang' : 'Tambah Barang' }}
        </h2>

        <form method="POST" 
            enctype="multipart/form-data"
            action="{{ isset($barang) ? route('barangs.update', $barang->id) : route('barangs.store') }}">
            @csrf
            @if(isset($barang))
                @method('PUT')
            @endif

            <div class="mb-5">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Nama Barang</label>
                <input type="text" 
                       name="nama_barang" 
                       value="{{ $barang->nama_barang ?? '' }}"
                       placeholder="Contoh: BULLDOZER D9"
                       class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-4 outline-none transition uppercase tracking-wider shadow-sm placeholder-gray-400">
            </div>

            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Tipe Kategori</label>
                <select name="tipe_id" 
                        class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-3 outline-none transition uppercase shadow-sm">
                    @foreach($tipes as $tipe)
                        <option value="{{ $tipe->id }}"
                            {{ (isset($barang) && $barang->tipe_id == $tipe->id) ? 'selected' : '' }}>
                            {{ $tipe->nama_tipe }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Gambar Barang
                </label>

                <input type="file" 
                    name="image"
                    accept="image/jpeg,image/png,image/jpg"
                    class="w-full text-gray-600 text-xs border border-gray-300 rounded-md file:mr-4 file:py-2 file:px-4 file:rounded-l-md file:border-0 file:text-xs file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 transition shadow-sm">

                <p class="text-xs text-gray-500 mt-2">
                    Maksimal 3MB (JPG, JPEG, PNG)
                </p>

                @if(isset($barang) && $barang->image)
                    <div class="mt-4">
                        <img 
                            src="{{ asset('images/' . $barang->image) }}"
                            onclick="openModal(this.src)"
                            class="w-32 h-32 object-cover border border-gray-300 rounded-md cursor-pointer hover:scale-105 transition shadow-sm"
                        >
                    </div>
                @endif
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('barangs.index') }}" 
                   class="text-xs font-bold text-gray-500 uppercase tracking-widest hover:text-gray-800 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-md hover:bg-yellow-500 transition shadow-sm">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>

</div>
@endsection