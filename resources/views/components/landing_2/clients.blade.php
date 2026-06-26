 <section class="py-28 bg-slate-50 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center mb-12 reveal">
            <div class="inline-flex items-center gap-3 mb-4">
                <div class="h-px w-10" style="background: var(--orange);"></div>
                <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: var(--orange);">Partner & Klien</span>
                <div class="h-px w-10" style="background: var(--orange);"></div>
            </div>
            <h2 class="font-serif-d mb-3" style="font-size: clamp(1.8rem, 4vw, 2.75rem); color: var(--navy);">Dipercaya oleh Industri Nasional</h2>
            <p class="text-sm" style="color: var(--steel);">Trusted by Mining, Construction, Plantation &amp; Industrial Companies across Indonesia</p>
        </div>

        {{-- Marquee --}}
        <div class="relative overflow-hidden" style="mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">
            <div class="flex gap-0 marquee-track" style="width: max-content;">
                @php
                $clients = [
                    'PT. ITCI Hutani Manunggal','PT. Trakindo Utama','PT. Sanggar Sarana Baja',
                    'PT. Ganda Alam Makmur','Sandvik Mining','Blue Bird Group',
                    'Novotel Hotels','Ibis Hotels','PT. Pertamina',
                    'PT. Pelindo','PT. Adaro Energy','PT. Berau Coal',
                ];
                // Duplicate for seamless loop
                $all = array_merge($clients, $clients);
                @endphp
                @foreach($all as $c)
                <div class="flex-shrink-0 flex items-center justify-center px-10 py-6 mx-3 rounded-xl border"
                     style="border-color: rgba(10,22,40,0.08); min-width: 220px; background: var(--cream);">
                    <span class="font-semibold text-sm text-center" style="color: var(--steel);">{{ $c }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Experience numbers --}}
        <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-20 reveal">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6">
                @foreach([['15+','Tahun Berpengalaman'],['200+','Unit Armada'],['50+','Klien Aktif'],['1000+','Project Selesai']] as $stat)
                <div class="text-center py-8 rounded-2xl border" style="border-color: rgba(10,22,40,0.08); background: var(--cream);">
                    <p class="stat-number text-5xl" style="color: var(--orange); line-height:1;">{{ $stat[0] }}</p>
                    <p class="text-xs uppercase tracking-widest mt-2" style="color: var(--steel);">{{ $stat[1] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>