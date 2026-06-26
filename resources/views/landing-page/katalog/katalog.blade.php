@extends('layouts.landing')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">

    <div class="mb-10 text-center">
        <h1 class="text-3xl font-bold text-gray-800 uppercase tracking-wider">
            Katalog Unit
        </h1>
        <p class="text-gray-500 text-base mt-2">
            Pilih tipe untuk melihat barang
        </p>
    </div>

    <form method="GET" action="{{ route('units.katalog') }}" class="mb-8">

        <div class="flex gap-3">

            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari barang atau kode unit..."
                class="w-full bg-slate-50 border border-gray-300 text-gray-800 text-sm px-4 py-3 rounded-md shadow-sm focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">

            @if(request('tipe_id'))
                <input type="hidden" name="tipe_id" value="{{ request('tipe_id') }}">
            @endif

            <button type="submit"
                class="px-8 py-3 bg-yellow-400 text-black text-sm font-bold uppercase tracking-wider rounded-md hover:bg-yellow-500 transition shadow-sm">
                Cari
            </button>

        </div>

    </form>

    <div class="flex flex-wrap gap-3 mb-10 justify-center">

        <a href="{{ route('units.katalog') }}"
           class="px-5 py-2 text-sm rounded-md border transition
           {{ request('tipe_id') ? 'border-gray-300 text-gray-600 hover:bg-gray-50' : 'border-yellow-500 text-yellow-600 font-semibold bg-yellow-50/50' }}">
            Semua
        </a>

        @foreach($tipes as $tipe)
            <a href="{{ route('units.katalog', ['tipe_id' => $tipe->id]) }}"
               class="px-5 py-2 text-sm rounded-md border transition
               {{ request('tipe_id') == $tipe->id 
                    ? 'border-yellow-500 text-yellow-600 font-semibold bg-yellow-50/50' 
                    : 'border-gray-300 text-gray-600 hover:bg-gray-50 hover:border-gray-400' }}">
                {{ $tipe->nama_tipe }}
            </a>
        @endforeach

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($barangs as $barang)
            <a href="{{ route('katalog.detail', $barang->id) }}"
               class="group border border-gray-200 bg-slate-50 rounded-lg overflow-hidden hover:border-yellow-500 hover:shadow-md transition duration-300 flex flex-col">

                <div class="h-52 bg-gray-100 overflow-hidden relative">
                    @if($barang->image)
                        <img src="{{ asset('images/' . $barang->image) }}"
                            alt="{{ $barang->nama_barang }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">
                            NO IMAGE
                        </div>
                    @endif
                </div>

                <div class="p-4 flex flex-col flex-grow bg-gray-50/80 border-t border-gray-100">
                    <h3 class="text-gray-800 font-semibold text-base mb-1">
                        {{ $barang->nama_barang }}
                    </h3>

                    <span class="text-sm text-gray-500">
                        {{ $barang->tipe->nama_tipe }}
                    </span>
                </div>

            </a>
        @empty
            <div class="col-span-3 text-center text-gray-500 text-sm py-10">
                Tidak ada data ditemukan
            </div>
        @endforelse

    </div>

</div>
@endsection