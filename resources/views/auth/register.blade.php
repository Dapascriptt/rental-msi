@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-[calc(100vh-4rem)] px-4">
    <div class="w-full max-w-sm my-8">

        <div class="text-center mb-10">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div class="w-20 h-20 rounded-md flex items-center justify-center shadow-sm">
                    <img src="{{ asset('images/logonobg.png') }}" 
                    alt="Logo"
                    class="h-10 sm:h-12 w-auto object-contain">
                </div>
                <h1 class="text-lg font-bold text-gray-800 uppercase tracking-widest">MSI Admin</h1>
            </div>
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">Buat akun baru</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="bg-slate-50 border border-gray-200 p-8 rounded-lg shadow-sm space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Nama
                </label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                    class="w-full bg-slate-50 border border-gray-300 text-gray-800 text-xs px-4 py-2.5 rounded-md
                    placeholder-gray-400 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
                @error('name')
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Email
                </label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
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
                @error('password')
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Konfirmasi Password
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full bg-slate-50 border border-gray-300 text-gray-800 text-xs px-4 py-2.5 rounded-md
                    placeholder-gray-400 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest py-3 rounded-md shadow-sm
                hover:bg-yellow-500 transition">
                Daftar
            </button>
        </form>
    </div>
</div>
@endsection