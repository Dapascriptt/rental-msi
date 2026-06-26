@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4">

    <div class="bg-slate-50 p-8 rounded-lg border border-gray-200 shadow-sm">
        <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider mb-6 border-b border-gray-200 pb-4">
            {{ isset($tipe) ? 'Edit Tipe' : 'Tambah Tipe' }}
        </h2>

        <form method="POST" 
              action="{{ isset($tipe) ? route('tipes.update', $tipe->id) : route('tipes.store') }}">
            @csrf
            @if(isset($tipe))
                @method('PUT')
            @endif

            <div class="mb-8">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">Nama Tipe</label>
                <input type="text" 
                       name="nama_tipe" 
                       placeholder="Contoh: EXCAVATOR"
                       value="{{ $tipe->nama_tipe ?? '' }}"
                       class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500 py-2.5 px-4 outline-none transition uppercase shadow-sm placeholder-gray-400">
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('tipes.index') }}" 
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