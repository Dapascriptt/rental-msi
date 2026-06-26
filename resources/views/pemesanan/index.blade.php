@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">

    <!-- HEADER --->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 border-b border-gray-200 pb-5">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wider">Daftar Pemesanan</h2>
            <p class="text-gray-500 text-xs font-semibold mt-1 uppercase tracking-widest">Kelola transaksi sewa alat berat</p>
        </div>
    </div>

    <!-- FILTER BUTTONS -->
    <div class="flex gap-2 mb-6 flex-wrap">
        <a href="{{ route('pemesanan.index') }}"
           class="px-4 py-2 text-xs font-medium rounded-md border transition {{ !request('status') ? 'border-yellow-400 text-yellow-700 bg-yellow-50' : 'border-gray-200 text-gray-600 bg-slate-50 hover:bg-gray-50' }}">
            Semua
        </a>

        @foreach(['pending', 'ongoing', 'confirmed', 'cancelled'] as $statusLabel)
            <a href="{{ route('pemesanan.index', ['status' => $statusLabel]) }}"
               class="px-4 py-2 text-xs font-medium rounded-md border transition uppercase {{ request('status') === $statusLabel ? 'border-yellow-400 text-yellow-700 bg-yellow-50' : 'border-gray-200 text-gray-600 bg-slate-50 hover:bg-gray-50' }}">
                {{ $statusLabel }}
            </a>
        @endforeach
    </div>

    <!-- TABLE WRAPPER -->
    <div class="bg-slate-50 rounded-lg border border-gray-200 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-widest border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-5">Pemesan / Perusahaan</th>
                        <th class="px-6 py-5">Tanggal Sewa</th>
                        <th class="px-6 py-5">Kontak</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($pemesanans as $pesanan)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800 uppercase tracking-wide">
                                {{ $pesanan->nama_pemesan }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $pesanan->perusahaan ?? '-' }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-800 text-sm font-medium">
                            {{ $pesanan->tanggal_mulai ? $pesanan->tanggal_mulai->format('d M Y') : '-' }} 
                            <span class="text-gray-400 mx-1">s/d</span> 
                            {{ $pesanan->tanggal_selesai ? $pesanan->tanggal_selesai->format('d M Y') : '-' }}
                        </td>

                        <td class="px-6 py-4 text-gray-600 text-sm">
                            {{ $pesanan->no_hp }}
                        </td>

                        <td class="px-6 py-4">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
                                    'ongoing' => 'bg-blue-100 text-blue-700 border border-blue-200',
                                    'confirmed' => 'bg-green-100 text-green-700 border border-green-200',
                                    'cancelled' => 'bg-red-100 text-red-700 border border-red-200',
                                ];
                                $colorClass = $statusColors[strtolower($pesanan->status)] ?? 'bg-gray-100 text-gray-700 border border-gray-200';
                            @endphp
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $colorClass }}">
                                {{ $pesanan->status }}
                            </span>
                        </td>

                       <td class="px-6 py-4 flex items-center justify-end gap-2">
                            <!-- Tombol Edit / View Detail -->
                            <a href="{{ route('pemesanan.edit', $pesanan->id) }}"
                            class="w-9 h-9 bg-gray-100 hover:bg-yellow-100 rounded-md flex items-center justify-center text-gray-500 hover:text-yellow-600 transition shadow-sm"
                            title="Detail & Update Status">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </a>

                            @if($pesanan->status === 'pending')
                                <form action="{{ route('pemesanan.destroy', $pesanan->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin mau hapus pemesanan ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="w-9 h-9 bg-red-100 hover:bg-red-200 rounded-md flex items-center justify-center text-red-500 hover:text-red-700 transition shadow-sm"
                                        title="Hapus Pemesanan">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m3-3h4a1 1 0 011 1v2H9V5a1 1 0 011-1z" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm font-medium">
                            Belum ada data pemesanan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if (session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-md text-xs font-semibold">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md text-xs font-semibold">
                        {{ session('error') }}
                    </div>
                @endif
            </table>
        </div>
    </div>

</div>
@endsection