<div class="bg-slate-950">
    <section class="py-12 bg-slate-50 overflow-hidden select-none rounded-t-[2.5rem] md:rounded-t-[4rem]">
        <div class="max-w-7xl mx-auto px-6 text-center mb-12">
            <p class="text-slate-500 font-bold uppercase tracking-[0.3em] text-xs">
                Trusted by Industry Leaders
            </p>
        </div>

        @php
            $clients = [
                'PT. ITCI Hutani Manunggal', 'PT. Tiger Ready Mix', 'CV. Regal Jaya', 'CV. Mipesa Jaya', 
                'CV. Bontang Go', 'PT. Ganda Alam Makmur', 'PT. Trakindo Utama - Cabang Batukajang', 'PT. Trakindo Utama – CRC Kariangau - Balikpapan', 
                'PT. Trakindo Utama - MRC Kariangau - Balikpapan', 'PT. Trakindo Utama – Cabang KM 13 - Balikpapan', 'PT. Trakindo Utama – ECMP KM 13 - Balikpapan', 'PT. Sanggar Sarana Baja', 
                'PT. Pradiksi Gunatama', 'PT. Paser Sukses Bertahap', 'PT. Pongtiku Bersudara', 'PT. Semesta Intra Perkasa', 
                'CV. Arfindo Equipment', 'CV. Sinar Sejati', 'CV. Sinar Pasundan', 'Hotel Iman', 
                'Novotel Balikpapan', 'Ibis Hotel', 'PT. Logindo Samudra Makmur', 'Blue Bird Group', 
                'PT. Tri Daya Jaya', 'PT. Daqing Citra Petroleum', 'CV. Anugrah Jaya Malombu', 'PT. Bumindo Sentosa Adhiperkasa', 
                'Sandvik Mining', 'PT. Nariki Minex Sejati', 'PT. Kayana Indonesia', 'PT. Satnetcom'
            ];
        @endphp

        <div class="group flex overflow-hidden">
            <div class="flex space-x-12 animate-marquee whitespace-nowrap cursor-default w-max group-hover:[animation-play-state:paused]" style="animation-duration: 80s;">
                
                @foreach(array_merge($clients, $clients) as $client)
                    <div class="flex items-center gap-4 text-2xl font-black text-slate-400 hover:text-orange-400 transition-all duration-300 uppercase tracking-tighter">
                        <span class="w-2 h-2 bg-orange-500 rounded-full shrink-0 shadow-[0_0_10px_rgba(249,115,22,0.6)]"></span>
                        {{ $client }}
                    </div>
                @endforeach

            </div>
        </div>
    </section>
</div>

<style>
    @keyframes marquee {
        0% { 
            transform: translateX(0%); 
        }
        100% { 
            transform: translateX(-50%); 
        } 
    }

    .animate-marquee {
        animation: marquee linear infinite;
    }
</style>