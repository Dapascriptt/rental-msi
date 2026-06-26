<!-- 1. Hero Section: Industrial Power -->
<section class="relative min-h-[110vh] flex items-center overflow-hidden bg-slate-900">
    <!-- Background with Ken Burns Effect (Soft Scale) -->
    <div class="absolute inset-0 z-0 scale-105 transition-transform duration-[10000ms] ease-linear">
        <img src="https://images.unsplash.com/photo-1581094288338-2314dddb7ecb?q=80&w=2070&auto=format&fit=crop" 
             class="w-full h-full object-cover opacity-40" alt="Industrial Site">
    </div>
    <!-- Modern Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-tr from-slate-900 via-slate-900/80 to-transparent z-10"></div>

    <div class="relative z-20 max-w-7xl mx-auto px-6 pt-20 pb-32"> <!-- Tambahkan pb-32 agar konten tidak tertutup diagonal -->
        <div class="max-w-3xl">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-orange-600/10 border border-orange-500/20 rounded-full mb-8 backdrop-blur-md">
                <span class="relative flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-orange-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-orange-500"></span>
                </span>
                <span class="uppercase tracking-[0.2em] text-xs font-bold text-orange-400">Leading Industrial Solution</span>
            </div>
            
            <h1 class="text-6xl md:text-8xl font-black text-white leading-[0.9] mb-6 tracking-tight">
                PT. MULTIPLY <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-orange-600">
                    SARANA INDOTAMA
                </span>
            </h1>
            
            <p class="text-lg md:text-2xl text-slate-300 mb-10 leading-relaxed font-light border-l-2 border-orange-500 pl-6">
                General Contractor, Rental, Construction & Industrial Services. 
                <span class="block mt-2 text-slate-400 text-base italic">Mitra strategis terpercaya berbasis di Balikpapan untuk kemajuan infrastruktur nasional.</span>
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="#contact" class="group relative px-8 py-4 bg-orange-600 overflow-hidden rounded-xl transition-all duration-300 hover:shadow-[0_0_25px_rgba(234,88,12,0.4)]">
                    <span class="relative z-10 text-white font-bold uppercase tracking-wider flex items-center gap-2">
                        Hubungi Kami
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0 w-full z-30 leading-none">
        <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-16 md:h-32 lg:h-40">
            <polygon fill="currentColor" points="0,100 100,0 100,100" class="text-white" />
        </svg>
    </div>
</section>