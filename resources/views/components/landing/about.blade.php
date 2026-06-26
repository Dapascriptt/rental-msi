<!-- 2. About Company: The Core -->
<section class="py-8 bg-slate-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="order-2 lg:order-1">
                <h2 class="text-orange-600 font-bold uppercase tracking-[0.3em] text-sm mb-4">Discover MSI</h2>
                <h3 class="text-4xl md:text-5xl font-bold text-slate-900 mb-8 leading-tight">
                    Dedikasi Untuk <span class="text-slate-400">Efisiensi &</span> <br>Produktivitas Tinggi
                </h3>
                <div class="space-y-6 text-slate-600 text-lg leading-relaxed">
                    <p>
                        <strong>PT. Multiply Sarana Indotama (MSI)</strong> hadir sebagai jawaban atas kebutuhan integrasi layanan teknis di sektor vital Indonesia. Berkedudukan di Balikpapan, kami memiliki keunggulan logistik untuk melayani proyek di Kalimantan dan seluruh Indonesia.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                        @foreach(['General Contractor', 'Rental Heavy Equipment', 'Construction', 'General Supplier', 'Welding & Fabrication', 'Maintenance Heavy Equipment', 'Manpower Service'] as $item)
                        <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 border border-slate-100 hover:border-orange-200 transition-colors">
                            <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-sm font-semibold text-slate-700">{{ $item }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="order-1 lg:order-2 relative">
                <div class="absolute -top-10 -right-10 w-64 h-64 bg-orange-100 rounded-full blur-3xl opacity-50"></div>
                <div class="relative rounded-[2rem] overflow-hidden shadow-2xl group">
                    <img
                    src="/images/HE.jpg"
                    alt="Company Illustration"
                    class="w-full h-[600px] object-cover group-hover:scale-105 transition-transform duration-700"/>                    
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900 p-10 text-white">
                        <p class="text-3xl font-bold italic">Reliable. Accountable.</p>
                        <p class="text-orange-400 uppercase tracking-widest text-xs font-bold mt-2">Professional Mining & Industrial Support</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>