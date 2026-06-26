 <section class="py-28 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid lg:grid-cols-2 gap-16 xl:gap-24 items-center">

                {{-- Left: Text --}}
                <div class="reveal">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-px w-10" style="background: var(--orange);"></div>
                        <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: var(--orange);">Profil Perusahaan</span>
                    </div>
                    <h2 class="font-serif-d mb-6" style="font-size: clamp(2rem, 4vw, 3rem); color: var(--navy); line-height: 1.15;">
                        Solusi Industri Terintegrasi dari Jantung Kalimantan Timur
                    </h2>
                    <p class="leading-relaxed mb-6" style="color: var(--steel); font-size: 1rem;">
                        <strong style="color: var(--navy);">PT. Multiply Sarana Indotama (MSI)</strong> adalah badan usaha berbadan hukum yang berkedudukan di Balikpapan, Kalimantan Timur. Didirikan dengan visi menjadi mitra strategis industri, kami melayani sektor pertambangan, perkebunan HTI, dan proyek konstruksi skala nasional.
                    </p>
                    <p class="leading-relaxed mb-10" style="color: var(--steel); font-size: 1rem;">
                        Dengan dukungan sumber daya manusia bersertifikasi dan armada alat berat dalam kondisi prima, MSI menghadirkan layanan end-to-end yang dapat diandalkan — dari penyediaan unit, pelaksanaan proyek, hingga dukungan purna jual.
                    </p>

                    {{-- Business lines --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @php
                        $lines = [
                            ['icon'=>'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z', 'label'=>'General Contractor'],
                            ['icon'=>'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 1-.987-1.106v-.958', 'label'=>'Rental Alat Berat'],
                            ['icon'=>'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z', 'label'=>'Construction Services'],
                            ['icon'=>'M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z', 'label'=>'General Supplier'],
                            ['icon'=>'M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z', 'label'=>'Welding & Fabrication'],
                            ['icon'=>'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z', 'label'=>'Manpower Service'],
                            ['icon'=>'M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Z', 'label'=>'Maintenance HD'],
                            ['icon'=>'M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z', 'label'=>'Industrial Supply'],
                        ];
                        @endphp
                        @foreach($lines as $line)
                        <div class="flex items-center gap-3 py-3 px-4 rounded-lg border" style="border-color: rgba(10,22,40,0.08); background: var(--cream);">
                            <div class="flex-shrink-0 w-8 h-8 rounded flex items-center justify-center" style="background: rgba(232,93,4,0.1);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="color: var(--orange);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $line['icon'] }}"/>
                                </svg>
                            </div>
                            <span class="text-sm font-medium" style="color: var(--navy);">{{ $line['label'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Right: Visual --}}
                <div class="reveal relative">
                    {{-- Main image --}}
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/5]">
                        <img src="https://images.unsplash.com/photo-1541888946425-d81bb19480c5?q=80&w=2070&auto=format&fit=crop"
                             alt="Heavy equipment site" class="w-full h-full object-cover">
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(10,22,40,0.7) 0%, transparent 50%);"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-8">
                            <p class="font-display text-white text-xl tracking-widest">BALIKPAPAN BASED</p>
                            <p class="text-sm mt-1" style="color: rgba(255,255,255,0.6);">Kalimantan Timur, Indonesia</p>
                        </div>
                    </div>

                    {{-- Floating accent card --}}
                    <div class="absolute -bottom-6 -left-6 p-6 rounded-xl shadow-xl hidden sm:block"
                         style="background: var(--orange); min-width: 180px;">
                        <p class="font-display text-white text-4xl leading-none">MSI</p>
                        <p class="text-white text-xs uppercase tracking-[0.2em] mt-1 opacity-80">Est. since 2009</p>
                    </div>

                    {{-- Decorative box --}}
                    <div class="absolute -top-4 -right-4 w-24 h-24 rounded-xl hidden sm:block"
                         style="background: var(--navy); opacity:0.08;"></div>
                    <div class="absolute -top-2 -right-2 w-16 h-16 rounded-xl border-2 hidden sm:block"
                         style="border-color: var(--orange); opacity:0.3;"></div>
                </div>
            </div>
        </div>
    </section>