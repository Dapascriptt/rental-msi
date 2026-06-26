<section class="py-8 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:40px_40px]"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
            <div>
                <h2 class="text-orange-500 font-bold uppercase tracking-widest text-sm mb-4">Our Fleet</h2>
                <h3 class="text-4xl font-bold">Excavator Ready-to-Deploy</h3>
            </div>
            <p class="text-slate-400 max-w-md border-l border-slate-700 pl-6">
                Unit excavator dari berbagai brand terpercaya seperti Doosan, Komatsu, Kobelco, dan Caterpillar siap mendukung kebutuhan operasional proyek Anda.
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach([
                ['brand' => 'Doosan', 'model' => 'DX225LCA'],
                ['brand' => 'Komatsu', 'model' => 'PC300-8'],
                ['brand' => 'Kobelco', 'model' => 'SK200-8'],
                ['brand' => 'Doosan', 'model' => 'DX220A-2'],
                ['brand' => 'Kobelco', 'model' => 'SK200-10 HD'],
                ['brand' => 'Kobelco', 'model' => 'SK130XDL-10'],
                ['brand' => 'Kobelco', 'model' => 'SK130XDL-10E'],
                ['brand' => 'Caterpillar', 'model' => '313'],
            ] as $fleet)
            <div class="bg-slate-50/5 border border-white/10 p-6 rounded-2xl hover:bg-slate-50/10 hover:border-orange-500/50 transition-all">
                <div class="text-orange-400 mb-5 flex justify-center">
                    <svg class="w-11 h-11" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" d="M3 17h2m14 0h2M7 17h10M6 17a3 3 0 106 0 3 3 0 00-6 0zm6 0a3 3 0 106 0 3 3 0 00-6 0zM4 14h3l2-5h5l3 5h3M9 9V6h4l2 3" />
                    </svg>
                </div>

                <div class="text-center">
                    <span class="block text-orange-400 text-xs font-bold uppercase tracking-widest mb-2">
                        {{ $fleet['brand'] }}
                    </span>
                    <span class="block font-bold text-sm md:text-base uppercase tracking-wider">
                        {{ $fleet['model'] }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/katalog" class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-orange-500 hover:bg-orange-600 text-white font-bold uppercase tracking-wider text-sm transition-all shadow-lg shadow-orange-500/20">
                Lihat Katalog Unit
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>