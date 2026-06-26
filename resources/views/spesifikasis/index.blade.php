@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 border-b border-gray-200 pb-4">
        <h2 class="text-xl font-bold text-gray-800 uppercase tracking-widest">
            Data Spesifikasi
        </h2>

        <a href="{{ route('spesifikasis.create') }}"
           class="inline-flex justify-center items-center px-5 py-2.5 bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest rounded-md shadow-sm hover:bg-yellow-500 transition whitespace-nowrap self-start sm:self-auto">
            + Tambah
        </a>
    </div>

    <!-- FILTER BUTTONS -->
    <div class="flex gap-2 mb-6 flex-wrap">
        <a href="{{ route('spesifikasis.index') }}"
           class="px-4 py-2 text-xs font-medium rounded-md border transition {{ !request('barang_id') ? 'border-yellow-400 text-yellow-700 bg-yellow-50' : 'border-gray-200 text-gray-600 bg-slate-50 hover:bg-gray-50' }}">
            Semua
        </a>

        @if(isset($barangs))
            @foreach($barangs as $brg)
                <a href="{{ route('spesifikasis.index', ['barang_id' => $brg->id]) }}"
                   class="px-4 py-2 text-xs font-medium rounded-md border transition uppercase {{ request('barang_id') == $brg->id ? 'border-yellow-400 text-yellow-700 bg-yellow-50' : 'border-gray-200 text-gray-600 bg-slate-50 hover:bg-gray-50' }}">
                    {{ $brg->nama_barang }}
                </a>
            @endforeach
        @endif
    </div>
    
    <!-- TABLE WRAPPER -->
    <div class="bg-slate-50 border border-gray-200 rounded-lg shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border-collapse whitespace-nowrap">

                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 font-bold">Barang</th>
                        <th class="px-6 py-4 font-bold">Key</th>
                        <th class="px-6 py-4 font-bold">Value</th>
                        <th class="px-6 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($spesifikasis as $item)
                    <tr class="hover:bg-gray-50 transition duration-200">

                        <td class="px-6 py-4 text-gray-800 font-medium tracking-wide">
                            {{ $item->barang->nama_barang }}
                        </td>

                        <td class="px-6 py-4 text-yellow-600 font-bold uppercase tracking-wider">
                            {{ $item->key }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->value }}
                        </td>

                        <td class="px-6 py-4 flex items-center justify-end gap-2">

                            <a href="{{ route('spesifikasis.edit', $item->id) }}"
                               class="px-3 py-1.5 text-xs font-semibold bg-gray-100 text-gray-600 rounded hover:bg-yellow-100 hover:text-yellow-700 transition">
                                Edit
                            </a>

                            <form action="{{ route('spesifikasis.destroy', $item->id) }}" method="POST" class="m-0">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus spesifikasi ini?')"
                                    class="px-3 py-1.5 text-xs font-semibold bg-gray-100 text-gray-600 rounded hover:bg-red-100 hover:text-red-700 transition">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm font-medium">
                            Belum ada data spesifikasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-gray-500 text-sm text-center sm:text-left">
            Menampilkan {{ $spesifikasis->firstItem() ?? 0 }} - {{ $spesifikasis->lastItem() ?? 0 }} dari {{ $spesifikasis->total() }} data
        </p>
        <div class="w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
            {{ $spesifikasis->links('vendor.pagination.tailwind') }}
        </div>
    </div>

</div>
@endsection