<section id="services" class="py-28 bg-slate-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">

            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6 mb-16 reveal">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="h-px w-10" style="background: var(--orange);"></div>
                        <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: var(--orange);">Layanan Utama</span>
                    </div>
                    <h2 class="font-serif-d" style="font-size: clamp(2rem, 4vw, 3rem); color: var(--navy); line-height:1.15;">
                        Solusi Komprehensif<br>untuk Industri Anda
                    </h2>
                </div>
                <p class="max-w-sm text-sm leading-relaxed" style="color: var(--steel);">
                    Kami menyediakan delapan lini layanan terintegrasi yang dirancang untuk memenuhi kebutuhan industri pertambangan, perkebunan, dan konstruksi secara menyeluruh.
                </p>
            </div>

            @php
            $services = [
                [
                    'icon' => 'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 1-.987-1.106v-.958',
                    'title' => 'Heavy Equipment Rental',
                    'desc' => 'Penyediaan unit Excavator (30T, 20T, 13T), Dewatering Pump, Tower Lamp, dan unit alat berat lainnya dalam kondisi prima dan siap operasi.',
                    'tag' => 'Excavator · Pump · Lighting',
                ],
                [
                    'icon' => 'M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z',
                    'title' => 'Construction Services',
                    'desc' => 'Pengerjaan jalan raya, jembatan, irigasi, gedung, dan infrastruktur skala besar dengan standar teknis dan keamanan tertinggi.',
                    'tag' => 'Road · Bridge · Infrastructure',
                ],
                [
                    'icon' => 'M20.25 7.5l-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z',
                    'title' => 'General Supplier',
                    'desc' => 'Suplai suku cadang mekanikal, elektrikal, komponen hidrolik, hingga material konstruksi seperti batu pecah, pasir, dan tanah urug.',
                    'tag' => 'Spare Parts · Materials · Hydraulic',
                ],
                [
                    'icon' => 'M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z',
                    'title' => 'Welding & Fabrication',
                    'desc' => 'Jasa general welding, perbaikan bucket, fabrikasi tangki air, ponton, dan struktur baja sesuai spesifikasi industri.',
                    'tag' => 'Welding · Fabrication · Repair',
                ],
                [
                    'icon' => 'M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Z',
                    'title' => 'Maintenance Service',
                    'desc' => 'Manajemen perawatan dan perbaikan alat berat (HD) secara preventif dan korektif oleh mekanik bersertifikasi dan berpengalaman.',
                    'tag' => 'Preventive · Corrective · HD',
                ],
                [
                    'icon' => 'M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z',
                    'title' => 'Manpower Service',
                    'desc' => 'Penyediaan tenaga ahli profesional — operator, mekanik, welder — beserta program training teknis bersertifikasi DISNAKERTRANS.',
                    'tag' => 'Operator · Mechanic · Welder',
                ],
                [
                    'icon' => 'M8.25 3v1.5M4.5 8.25H3m18 0h-1.5M4.5 12H3m18 0h-1.5m-15 3.75H3m18 0h-1.5M8.25 19.5V21M12 3v1.5m0 15V21m3.75-18v1.5m0 15V21m-9-1.5h10.5a2.25 2.25 0 0 0 2.25-2.25V6.75a2.25 2.25 0 0 0-2.25-2.25H6.75A2.25 2.25 0 0 0 4.5 6.75v10.5a2.25 2.25 0 0 0 2.25 2.25Zm.75-12h9v9h-9v-9Z',
                    'title' => 'Transportation Support',
                    'desc' => 'Rental bus operasional karyawan, dump truck, double cabin 4x4, pickup, dan light vehicle untuk kebutuhan tambang dan perkebunan.',
                    'tag' => 'Bus · Truck · LV',
                ],
                [
                    'icon' => 'M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z',
                    'title' => 'Plantation & Land Services',
                    'desc' => 'Pengerjaan penyiapan lahan HTI (cultivating & harvesting), normalisasi sawah, dan proyek irigasi pertanian skala besar.',
                    'tag' => 'HTI · Cultivation · Irrigation',
                ],
            ];
            @endphp

            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 reveal">
                @foreach($services as $svc)
                <div class="svc-card group rounded-xl p-6 border cursor-default" style="border-color: rgba(10,22,40,0.1); background: #fff;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-5 transition-colors duration-300 group-hover:scale-110"
                         style="background: var(--cream); transition: background 0.3s, transform 0.3s;"
                         onmouseover="this.style.background='rgba(232,93,4,0.12)'" onmouseout="this.style.background='var(--cream)'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" style="color: var(--navy);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $svc['icon'] }}"/>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-base mb-2" style="color: var(--navy);">{{ $svc['title'] }}</h4>
                    <p class="text-sm leading-relaxed mb-4" style="color: var(--steel); font-size: 0.8rem;">{{ $svc['desc'] }}</p>
                    <div class="pt-4 border-t" style="border-color: rgba(10,22,40,0.07);">
                        <span class="text-xs" style="color: var(--orange); font-weight: 500;">{{ $svc['tag'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>