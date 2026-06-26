<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental System</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #0a0a0a; }
        ::-webkit-scrollbar-thumb { background: #262626; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #404040; }
    </style>
</head>

<body class="bg-[#0a0a0a] text-neutral-300 antialiased min-h-screen flex items-center justify-center px-4">

    <div class="text-center">
        <!-- Logo -->
        <div class="flex items-center justify-center gap-3 mb-6">
            <div class="w-12 h-12 bg-yellow-500/10 rounded-sm flex items-center justify-center border border-yellow-500/20">
                <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-neutral-100 uppercase tracking-widest">Rental System</h1>
        </div>

        <p class="text-xs font-bold text-neutral-600 uppercase tracking-widest mb-10">
            Sistem Manajemen Rental Unit
        </p>

        <!-- Login Button -->
        <a href="{{ route('login') }}"
            class="inline-flex items-center gap-2 bg-yellow-500/10 border border-yellow-500/30 text-yellow-500 text-xs font-bold uppercase tracking-widest px-8 py-3 rounded-sm
            hover:bg-yellow-500 hover:text-[#0a0a0a] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
            </svg>
            Login Admin
        </a>

        <!-- Navigation -->
        <div class="mt-10 flex items-center justify-center gap-6">
            <a href="{{ route('units.katalog') }}"
                class="text-[10px] font-bold uppercase tracking-widest text-neutral-500 hover:text-yellow-500 transition">
                Katalog Produk
            </a>
            <span class="text-neutral-700">|</span>
            <a href="{{ url('/tentang-kami') }}"
                class="text-[10px] font-bold uppercase tracking-widest text-neutral-500 hover:text-yellow-500 transition">
                Tentang Kami
            </a>
        </div>
    </div>

</body>
</html>
