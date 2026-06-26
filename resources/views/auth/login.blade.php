<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MSI Website</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        /* Scrollbar Terang */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex items-center justify-center px-4">

    <div class="w-full max-w-sm">
        <div class="text-center mb-10">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="w-20 h-20 rounded-md flex items-center justify-center shadow-sm">
                    <img src="{{ asset('images/logonobg.png') }}" 
                    alt="Logo"
                    class="h-10 sm:h-12 w-auto object-contain">
                </div>
                <h1 class="text-lg font-bold text-gray-800 uppercase tracking-widest">MSI Admin</h1>
            </div>
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Masuk ke sistem</p>
        </div>

        <form method="POST" action="{{ route('login') }}" onsubmit="handleLoginSubmit()" class="bg-slate-50 border border-gray-200 p-8 rounded-lg shadow-sm space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-slate-50 border border-gray-300 text-gray-800 text-xs px-4 py-2.5 rounded-md
                    placeholder-gray-400 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                @error('email')
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Password
                </label>
                <input type="password" name="password" id="password" required
                    class="w-full bg-slate-50 border border-gray-300 text-gray-800 text-xs px-4 py-2.5 rounded-md
                    placeholder-gray-400 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-3 h-3 rounded border-gray-300 bg-slate-50 text-yellow-500 focus:ring-yellow-500">
                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Ingat saya</span>
                </label>
            </div>

            <button type="submit" id="submit-btn"
                class="w-full flex items-center justify-center gap-2 bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest py-3 rounded-md shadow-sm
                hover:bg-yellow-500 transition disabled:opacity-70 disabled:cursor-not-allowed">
                
                <svg id="btn-spinner" class="hidden w-4 h-4 animate-spin text-current" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>

                <span id="btn-text">Masuk</span>
            </button>

        </form>

        <a href="{{ route('units.katalog') }}"
            class="w-full flex items-center justify-center gap-2 text-[10px] font-bold uppercase tracking-widest text-gray-500 hover:text-yellow-600 transition mt-6">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Menu Utama
        </a>

    </div>

    <script>
        function handleLoginSubmit() {
            const btn = document.getElementById('submit-btn');
            const text = document.getElementById('btn-text');
            const spinner = document.getElementById('btn-spinner');

            btn.disabled = true;
            
            text.innerText = 'MEMPROSES...';
            spinner.classList.remove('hidden');
        }
    </script>

</body>
</html>