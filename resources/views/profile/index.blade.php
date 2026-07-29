@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    {{-- Header Page Ala SIMPRO --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block"></span>
                Profil Saya
            </h1>
            <p class="text-xs text-slate-400 font-medium mt-1">
                Informasi detail akun dan hak akses pengguna SIMPRO.
            </p>
        </div>

        <div>
            <a href="{{ route('profile.edit') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-sky-600 hover:bg-sky-700 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-user-pen text-xs"></i>
                <span>Edit Profil</span>
            </a>
        </div>
    </div>

    {{-- Profile Hero Card --}}
    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
        <div class="flex items-center gap-5">
            {{-- Avatar Inisial --}}
            <div class="w-16 h-16 rounded-2xl bg-sky-50 border border-sky-100 flex items-center justify-center text-sky-600 text-2xl font-extrabold shrink-0 shadow-sm">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            
            <div class="space-y-1">
                <div class="flex items-center gap-2.5">
                    <h2 class="text-xl font-bold text-slate-800">
                        {{ Auth::user()->name }}
                    </h2>
                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 ring-1 ring-inset ring-emerald-600/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Aktif
                    </span>
                </div>
                <p class="text-xs text-slate-400 font-medium flex items-center gap-1.5">
                    <i class="fa-regular fa-envelope text-slate-400"></i>
                    <span>{{ Auth::user()->email }}</span>
                </p>
            </div>
        </div>

        {{-- Role Summary Box --}}
        <div class="flex items-center gap-3 bg-slate-50/80 p-3.5 rounded-xl border border-slate-100 w-full md:w-auto">
            <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                <i class="fa-solid fa-shield-halved text-sm"></i>
            </div>
            <div class="pr-4">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Peran Sistem</p>
                <p class="text-xs font-bold text-slate-700 mt-0.5">
                    {{ ucfirst(Auth::user()->role ?? 'User') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Detail Info Cards Grid (SIMPRO Widget Style) --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

        {{-- Card 1: Nama Lengkap --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        Nama Lengkap
                    </p>
                    <h3 class="text-base font-bold text-slate-800 mt-3">
                        {{ Auth::user()->name }}
                    </h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-user text-sm"></i>
                </div>
            </div>
            
            <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] font-medium text-slate-400">Identitas Pengguna</span>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-sky-50 text-sky-600">
                    Profil
                </span>
            </div>
        </div>

        {{-- Card 2: Alamat Email --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div class="min-w-0">
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        Alamat Email
                    </p>
                    <h3 class="text-base font-bold text-slate-800 mt-3 truncate pr-2" title="{{ Auth::user()->email }}">
                        {{ Auth::user()->email }}
                    </h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-envelope text-sm"></i>
                </div>
            </div>

            <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] font-medium text-slate-400">Status Akun</span>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-emerald-50 text-emerald-600">
                    Terverifikasi
                </span>
            </div>
        </div>

        {{-- Card 3: Hak Akses / Role --}}
        <div class="bg-white rounded-2xl border border-slate-100 p-5 shadow-sm flex flex-col justify-between">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        Hak Akses / Role
                    </p>
                    <h3 class="text-base font-bold text-slate-800 mt-3">
                        {{ ucfirst(Auth::user()->role ?? '-') }}
                    </h3>
                </div>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-user-shield text-sm"></i>
                </div>
            </div>

            <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[11px] font-medium text-slate-400">Otorisasi Sistem</span>
                @php
                    $roleTag = match (strtolower(Auth::user()->role ?? '')) {
                        'admin', 'superadmin' => 'bg-indigo-50 text-indigo-600',
                        default => 'bg-slate-100 text-slate-600'
                    };
                @endphp
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold {{ $roleTag }}">
                    {{ strtoupper(Auth::user()->role ?? 'USER') }}
                </span>
            </div>
        </div>

    </div>

</div>
@endsection