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
            <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                Reset password user
            </p>
        </div>

        <form method="POST"
            action="{{ route('admin.users.reset-password.update', $user->id) }}"
            class="bg-slate-50 border border-gray-200 p-8 rounded-lg shadow-sm space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-gray-50 border border-gray-200 rounded-md p-4">
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">
                    User
                </p>
                <p class="text-xs font-bold text-gray-800">
                    {{ $user->name }}
                </p>
                <p class="text-xs text-gray-600 mt-1">
                    {{ $user->email }}
                </p>
            </div>

            <div>
                <label for="password" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Password Baru
                </label>
                <input type="password" name="password" id="password" required
                    class="w-full bg-slate-50 border border-gray-300 text-gray-800 text-xs px-4 py-2.5 rounded-md
                    placeholder-gray-400 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">

                @error('password')
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-2">
                    Konfirmasi Password Baru
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full bg-slate-50 border border-gray-300 text-gray-800 text-xs px-4 py-2.5 rounded-md
                    placeholder-gray-400 focus:outline-none focus:border-yellow-500 focus:ring-1 focus:ring-yellow-500 transition">
            </div>

            <button type="submit"
                class="w-full bg-yellow-400 text-black text-xs font-bold uppercase tracking-widest py-3 rounded-md shadow-sm
                hover:bg-yellow-500 transition">
                Reset Password
            </button>

            <a href="{{ route('admin.users.index') }}"
                class="block text-center text-[10px] font-bold text-gray-500 uppercase tracking-widest hover:text-yellow-600 transition">
                Kembali ke daftar user
            </a>
        </form>
    </div>
</div>
@endsection