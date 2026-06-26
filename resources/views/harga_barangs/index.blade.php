@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">

    <div class="flex items-center justify-between mb-8 border-b border-gray-200 pb-5">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wider">Harga Alat Berat</h2>
            <p class="text-gray-500 text-xs font-semibold mt-1 uppercase tracking-widest">Kelola daftar harga sewa alat berat</p>
        </div>
        <a href="{{ route('harga-barangs.create') }}"
           class="bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-md hover:bg-yellow-500 transition shadow-sm">
            + Tambah Data
        </a>
    </div>

    <div class="bg-slate-50 rounded-lg border border-gray-200 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-widest">
                    <tr>
                        <th class="px-6 py-5 text-left">Barang</th>
                        <th class="px-6 py-5 text-left">Harga</th>
                        <th class="px-6 py-5 text-left">Satuan</th>
                        <th class="px-6 py-5 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @foreach($hargaBarangs as $harga)
                    <tr class="hover:bg-gray-50 transition duration-200">

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-yellow-100 rounded-md flex items-center justify-center text-yellow-600 border border-yellow-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </div>
                                <div class="font-bold text-gray-800 uppercase tracking-wide">
                                    {{ $harga->barang->nama_barang }}
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-800 font-semibold tracking-wide">
                            Rp {{ number_format($harga->harga, 0, ',', '.') }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500 shadow-sm"></div>
                                <span class="text-xs font-bold text-green-600 uppercase tracking-widest">
                                    {{ ucfirst($harga->satuan) }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4 flex items-center justify-end gap-2">
                            <a href="{{ route('harga-barangs.edit', $harga->id) }}"
                               class="w-9 h-9 bg-gray-100 hover:bg-yellow-100 rounded-md flex items-center justify-center text-gray-500 hover:text-yellow-600 transition"
                               title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>

                            <form action="{{ route('harga-barangs.destroy', $harga->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="w-9 h-9 bg-gray-100 hover:bg-red-100 rounded-md flex items-center justify-center text-gray-500 hover:text-red-600 transition"
                                        title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection