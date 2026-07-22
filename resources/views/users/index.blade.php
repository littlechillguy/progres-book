@extends('layouts.app')

@section('title', 'Kelola Akun')

@section('content')

<div class="space-y-6 pb-12">

    {{-- 1. Header & Quick Action Card --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden">
        {{-- Accent Background Gradient Blur --}}
        <div class="absolute -right-10 -top-10 w-48 h-48 bg-indigo-500/5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
            <div class="space-y-1">
                <div class="flex items-center gap-2">
                    <span class="px-2.5 py-1 bg-indigo-50 text-indigo-700 border border-indigo-100 font-bold rounded-lg text-[10px] tracking-wide inline-block">
                        User Management
                    </span>
                </div>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                    Kelola <span class="text-indigo-600">Akun</span>
                </h1>
                <p class="text-xs text-slate-500 font-medium">
                    Daftar seluruh administrator dan hak akses pengguna sistem PRO-BOOK.
                </p>
            </div>

            <a href="{{ route('users.create') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs hover:shadow transition-all duration-200 active:scale-95 shrink-0">
                <i class="fa-solid fa-plus text-[10px]"></i>
                <span>Tambah Admin</span>
            </a>
        </div>
    </div>

    {{-- 2. Toolbar Pencarian & Filter --}}
    <div class="bg-white rounded-2xl p-4 border border-slate-200/60 shadow-sm">
        <form method="GET" action="{{ route('users.index') }}">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="w-full sm:w-80 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                           class="w-full pl-9 pr-4 py-2 bg-slate-50/60 border border-slate-200/80 text-slate-700 text-xs font-semibold rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder:text-slate-400">
                </div>

                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <button type="submit"
                            class="flex-1 sm:flex-none px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs hover:shadow transition-all duration-200 flex items-center justify-center gap-1.5 active:scale-95">
                        <i class="fa-solid fa-filter text-[10px]"></i>
                        <span>Cari</span>
                    </button>

                    @if(request('search'))
                        <a href="{{ route('users.index') }}" 
                           class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all duration-200 flex items-center justify-center border border-slate-200/60 active:scale-95"
                           title="Reset Pencarian">
                            <i class="fa-solid fa-rotate-left text-[11px]"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- 3. Tabel Administrator --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6 min-w-[200px]">Pengguna</th>
                        <th class="py-3.5 px-6 min-w-[200px]">Email</th>
                        <th class="py-3.5 px-6 text-center whitespace-nowrap w-36">Role</th>
                        <th class="py-3.5 px-6 text-center whitespace-nowrap w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            
                            {{-- Nama & Avatar Initial --}}
                            <td class="py-4 px-6 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 font-black text-xs flex items-center justify-center uppercase shrink-0 shadow-2xs">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800 text-xs leading-snug">
                                            {{ $user->name }}
                                        </span>
                                        @if(auth()->id() == $user->id)
                                            <span class="text-[10px] text-indigo-600 font-bold">(Akun Anda)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="py-4 px-6 text-slate-500 font-semibold align-middle">
                                {{ $user->email }}
                            </td>

                            {{-- Role Badge --}}
                            <td class="py-4 px-6 text-center whitespace-nowrap align-middle">
                                @if($user->role == 'superadmin')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-100">
                                        <i class="fa-solid fa-shield-halved text-[9px]"></i>
                                        <span>Super Admin</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-100">
                                        <i class="fa-solid fa-user-shield text-[9px]"></i>
                                        <span>Admin</span>
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="py-4 px-6 text-center whitespace-nowrap align-middle">
                                <div class="flex items-center justify-center gap-1.5">
                                    {{-- Edit --}}
                                    <a href="{{ route('users.edit', $user) }}" 
                                       class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-all shadow-2xs" 
                                       title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    {{-- Reset Password --}}
                                    <form action="{{ route('users.reset-password', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                onclick="return confirm('Reset password akun ini menjadi admin123?')" 
                                                class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-500 hover:text-white flex items-center justify-center transition-all shadow-2xs" 
                                                title="Reset Password">
                                            <i class="fa-solid fa-key text-xs"></i>
                                        </button>
                                    </form>

                                    {{-- Delete --}}
                                    @if(auth()->id() != $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all shadow-2xs" 
                                                    title="Hapus Akun">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    @else
                                        {{-- Spacer pembantu agar alignment tetap rata --}}
                                        <div class="w-8 h-8"></div>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center bg-white">
                                <div class="max-w-xs mx-auto text-center space-y-2">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-lg shadow-inner">
                                        <i class="fa-solid fa-user-slash"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Data tidak ditemukan</p>
                                    <p class="text-[11px] text-slate-400">Belum ada akun admin atau kata kunci pencarian Anda tidak cocok.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($users, 'links') && $users->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $users->withQueryString()->links() }}
            </div>
        @endif
    </div>

</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 5px;
        width: 5px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: #cbd5e1;
    }
</style>

@endsection