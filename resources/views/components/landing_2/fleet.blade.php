 <section class="py-28" style="background: var(--cream);">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">

            <div class="text-center mb-16 reveal">
                <div class="inline-flex items-center gap-3 mb-4">
                    <div class="h-px w-10" style="background: var(--orange);"></div>
                    <span class="text-xs font-semibold uppercase tracking-[0.35em]" style="color: var(--orange);">Armada Siap Operasi</span>
                    <div class="h-px w-10" style="background: var(--orange);"></div>
                </div>
                <h2 class="font-serif-d" style="font-size: clamp(2rem, 4vw, 3rem); color: var(--navy);">Equipment Ready Units</h2>
                <p class="mt-3 max-w-lg mx-auto text-sm" style="color: var(--steel);">
                    Seluruh unit kami terpelihara dengan standar OEM dan siap dimobilisasi ke lokasi proyek Anda.
                </p>
            </div>

            @php
            $equipment = [
                ['icon'=>'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 1-.987-1.106v-.958','unit'=>'Excavator','spec'=>'13T / 20T / 30T Class','status'=>'Ready'],
                ['icon'=>'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 1-.987-1.106v-.958','unit'=>'Bus Operasional','spec'=>'Kapasitas 20-40 Seat','status'=>'Ready'],
                ['icon'=>'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 1-.987-1.106v-.958','unit'=>'Dump Truck','spec'=>'10T / 20T Capacity','status'=>'Ready'],
                ['icon'=>'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 1-.987-1.106v-.958','unit'=>'Double Cabin 4x4','spec'=>'Off-road Terrain','status'=>'Ready'],
                ['icon'=>'M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 1-.987-1.106v-.958','unit'=>'Light Vehicle','spec'=>'Pick Up & MPV','status'=>'Ready'],
                ['icon'=>'M9.348 14.652a3.75 3.75 0 0 1 0-5.304m5.304 0a3.75 3.75 0 0 1 0 5.304m-7.425 2.121a6.75 6.75 0 0 1 0-9.546m9.546 0a6.75 6.75 0 0 1 0 9.546M5.106 18.894c-3.808-3.807-3.808-9.98 0-13.788m13.788 0c3.808 3.807 3.808 9.98 0 13.788M12 12h.008v.008H12V12Z','unit'=>'Water Pump','spec'=>'Dewatering System','status'=>'Ready'],
            ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 reveal">
                @foreach($equipment as $eq)
                <div class="eq-card rounded-xl bg-slate-50 p-6 text-center border" style="border-color: rgba(10,22,40,0.08);">
                    <div class="w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-4" style="background: var(--navy);">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="color: var(--orange);">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $eq['icon'] }}"/>
                        </svg>
                    </div>
                    <p class="font-semibold text-sm mb-1" style="color: var(--navy);">{{ $eq['unit'] }}</p>
                    <p class="text-xs mb-3" style="color: var(--steel-light);">{{ $eq['spec'] }}</p>
                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold px-3 py-1 rounded-full" style="background: rgba(232,93,4,0.1); color: var(--orange);">
                        <span class="w-1.5 h-1.5 rounded-full inline-block" style="background: var(--orange);"></span>
                        {{ $eq['status'] }}
                    </span>
                </div>
                @endforeach
            </div>

            {{-- Material strip --}}
            <div class="mt-10 rounded-2xl p-8 reveal" style="background: var(--navy);">
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                    <div class="flex-shrink-0">
                        <p class="text-xs uppercase tracking-widest mb-1" style="color: var(--orange);">Premium Materials</p>
                        <p class="font-display text-white text-2xl tracking-wider">READY STOCK</p>
                    </div>
                    <div class="h-10 w-px hidden sm:block" style="background: rgba(255,255,255,0.12);"></div>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 flex-1">
                        @foreach(['Batu Pecah Agregat','Pasir Palu & Pasir Putih','Batu Gunung & Batu Belah','Tanah Urug & Fill','Pasir Cuci Beton','Material Konstruksi'] as $mat)
                        <div class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" style="color: var(--orange);">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5"/>
                            </svg>
                            <span class="text-xs" style="color: rgba(255,255,255,0.7);">{{ $mat }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>