<section class="py-28 relative overflow-hidden" style="background: var(--navy-mid);">
        <div class="absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2070&auto=format&fit=crop'); background-size: cover; background-position:center; opacity:0.06;"></div>

        {{-- Diagonal accent --}}
        <div class="absolute top-0 right-0 w-96 h-full hidden lg:block" style="background: linear-gradient(to left, rgba(232,93,4,0.06), transparent);"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <div class="reveal">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="h-px w-10" style="background: var(--orange);"></div>
                        <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: var(--orange);">Health, Safety & Environment</span>
                    </div>
                    <h2 class="font-serif-d text-white mb-6" style="font-size: clamp(2rem, 4vw, 3rem); line-height:1.15;">
                        Komitmen K3 &<br>Keselamatan Kerja
                    </h2>
                    <p class="leading-relaxed mb-8" style="color: rgba(255,255,255,0.6); font-size: 0.95rem;">
                        PT. MSI menjunjung tinggi standar Keselamatan dan Kesehatan Kerja (K3) di setiap aspek operasional. Seluruh personel kami dibekali sertifikasi resmi dan pengawasan ketat sesuai regulasi yang berlaku.
                    </p>

                    {{-- Cert badges --}}
                    <div class="flex flex-col sm:flex-row gap-4">
                        @php
                        $certs = [
                            ['title'=>'K3 Umum','body'=>'Sertifikasi K3 DISNAKERTRANS','icon'=>'M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z'],
                            ['title'=>'POP Certified','body'=>'Pengawas Operasional Pratama','icon'=>'M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z'],
                            ['title'=>'HSE Standard','body'=>'Zero Accident Work Culture','icon'=>'M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z'],
                        ];
                        @endphp
                        @foreach($certs as $cert)
                        <div class="badge-glow flex-1 rounded-xl p-5 border" style="background: rgba(255,255,255,0.04); border-color: rgba(232,93,4,0.2);">
                            <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-3" style="background: rgba(232,93,4,0.15);">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="color: var(--orange);">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $cert['icon'] }}"/>
                                </svg>
                            </div>
                            <p class="font-semibold text-sm text-white">{{ $cert['title'] }}</p>
                            <p class="text-xs mt-1" style="color: rgba(255,255,255,0.5);">{{ $cert['body'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Safety commitment list --}}
                <div class="reveal">
                    <div class="rounded-2xl p-8 border" style="background: rgba(255,255,255,0.03); border-color: rgba(255,255,255,0.08);">
                        <h4 class="font-semibold text-white mb-6 uppercase tracking-widest text-xs">Komitmen Keselamatan Kami</h4>
                        @php
                        $safeties = [
                            'Seluruh operator dan teknisi memiliki sertifikasi SIM alat berat resmi',
                            'Inspeksi unit harian (pre-start checklist) sebelum operasi',
                            'APD lengkap wajib di seluruh area kerja dan proyek',
                            'Emergency Response Plan tersedia di setiap lokasi proyek',
                            'Safety briefing rutin dan hazard identification berkala',
                            'Zero tolerance policy terhadap pelanggaran prosedur K3',
                        ];
                        @endphp
                        <div class="space-y-4">
                            @foreach($safeties as $i => $item)
                            <div class="flex items-start gap-4 pb-4 border-b" style="border-color: rgba(255,255,255,0.06);">
                                <div class="flex-shrink-0 w-6 h-6 rounded flex items-center justify-center mt-0.5" style="background: rgba(232,93,4,0.2);">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="color: var(--orange);">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                                    </svg>
                                </div>
                                <p class="text-sm leading-relaxed" style="color: rgba(255,255,255,0.65);">{{ $item }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>