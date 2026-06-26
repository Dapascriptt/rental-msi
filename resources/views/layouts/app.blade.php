<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental System Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }

        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>

<body class="flex bg-gray-50 text-gray-800 h-screen antialiased overflow-hidden">

    <aside id="sidebar"
        class="w-60 lg:w-64 bg-slate-50 border-r border-gray-100 h-full flex flex-col flex-shrink-0 z-10 shadow-sm transition-all duration-200
            max-lg:w-[60px]">

        {{-- Header --}}
        <div class="p-5 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-[10px] bg-amber-50 border border-amber-200 flex items-center justify-center flex-shrink-0">
                    <img src="{{ asset('images/logonobg.png') }}" alt="Logo" class="h-5 w-auto object-contain">
                </div>
                <div class="max-lg:hidden">
                    <p class="text-[11px] font-medium tracking-[0.12em] uppercase text-gray-800">MSI Admin</p>
                    <p class="text-[10px] text-gray-400 tracking-wide mt-0.5">Rental System</p>
                </div>
            </div>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto p-3 space-y-0.5">

            <p class="px-2 text-[9.5px] font-medium text-gray-400 uppercase tracking-[0.13em] mb-1.5 mt-3 max-lg:hidden">
                Mastering Data
            </p>

            @php
            $navItems = [
                ['url' => '/tipes',        'match' => 'tipes*',         'icon' => 'ti-category',         'label' => 'Tipe'],
                ['url' => '/barangs',      'match' => 'barangs*',       'icon' => 'ti-box',              'label' => 'Barang'],
                ['url' => '/harga-barangs','match' => 'harga-barangs*', 'icon' => 'ti-tag',              'label' => 'Harga Barang'],
                ['url' => '/units',        'match' => 'units*',         'icon' => 'ti-layers-intersect', 'label' => 'Unit'],
                ['url' => '/spesifikasis', 'match' => 'spesifikasis*',  'icon' => 'ti-list-details',     'label' => 'Spesifikasi'],
            ];
            @endphp

            @foreach ($navItems as $item)
            <a href="{{ url($item['url']) }}"
            class="flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-[12px] font-medium tracking-wide transition-all duration-150 border
            {{ request()->is($item['match'])
                ? 'bg-amber-100 text-amber-800 border-amber-300'
                : 'text-gray-500 border-transparent hover:bg-amber-50 hover:text-amber-800 hover:border-amber-200' }}">
                <i class="{{ $item['icon'] }} text-[15px] flex-shrink-0" 
                style="font-family: 'tabler-icons';" aria-hidden="true"></i>
                <span class="max-lg:hidden">{{ $item['label'] }}</span>
            </a>
            @endforeach

            <hr class="border-gray-100 my-2.5">
            <p class="px-2 text-[9.5px] font-medium text-gray-400 uppercase tracking-[0.13em] mb-1.5 max-lg:hidden">
                Pemesanan
            </p>

            <a href="{{ url('/pemesanan') }}"
            class="flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-[12px] font-medium tracking-wide transition-all duration-150 border
            {{ request()->is('pemesanan*')
                ? 'bg-amber-100 text-amber-800 border-amber-300'
                : 'text-gray-500 border-transparent hover:bg-amber-50 hover:text-amber-800 hover:border-amber-200' }}">
                <i class="ti ti-clipboard-list text-[15px] flex-shrink-0" aria-hidden="true"></i>
                <span class="max-lg:hidden">Pemesanan</span>
            </a>

            <hr class="border-gray-100 my-2.5">
            <p class="px-2 text-[9.5px] font-medium text-gray-400 uppercase tracking-[0.13em] mb-1.5 max-lg:hidden">
                Menu Admin
            </p>

            <a href="{{ route('register') }}"
            class="flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-[12px] font-medium tracking-wide transition-all duration-150 border
            {{ request()->is('register*')
                ? 'bg-amber-100 text-amber-800 border-amber-300'
                : 'text-gray-500 border-transparent hover:bg-amber-50 hover:text-amber-800 hover:border-amber-200' }}">
                <i class="ti ti-user-plus text-[15px] flex-shrink-0" aria-hidden="true"></i>
                <span class="max-lg:hidden">Register User</span>
            </a>

            <a href="{{ route('admin.users.index') }}"
            class="flex items-center gap-2.5 px-2.5 py-2 rounded-lg text-[12px] font-medium tracking-wide transition-all duration-150 border
            {{ request()->is('admin/users*')
                ? 'bg-amber-100 text-amber-800 border-amber-300'
                : 'text-gray-500 border-transparent hover:bg-amber-50 hover:text-amber-800 hover:border-amber-200' }}">
                <i class="ti ti-users text-[15px] flex-shrink-0" aria-hidden="true"></i>
                <span class="max-lg:hidden">Kelola User</span>
            </a>

        </nav>

        {{-- Footer --}}
        <div class="p-3 border-t border-gray-100">
            <p class="text-center text-[9.5px] font-medium text-gray-400 uppercase tracking-[0.1em] mb-2.5 max-lg:hidden">
                System v1.0
            </p>
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-3 py-2 rounded-lg text-[11px] font-medium uppercase tracking-wider
                    text-red-600 bg-red-50 border border-red-200
                    hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-150">
                    <i class="ti-logout text-[14px]" aria-hidden="true"></i>
                    <span class="max-lg:hidden">Logout</span>
                </button>
            </form>
        </div>

    </aside>

    @if (session('success'))
        <div id="toastSuccess"
            class="fixed top-5 right-5 z-50 bg-green-50 border border-green-500 text-green-700 px-5 py-3 rounded-md text-xs font-bold uppercase tracking-widest shadow-lg">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div id="toastError"
            class="fixed top-5 right-5 z-50 bg-red-50 border border-red-500 text-red-700 px-5 py-3 rounded-md text-xs font-bold uppercase tracking-widest shadow-lg">
            <ul class="space-y-1">
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <main class="flex-1 h-full overflow-y-auto p-8 relative">

        @yield('content')

        <div id="imageModal" class="fixed inset-0 bg-black/80 hidden items-center justify-center z-50">
            <div class="relative">

                <button onclick="closeModal()"
                    class="absolute -top-12 right-0 flex items-center gap-2 text-gray-700 text-sm font-bold px-4 py-2
                    bg-slate-50 border border-gray-200 rounded-md shadow-sm
                    hover:bg-red-500 hover:text-white hover:border-red-500 transition">

                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>

                    CLOSE
                </button>

                <img id="modalImage" class="max-h-[80vh] max-w-[90vw] rounded shadow-xl">
            </div>
        </div>

    </main>

    <script>
        function openModal(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
        }

        window.onclick = function (e) {
            const modal = document.getElementById('imageModal');
            if (e.target === modal) {
                closeModal();
            }
        }
    </script>

    @stack('scripts')

</body>
</html>