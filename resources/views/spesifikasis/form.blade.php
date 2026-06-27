@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4">

    <div class="bg-slate-50 p-8 rounded-lg border border-gray-200 shadow-sm">

        <h2 class="text-xl font-bold text-gray-800 uppercase tracking-wider mb-6 border-b border-gray-200 pb-4">
            {{ isset($allSpecs) ? 'Edit Spesifikasi' : 'Tambah Spesifikasi' }}
        </h2>

        <form method="POST"
              action="{{ isset($allSpecs) ? route('spesifikasis.update', $spesifikasi->id) : route('spesifikasis.store') }}">

            @csrf
            @if(isset($allSpecs))
                @method('PUT')
            @endif

            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Barang
                </label>

                {{-- MODE EDIT --}}
                @if(isset($allSpecs))
                    <input type="hidden" name="barang_id" value="{{ $spesifikasi->barang_id }}">

                    <div class="bg-gray-50 text-gray-800 font-semibold border border-gray-200 px-4 py-3 rounded-md uppercase shadow-sm">
                        {{ $spesifikasi->barang->nama_barang }}
                    </div>
                @else
                    {{-- MODE CREATE --}}
                    <select name="barang_id"
                        class="w-full bg-slate-50 text-gray-800 border border-gray-300 rounded-md
                        focus:ring-1 focus:ring-yellow-500 focus:border-yellow-500
                        py-2.5 px-3 outline-none transition uppercase shadow-sm">

                        @foreach($barangs as $barang)
                            <option value="{{ $barang->id }}">
                                {{ $barang->nama_barang }}
                            </option>
                        @endforeach
                    </select>
                @endif
            </div>

            <div class="mb-8">

                <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">
                    Spesifikasi
                </label>

                <div id="spec-wrapper" class="space-y-3">

                    {{-- MODE EDIT --}}
                    @if(isset($allSpecs))
                        @foreach($allSpecs as $spec)
                            <div class="flex gap-3 spec-item items-center">
                                <input type="text" name="keys[]"
                                    value="{{ $spec->key }}"
                                    class="w-1/2 bg-slate-50 text-yellow-600 font-bold border border-gray-300 px-3 py-2 rounded-md uppercase focus:ring-1 focus:ring-yellow-500 outline-none shadow-sm placeholder-gray-400">

                                <input type="text" name="values[]"
                                    value="{{ $spec->value }}"
                                    class="w-1/2 bg-slate-50 text-gray-800 border border-gray-300 px-3 py-2 rounded-md focus:ring-1 focus:ring-yellow-500 outline-none shadow-sm placeholder-gray-400">

                                <button type="button" onclick="removeSpec(this)"
                                    class="text-red-500 hover:text-red-700 font-bold text-lg px-2 transition">✕</button>
                            </div>
                        @endforeach
                    @else
                        {{-- MODE CREATE --}}
                        <div class="flex gap-3 spec-item items-center">
                            <input type="text" name="keys[]"
                                placeholder="Key (contoh: PANJANG)"
                                class="w-1/2 bg-slate-50 text-yellow-600 font-bold border border-gray-300 px-3 py-2 rounded-md uppercase focus:ring-1 focus:ring-yellow-500 outline-none shadow-sm placeholder-gray-400">

                            <input type="text" name="values[]"
                                placeholder="Value (contoh: 120 CM)"
                                class="w-1/2 bg-slate-50 text-gray-800 border border-gray-300 px-3 py-2 rounded-md focus:ring-1 focus:ring-yellow-500 outline-none shadow-sm placeholder-gray-400">

                            <button type="button" onclick="removeSpec(this)"
                                class="text-red-500 hover:text-red-700 font-bold text-lg px-2 transition">✕</button>
                        </div>
                    @endif

                </div>

                <button type="button" onclick="addSpec()"
                    class="mt-4 text-xs text-yellow-600 hover:text-yellow-700 font-bold uppercase tracking-widest transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Spesifikasi
                </button>

            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('spesifikasis.index') }}"
                   class="text-xs font-bold text-gray-500 uppercase tracking-widest hover:text-gray-800 transition">
                    Batal
                </a>

                <button type="submit"
                    class="bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest px-6 py-3 rounded-md hover:bg-yellow-500 transition shadow-sm">
                    {{ isset($allSpecs) ? 'Update Data' : 'Simpan Data' }}
                </button>
            </div>

        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
function addSpec() {
    const wrapper = document.getElementById('spec-wrapper');

    // Pastikan string HTML di bawah ini pakai class light mode
    const html = `
        <div class="flex gap-3 spec-item items-center">
            <input type="text" name="keys[]"
                placeholder="Key"
                class="w-1/2 bg-slate-50 text-yellow-600 font-bold border border-gray-300 px-3 py-2 rounded-md uppercase focus:ring-1 focus:ring-yellow-500 outline-none shadow-sm placeholder-gray-400">

            <input type="text" name="values[]"
                placeholder="Value"
                class="w-1/2 bg-slate-50 text-gray-800 border border-gray-300 px-3 py-2 rounded-md focus:ring-1 focus:ring-yellow-500 outline-none shadow-sm placeholder-gray-400">

            <button type="button" onclick="removeSpec(this)"
                class="text-red-500 hover:text-red-700 font-bold text-lg px-2 transition">✕</button>
        </div>
    `;

    wrapper.insertAdjacentHTML('beforeend', html);
}

function removeSpec(el) {
    el.closest('.spec-item').remove();
}

// AUTO UPPERCASE KEY
document.addEventListener('input', function(e){
    if(e.target.name === 'keys[]'){
        e.target.value = e.target.value.toUpperCase();
    }
});
</script>
@endpush
