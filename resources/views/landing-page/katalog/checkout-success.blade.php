@extends('layouts.landing')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16 md:py-24">

    <div class="bg-slate-50 border border-slate-200 rounded-2xl shadow-xl shadow-slate-200/40 relative overflow-hidden p-8 md:p-12 text-center">

        <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#fca311] to-orange-500"></div>

        <div class="mx-auto mb-8 w-24 h-24 bg-orange-100 text-[#fca311] rounded-full flex items-center justify-center shadow-lg shadow-orange-500/20">
            <svg class="w-14 h-14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 uppercase tracking-wider mb-5">
            Terima Kasih
        </h1>

        <p class="text-slate-600 text-lg md:text-xl leading-relaxed max-w-2xl mx-auto mb-8">
            Terima kasih karena sudah melakukan pemesanan. Untuk proses ataupun kelanjutan pemesanan,
            bisa menunggu informasi melalui email ataupun WhatsApp sesuai form yang telah diisi.
        </p>

        <div class="bg-white border border-slate-200 rounded-xl p-5 mb-10 text-left max-w-2xl mx-auto">
            <div class="flex items-start gap-4">
                <div class="bg-orange-100 text-[#fca311] p-2 rounded-lg shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M13 16h-1v-4h-1m1-4h.01M12 20.5a8.5 8.5 0 100-17 8.5 8.5 0 000 17z">
                        </path>
                    </svg>
                </div>

                <div>
                    <h3 class="font-bold text-slate-800 mb-1">Pesanan sedang diproses</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        Tim kami akan melakukan pengecekan data dan ketersediaan unit terlebih dahulu sebelum menghubungi Anda.
                    </p>
                </div>
            </div>
        </div>

        <a href="{{ route('units.katalog') }}"
           class="inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-[#fca311] hover:bg-orange-500 text-slate-900 font-bold rounded-xl shadow-lg shadow-orange-500/30 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h5m4 0h5a1 1 0 001-1V10">
                </path>
            </svg>
            Kembali ke Tampilan Utama
        </a>

    </div>

</div>
@endsection