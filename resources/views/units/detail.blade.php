@extends('layouts.landing')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="mb-6">
        <a href="{{ route('units.katalog', [
            'tipe_id' => request('tipe_id')
        ]) }}"
        class="inline-flex items-center gap-2 text-sm font-semibold uppercase tracking-wider text-gray-500 hover:text-yellow-600 transition">

            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7"/>
            </svg>

            Kembali ke Katalog
        </a>
    </div>

    <div class="mb-8 border-b border-gray-200 pb-5">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wider">
            {{ $barang->nama_barang }}
        </h2>
        <p class="text-gray-500 text-sm uppercase tracking-widest mt-1">
            {{ $barang->tipe->nama_tipe }}
        </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

        @forelse($barang->units as $unit)
            <div class="border border-gray-200 bg-slate-50 p-5 rounded-lg shadow-sm hover:border-yellow-500 hover:shadow-md transition duration-300">

                <div class="text-gray-400 text-xs uppercase tracking-widest mb-1">
                    Kode Unit
                </div>

                <div class="text-gray-800 font-bold text-base">
                    {{ $unit->kode_unit }}
                </div>

                @if($unit->serial_machine)
                    <div class="mt-2 text-gray-400 text-xs uppercase tracking-widest mb-1">
                        Serial Machine
                    </div>
                    <div class="text-gray-800 font-semibold text-sm uppercase">
                        {{ $unit->serial_machine }}
                    </div>
                @endif

                @if($unit->serial_engine)
                    <div class="mt-2 text-gray-400 text-xs uppercase tracking-widest mb-1">
                        Serial Engine
                    </div>
                    <div class="text-gray-800 font-semibold text-sm uppercase">
                        {{ $unit->serial_engine }}
                    </div>
                @endif

                @if($unit->tahun_migrasi)
                    <div class="mt-2 text-gray-400 text-xs uppercase tracking-widest mb-1">
                        Tahun Migrasi
                    </div>
                    <div class="text-gray-800 font-semibold text-sm">
                        {{ $unit->tahun_migrasi }}
                    </div>
                @endif

                <div class="mt-4 text-xs font-bold uppercase tracking-wider
                    {{ $unit->status == 'available' ? 'text-green-600 bg-green-50 inline-block px-2 py-1 rounded' : 'text-red-600 bg-red-50 inline-block px-2 py-1 rounded' }}">
                    {{ $unit->status }}
                </div>

            </div>
        @empty
            <div class="col-span-4 text-center text-gray-500 text-sm py-10 uppercase tracking-widest">
                Tidak ada unit tersedia
            </div>
        @endforelse

    </div>

</div>
@endsection