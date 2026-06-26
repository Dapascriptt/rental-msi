<!-- 3. Vision & Mission: Modern Card -->
<section class="py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Vision -->
            <div class="bg-slate-900 rounded-3xl p-12 text-white relative overflow-hidden shadow-xl">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
                </div>
                <h4 class="text-orange-500 font-bold uppercase tracking-widest text-sm mb-6 flex items-center gap-2">
                    <span class="w-8 h-[2px] bg-orange-500"></span> Visi Perusahaan
                </h4>
                <p class="text-3xl md:text-4xl lg:text-5xl font-light leading-tight italic">
                    "Menjadi agen pembaharu yang terus menerus menyediakan layanan terbaik secara efektif dalam segala aspek usaha untuk mencapai produktivitas terbaik dibidangnya."
                </p>
            </div>
            
            <!-- Mission -->
            <div class="bg-slate-50 rounded-3xl p-12 border border-slate-200 shadow-sm relative overflow-hidden">
                <h4 class="text-slate-900 font-bold uppercase tracking-widest text-sm mb-6 flex items-center gap-2">
                    <span class="w-8 h-[2px] bg-slate-900"></span> Misi Kami
                </h4>
                
                <!-- Paragraf Pembuka Misi -->
                <p class="text-slate-600 mb-8 text-sm leading-relaxed">
                    Membangun perusahaan yang selalu siap memberikan total solusi dengan komitmen yang tinggi dan secara terus-menerus meningkatkan kualitas layanan terbaik guna menunjang produktivitas mitra kerja yang efektive dan efisien serta berupaya membuka lapangan kerja baru seluas-luasnya dengan mengusung beberapa nilai sebagai berikut:
                </p>

                <div class="space-y-4 italic">
                    @foreach([
                        'Berupaya menciptakan tenaga kerja yang handal dan profesional di bidangnya dengan mengembangkan pengetahuan dan keterampilan secara berkesinambungan.',
                        'Menyediakan segala kebutuhan pendukung bagi berlangsungnya operasional secara tepat waktu dan berkelanjutan.',
                        'Menjunjung tinggi kode etik dan standard layanan yang terbaik.',
                        'Berupaya untuk terus bertumbuh dan berkembang, baik finansial, intelektual serta citra perusahaan secara konsisten.',
                        'Senantiasa mewujudkan nilai dan norma keunggulan dan akuntabilitas yang tinggi yang akhirnya dapat memuaskan pelanggan secara terus-menerus.'
                    ] as $mission)
                    <div class="flex items-start gap-4 group">
                        <div class="mt-1 w-6 h-6 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0 group-hover:bg-orange-500 transition-colors">
                            <svg class="w-3 h-3 text-orange-500 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <p class="text-slate-600 font-medium text-sm leading-relaxed">{{ $mission }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>