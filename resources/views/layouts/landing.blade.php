<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT MSI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>

<body class="bg-slate-50 text-gray-800 antialiased">

    <!-- Header -->
   <header class="bg-sky-500 sticky top-0 shadow-sm z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

            <div class="flex items-center gap-3 px-3 py-1.5 rounded-lg shadow-sm">
                <img src="{{ asset('images/logonobg.png') }}" 
                    alt="Logo"
                    class="h-10 sm:h-12 w-auto object-contain">
            </div>

            <nav class="flex items-center gap-6">
                <!-- Navigasi 1: Katalog Produk -->
                <a href="{{ route('units.katalog') }}"
                class="text-sm sm:text-base transition-all duration-300
                {{ request()->is('katalog*') 
                    ? 'text-white font-bold underline decoration-orange-400 decoration-2 underline-offset-[6px] hover:text-orange-100' 
                    : 'text-sky-50 font-medium hover:text-orange-300 hover:-translate-y-0.5 inline-block' }}">
                    Katalog Produk
                </a>

                <!-- Navigasi 2: Tentang Kami -->
                <a href="{{ url('/tentang-kami') }}"
                class="text-sm sm:text-base transition-all duration-300
                {{ request()->is('tentang-kami') 
                    ? 'text-white font-bold underline decoration-orange-400 decoration-2 underline-offset-[6px] hover:text-orange-100' 
                    : 'text-sky-50 font-medium hover:text-orange-300 hover:-translate-y-0.5 inline-block' }}">
                    Tentang Kami
                </a>
            </nav>

        </div>
    </header>

    <main>
        @yield('content')
    </main>

   
    <section class="bg-slate-50 pt-24 pb-28 relative z-20 rounded-t-[2.5rem] md:rounded-t-[4rem] rounded-b-[2.5rem] md:rounded-b-[4rem] overflow-hidden">        
        <div class="max-w-4xl mx-auto px-6 text-center">
            
            <h2 class="text-4xl md:text-6xl font-bold text-slate-900 mb-8 tracking-tight">
                Siap Menjadi Mitra Terbaik Untuk <br>
                <span class="text-orange-600">Solusi Industri Anda</span>
            </h2>
            
            <p class="text-slate-600 mb-10 text-lg font-medium">Hubungi tim kami sekarang untuk mendiskusikan kebutuhan proyek, penyewaan alat berat, atau layanan konstruksi Anda.</p>
            
            <div class="flex flex-wrap justify-center gap-5">
                <!-- Tombol WA -->
                <a href="https://wa.me/6281253409097" target="_blank" class="px-8 py-4 bg-orange-600 text-white rounded-2xl font-bold uppercase tracking-widest hover:bg-orange-500 transition-all shadow-lg hover:shadow-xl flex items-center gap-3 hover:-translate-y-1">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.417-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.305 1.652zm6.599-3.835c1.405.836 2.498 1.299 4.195 1.299 5.232 0 9.491-4.259 9.491-9.491 0-5.233-4.259-9.491-9.491-9.491-5.234 0-9.491 4.258-9.491 9.491 0 1.934.593 3.441 1.603 5.07l-1.06 3.869 3.753-.948z"/></svg>
                    WhatsApp Kami
                </a>
                <!-- Tombol Contact Us -->
                <a href="mailto:ptmultiplysaranaindotama@gmail.com" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-bold uppercase tracking-widest hover:bg-slate-800 transition-all hover:-translate-y-1 shadow-lg">
                    Contact Us
                </a>
            </div>
            
        </div>
    </section>

    
   <!-- ==============================================
         2. SECTION FOOTER INFO
    =============================================== -->
    <footer id="contact" class="bg-sky-500 pt-40 pb-8 relative z-10 -mt-24">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="grid md:grid-cols-3 gap-12 border-b border-white/20 pb-12">
                
                <!-- Company Info -->
                <div>
                    <div class="flex items-center gap-3 mb-6 w-fit px-4 py-2 rounded-xl">
                        <!-- Logo -->
                        <img src="{{ asset('images/logonobg.png') }}" 
                            alt="Logo MSI"
                            class="h-16 w-auto object-contain"> 
                    </div>
                    <p class="text-sm text-sky-50 leading-relaxed pr-4 font-medium">
                        Menyediakan berbagai macam unit alat berat untuk kebutuhan proyek Anda. Kualitas terjamin dan terpercaya, berpusat di Balikpapan untuk melayani seluruh Indonesia.
                    </p>
                </div>

                <!-- Navigation Links -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-6 flex items-center gap-2">
                        <span class="w-4 h-[2px] bg-orange-400"></span> Navigasi
                    </h3>
                    <ul class="space-y-4 text-sm font-medium">
                        <li>
                            <!-- Teks menu -->
                            <a href="{{ route('units.katalog') }}" class="text-sky-100 hover:text-white hover:translate-x-1 transition-all flex items-center gap-2 group">
                                <svg class="w-4 h-4 text-orange-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                Katalog Produk
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/tentang-kami') }}" class="text-sky-100 hover:text-white hover:translate-x-1 transition-all flex items-center gap-2 group">
                                <svg class="w-4 h-4 text-orange-400 opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                Tentang Kami
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-widest mb-6 flex items-center gap-2">
                        <span class="w-4 h-[2px] bg-orange-400"></span> Contact Person
                    </h3>
                    
                    <!-- Nama & PT -->
                    <div class="mb-5">
                        <p class="font-bold text-orange-300 text-base">Florensia Firstly Barung</p>
                        <p class="text-sm text-sky-100 font-medium">PT. Multiply Sarana Indotama</p>
                    </div>

                    <ul class="space-y-3 text-sm text-sky-50 font-medium">
                        <li class="flex items-center gap-3 group">
                            <!-- Icon background -->
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 text-sky-500 group-hover:bg-orange-400 group-hover:text-white shadow-sm transition-all duration-300 group-hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="mt-0.5 group-hover:text-white transition-colors">Mobile : 081253409097</span>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 text-sky-500 group-hover:bg-orange-400 group-hover:text-white shadow-sm transition-all duration-300 group-hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span class="mt-0.5 group-hover:text-white transition-colors">Phone : 0542-8515658</span>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 text-sky-500 group-hover:bg-orange-400 group-hover:text-white shadow-sm transition-all duration-300 group-hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                            </div>
                            <span class="mt-0.5 group-hover:text-white transition-colors">Fax : 0542-8515658</span>
                        </li>
                        <li class="flex items-center gap-3 group">
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center flex-shrink-0 text-sky-500 group-hover:bg-orange-400 group-hover:text-white shadow-sm transition-all duration-300 group-hover:scale-110">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="mt-0.5 group-hover:text-white transition-colors">E-mail : ptmultiplysaranaindotama@gmail.com</span>
                        </li>
                    </ul>
                </div>
                
            </div>
            
            <!-- Bottom Section -->
            <div class="mt-8 flex flex-col md:flex-row justify-between items-center text-sky-200 text-sm gap-4 font-medium">
                <p>© {{ date('Y') }} PT. Multiply Sarana Indotama. All rights reserved.</p>
            </div>

        </div>
    </footer>

    <!-- Tombol WA melayang -->
    <a href="https://wa.me/6281253409097" target="_blank"
    class="fixed bottom-6 right-6 z-50 group">

        <div class="flex items-center gap-3 bg-slate-50 border border-gray-200 px-4 py-3 rounded-full shadow-lg hover:border-green-500 hover:shadow-xl transition-all duration-300">

            <div class="w-8 h-8 flex items-center justify-center bg-green-100 rounded-full group-hover:bg-green-500 transition-colors">
                <svg class="w-5 h-5 text-green-500 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20.52 3.48A11.91 11.91 0 0012.06 0C5.4 0 .02 5.37.02 12c0 2.12.55 4.2 1.6 6.03L0 24l6.14-1.6A11.94 11.94 0 0012.06 24c6.64 0 12.02-5.37 12.02-12 0-3.2-1.25-6.22-3.56-8.52zM12.06 21.8c-1.8 0-3.56-.48-5.1-1.4l-.37-.22-3.64.95.97-3.55-.24-.36A9.74 9.74 0 012.3 12c0-5.4 4.38-9.78 9.76-9.78 2.6 0 5.05 1.02 6.88 2.85A9.7 9.7 0 0121.8 12c0 5.4-4.38 9.8-9.74 9.8zm5.36-7.3c-.3-.15-1.76-.87-2.03-.97-.27-.1-.46-.15-.66.15s-.76.97-.94 1.17c-.17.2-.35.22-.65.07-.3-.15-1.27-.47-2.42-1.5-.9-.8-1.5-1.8-1.67-2.1-.17-.3-.02-.47.13-.62.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.66-1.6-.9-2.2-.24-.58-.48-.5-.66-.5h-.56c-.2 0-.52.07-.8.37-.27.3-1.05 1.02-1.05 2.5 0 1.47 1.07 2.9 1.22 3.1.15.2 2.1 3.2 5.1 4.48.7.3 1.25.47 1.68.6.7.22 1.34.2 1.84.12.56-.08 1.76-.72 2-1.42.25-.7.25-1.3.17-1.42-.08-.12-.27-.2-.57-.35z"/>
                </svg>
            </div>

            <span class="text-xs font-bold text-gray-700 uppercase tracking-widest hidden sm:block">
                Chat WA
            </span>

        </div>
    </a>

</body>
</html>