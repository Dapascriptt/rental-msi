@php
    $stats = [
        ['15+', 'Tahun Pengalaman'],
        ['200+', 'Unit Siap Operasi'],
        ['50+', 'Klien Industri']
    ];
@endphp

<section class="relative min-h-screen flex items-end pb-20 overflow-hidden grain" style="background-color: var(--navy);">

    {{-- Background image --}}
    <div class="absolute inset-0 z-0"
         style="background-image: url('https://images.unsplash.com/photo-1581094288338-2314dddb7ecb?q=80&w=2070&auto=format&fit=crop');
                background-size: cover; background-position: center 30%; opacity: 0.22;">
    </div>

    {{-- Gradient overlay --}}
    <div class="absolute inset-0 z-0" style="background: linear-gradient(135deg, rgba(10,22,40,0.98) 0%, rgba(18,32,64,0.85) 55%, rgba(10,22,40,0.65) 100%);"></div>

    {{-- Geometric decorations --}}
    <div class="geo-line w-64 h-64 top-16 right-24 rotate-12 hidden lg:block" style="z-index:2;"></div>
    <div class="geo-line w-40 h-40 top-32 right-48 rotate-12 hidden lg:block" style="z-index:2; border-color: rgba(232,93,4,0.25);"></div>
    <div class="absolute top-0 right-0 w-1/3 h-full hidden lg:block" style="background: linear-gradient(to left, rgba(232,93,4,0.04), transparent); z-index:2;"></div>

    {{-- Vertical rule --}}
    <div class="absolute left-1/2 top-0 bottom-0 w-px hidden xl:block" style="background: rgba(255,255,255,0.04); z-index:2;"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 w-full">

        {{-- Label --}}
        <div class="flex items-center gap-3 mb-8">
            <div class="h-px w-12" style="background: var(--orange);"></div>
            <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: var(--orange);">Tentang Kami</span>
        </div>

        {{-- Main heading --}}
        <h1 class="font-display text-white mb-6" style="font-size: clamp(3.5rem, 9vw, 8rem); line-height: 0.95;">
            PT. MULTIPLY<br>
            <span style="color: var(--orange); -webkit-text-stroke: 0px;">SARANA</span><br>
            INDOTAMA
        </h1>

        <div class="flex flex-col sm:flex-row gap-6 items-start sm:items-end justify-between max-w-5xl">
            <p class="text-base lg:text-lg max-w-md leading-relaxed" style="color: rgba(255,255,255,0.6);">
                General Contractor &bull; Rental Heavy Equipment &bull; Construction &bull; Industrial Services
                — mitra strategis industri nasional berbasis di Balikpapan, Kalimantan Timur.
            </p>
           <a href="#contact"
            class="flex-shrink-0 inline-flex items-center gap-3 px-8 py-4 font-semibold text-sm uppercase tracking-[0.15em] text-white transition-all duration-300 bg-[#e85d04] hover:bg-[#ff6b1a]">
                Hubungi Kami
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/>
                </svg>
            </a>
        </div>

        {{-- Stat strip --}}
        <div class="mt-16 pt-8 border-t grid grid-cols-3 sm:grid-cols-3 gap-6" style="border-color: rgba(255,255,255,0.08);">
            @foreach($stats as $s)
            <div>
                <p class="stat-number text-white" style="font-size: 2.5rem; line-height:1; color: var(--orange);">{{ $s[0] }}</p>
                <p class="text-xs uppercase tracking-widest mt-1" style="color: rgba(255,255,255,0.45);">{{ $s[1] }}</p>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Bottom edge fade --}}
    <div class="absolute bottom-0 left-0 right-0 h-24" style="background: linear-gradient(to top, #ffffff 0%, transparent 100%); z-index:10;"></div>
</section>