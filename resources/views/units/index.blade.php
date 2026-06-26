@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8 border-b border-gray-200 pb-5">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wider">Unit Alat Berat</h2>
            <p class="text-gray-500 text-xs font-semibold mt-1 uppercase tracking-widest">Kelola data inventaris unit mesin</p>
        </div>
        <div class="flex items-center gap-2 sm:gap-3 flex-wrap">
            <a href="{{ route('units.create') }}"
               class="bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest px-4 sm:px-6 py-3 rounded-md hover:bg-yellow-500 transition shadow-sm whitespace-nowrap">
                + Tambah Data
            </a>
            <button id="bulkDeleteBtn"
                    class="bg-red-50 text-red-600 border border-red-200 text-xs font-bold uppercase tracking-widest px-4 sm:px-6 py-3 rounded-md hover:bg-red-500 hover:text-white transition shadow-sm disabled:opacity-50 disabled:cursor-not-allowed whitespace-nowrap"
                    disabled>
                Hapus Terpilih
            </button>
        </div>
    </div>

    <!-- FILTER BUTTONS -->
    <div class="flex gap-2 mb-6 flex-wrap">
        <a href="{{ route('units.index') }}"
           class="px-4 py-2 text-xs font-medium rounded-md border transition {{ request('barang_id') ? 'border-gray-200 text-gray-600 bg-slate-50 hover:bg-gray-50' : 'border-yellow-400 text-yellow-700 bg-yellow-50' }}">
            Semua ({{ $units->total() }})
        </a>

        @foreach($summary as $item)
            <a href="{{ route('units.index', ['barang_id' => $item->id]) }}"
               class="px-4 py-2 text-xs font-medium rounded-md border transition {{ request('barang_id') == $item->id ? 'border-yellow-400 text-yellow-700 bg-yellow-50' : 'border-gray-200 text-gray-600 bg-slate-50 hover:bg-gray-50' }}">
                
                {{ $item->nama_barang }} ({{ $item->total_unit }})

                <span class="text-green-600 font-bold ml-1">
                    {{ $item->available_unit }} available
                </span>
            </a>
        @endforeach
    </div>

    <form id="bulkDeleteForm" action="{{ route('units.bulk-delete') }}" method="POST" class="hidden">
        @csrf
    </form>

    <!-- TABLE WRAPPER -->
    <div class="bg-slate-50 rounded-lg border border-gray-200 shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full text-left border-collapse whitespace-nowrap">
                <thead class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-widest border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-5 text-center w-16">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" id="selectAll" class="w-4 h-4 text-yellow-500 bg-slate-50 border-gray-300 rounded focus:ring-yellow-500">
                            </div>
                        </th>
                        <th class="px-6 py-5">Kode Unit</th>
                        <th class="px-6 py-5">Barang</th>
                        <th class="px-6 py-5">Serial Machine</th>
                        <th class="px-6 py-5">Serial Engine</th>
                        <th class="px-6 py-5">Tahun</th>
                        <th class="px-6 py-5">Status</th>
                        <th class="px-6 py-5 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($units as $unit)
                    <tr class="hover:bg-gray-50 transition duration-200">

                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center">
                                <input type="checkbox" class="unit-checkbox w-4 h-4 text-yellow-500 bg-slate-50 border-gray-300 rounded focus:ring-yellow-500 disabled:opacity-50"
                                    value="{{ $unit->id }}"
                                    @if(strtolower($unit->status) === 'booked') disabled title="Unit sedang disewa" @endif>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="font-black text-gray-800 uppercase tracking-wider text-base">
                                {{ $unit->kode_unit }}
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-md overflow-hidden border border-gray-200 shrink-0">
                                    @if($unit->barang->image)
                                        <img src="{{ asset('images/' . $unit->barang->image) }}"
                                             alt="{{ $unit->barang->nama_barang }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs font-medium">
                                            N/A
                                        </div>
                                    @endif
                                </div>
                                <span class="font-bold text-gray-800 uppercase tracking-wide">
                                    {{ $unit->barang->nama_barang }}
                                </span>
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm">
                                @if($unit->serial_machine)
                                    <div class="text-gray-800 font-medium uppercase">{{ $unit->serial_machine }}</div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm">
                                @if($unit->serial_engine)
                                    <div class="text-gray-800 font-medium uppercase">{{ $unit->serial_engine }}</div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="text-sm">
                                @if($unit->tahun_migrasi)
                                    <div class="text-gray-800 font-bold">{{ $unit->tahun_migrasi }}</div>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                @if(strtolower($unit->status) == 'available')
                                    <div class="w-2 h-2 rounded-full bg-green-500 shadow-sm"></div>
                                    <span class="text-xs font-bold text-green-600 uppercase tracking-widest bg-green-50 px-2 py-1 rounded">Available</span>
                                @elseif(strtolower($unit->status) == 'booked')
                                    <div class="w-2 h-2 rounded-full bg-blue-500 shadow-sm"></div>
                                    <span class="text-xs font-bold text-blue-600 uppercase tracking-widest bg-blue-50 px-2 py-1 rounded">Booked</span>
                                @else
                                    <div class="w-2 h-2 rounded-full bg-red-500 shadow-sm"></div>
                                    <span class="text-xs font-bold text-red-600 uppercase tracking-widest bg-red-50 px-2 py-1 rounded">Maintenance</span>
                                @endif
                            </div>
                        </td>

                        <td class="px-6 py-4 flex items-center justify-end gap-2">
                            @if(strtolower($unit->status) !== 'booked')
                                <!-- Tombol Edit -->
                                <a href="{{ route('units.edit', $unit->id) }}"
                                   class="w-9 h-9 bg-gray-100 hover:bg-yellow-100 rounded-md flex items-center justify-center text-gray-500 hover:text-yellow-600 transition"
                                   title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ route('units.destroy', $unit->id) }}" method="POST" class="m-0">
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
                            @else
                                <!-- Tampilan Terkunci Jika Booked -->
                                <div class="flex items-center justify-center bg-gray-100 text-gray-400 px-3 py-2 rounded-md text-[10px] font-bold uppercase tracking-widest cursor-not-allowed border border-gray-200" 
                                    title="Unit sedang disewa. Selesaikan pesanan di menu Pemesanan untuk membuka kunci.">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    Terkunci
                                </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-gray-500 text-sm font-medium">
                            Belum ada data unit.
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
            Menampilkan {{ $units->firstItem() ?? 0 }} - {{ $units->lastItem() ?? 0 }} dari {{ $units->total() }} data
        </p>
        <div class="w-full sm:w-auto overflow-x-auto pb-2 sm:pb-0">
            {{ $units->links('vendor.pagination.tailwind') }}
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const selectAllCheckbox = document.getElementById('selectAll');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const bulkDeleteForm = document.getElementById('bulkDeleteForm');

    function getCheckboxes() {
        return document.querySelectorAll('.unit-checkbox');
    }

    function updateBulkDeleteButton() {
        const checkboxes = Array.from(getCheckboxes());
        const checked = checkboxes.filter(cb => cb.checked && !cb.disabled);

        bulkDeleteBtn.disabled = checked.length === 0;
    }

    // SELECT ALL
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function (e) {
            getCheckboxes().forEach(cb => {
                if (!cb.disabled) {
                    cb.checked = e.target.checked;
                }
            });

            updateBulkDeleteButton();
        });
    }

    // INDIVIDUAL CHECKBOX
    getCheckboxes().forEach(cb => {
        cb.addEventListener('change', function () {

            const checkboxes = Array.from(getCheckboxes()).filter(c => !c.disabled);
            const checked = checkboxes.filter(c => c.checked);

            if(selectAllCheckbox) {
                selectAllCheckbox.checked = checked.length === checkboxes.length && checkboxes.length > 0;
                selectAllCheckbox.indeterminate = checked.length > 0 && checked.length < checkboxes.length;
            }

            updateBulkDeleteButton();
        });
    });

    // BULK DELETE
    if (bulkDeleteBtn) {
        bulkDeleteBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const ids = Array.from(getCheckboxes())
                .filter(cb => cb.checked && !cb.disabled)
                .map(cb => cb.value);

            if (ids.length === 0) return;

            if (!confirm(`Yakin ingin menghapus ${ids.length} unit?`)) return;

            
            bulkDeleteForm.innerHTML = `
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            `;

            
            ids.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids[]';
                input.value = id;
                bulkDeleteForm.appendChild(input);
            });

            bulkDeleteForm.submit();
        });
    }

});
</script>
@endpush