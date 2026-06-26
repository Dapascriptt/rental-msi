@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-4rem)] px-4 py-10">
    <div class="w-full max-w-5xl mx-auto">

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
                Kelola user dan reset password
            </p>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 text-[10px] font-bold uppercase tracking-widest px-4 py-3 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-slate-50 border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-xs font-bold text-gray-800 uppercase tracking-widest">
                    Daftar User
                </h2>

                <a href="{{ route('register') }}"
                    class="bg-yellow-400 text-black text-[10px] font-bold uppercase tracking-widest px-4 py-2 rounded-md shadow-sm hover:bg-yellow-500 transition">
                    Tambah User
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-left text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                Email
                            </th>
                            <th class="px-6 py-3 text-right text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @forelse ($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-xs font-semibold text-gray-800">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.users.reset-password.edit', $user->id) }}"
                                            class="w-9 h-9 bg-yellow-100 hover:bg-yellow-200 rounded-md flex items-center justify-center text-yellow-600 hover:text-yellow-700 transition shadow-sm"
                                            title="Reset Password">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H3v-4l6.257-6.257A6 6 0 1121 9z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin mau hapus user ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="w-9 h-9 bg-red-100 hover:bg-red-200 rounded-md flex items-center justify-center text-red-500 hover:text-red-700 transition shadow-sm"
                                                title="Hapus User">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7h6m2 0H7m3-3h4a1 1 0 011 1v2H9V5a1 1 0 011-1z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-8 text-center text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                                    Belum ada user
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection