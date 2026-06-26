 <section class="py-24 bg-orange-600">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-3 gap-12 items-center">
            <div class="lg:col-span-1 text-white">
                <h3 class="text-3xl font-bold mb-6">Safety First, <br>Always.</h3>
                <p class="text-orange-100 leading-relaxed">
                    Kami menjunjung tinggi standar keselamatan kerja (HSE) di setiap aspek operasional. Komitmen kami adalah nol kecelakaan kerja (Zero Accident).
                </p>
            </div>
            <div class="lg:col-span-2 grid md:grid-cols-3 gap-6">
                @foreach(['K3 Certification', 'POP Certification', 'Safety Commitment'] as $cert)
                <div class="bg-slate-50/10 backdrop-blur-lg border border-white/20 p-8 rounded-3xl text-white hover:bg-slate-50 hover:text-orange-600 transition-all duration-300">
                    <div class="mb-4">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <span class="text-lg font-bold">{{ $cert }}</span>
                    <p class="text-xs mt-2 opacity-80 uppercase tracking-tighter">Verified Standard</p>
                </div>
                @endforeach
            </div>
        </div>
</section>