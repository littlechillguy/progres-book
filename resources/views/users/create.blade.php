@extends('layouts.app')

@section('title', 'Tambah Admin')

@section('content')
<div class="p-6 space-y-6 max-w-3xl mx-auto">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block"></span>
                Tambah Admin Baru
            </h1>
            <p class="text-xs text-slate-400 font-medium mt-1">
                Buat akun pengguna baru dengan hak akses admin atau super admin
            </p>
        </div>

        <div>
            <a href="{{ route('users.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- Main Form Card --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        
        <form action="{{ route('users.store') }}" method="POST" class="p-6 sm:p-8 space-y-6">
            @csrf

            {{-- Nama --}}
            <div class="space-y-1.5">
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-user text-xs"></i>
                    </div>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('name') border-rose-300 bg-rose-50/20 @else border-slate-200 @enderror rounded-xl text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:bg-white transition-all duration-200"
                        placeholder="Masukkan nama lengkap" required>
                </div>
                @error('name')
                    <p class="text-xs text-rose-500 font-medium mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="space-y-1.5">
                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Alamat Email <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-envelope text-xs"></i>
                    </div>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('email') border-rose-300 bg-rose-50/20 @else border-slate-200 @enderror rounded-xl text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:bg-white transition-all duration-200"
                        placeholder="contoh@domain.com" required>
                </div>
                @error('email')
                    <p class="text-xs text-rose-500 font-medium mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Role --}}
            <div class="space-y-1.5">
                <label for="role" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                    Hak Akses (Role) <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-user-shield text-xs"></i>
                    </div>
                    <select id="role" name="role"
                        class="w-full pl-10 pr-8 py-2.5 bg-slate-50 border @error('role') border-rose-300 bg-rose-50/20 @else border-slate-200 @enderror rounded-xl text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:bg-white transition-all duration-200 appearance-none">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </div>
                @error('role')
                    <p class="text-xs text-rose-500 font-medium mt-1 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Grid Password & Konfirmasi --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 pt-2 border-t border-slate-100">
                
                {{-- Password --}}
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Password <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-lock text-xs"></i>
                        </div>
                        <input type="password" id="password" name="password"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('password') border-rose-300 bg-rose-50/20 @else border-slate-200 @enderror rounded-xl text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:bg-white transition-all duration-200"
                            placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <p class="text-xs text-rose-500 font-medium mt-1 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider">
                        Konfirmasi Password <span class="text-rose-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-key text-xs"></i>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-xs sm:text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 focus:bg-white transition-all duration-200"
                            placeholder="••••••••" required>
                    </div>
                </div>

            </div>

            {{-- Form Actions Footer --}}
            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('users.index') }}"
                    class="px-5 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 active:bg-slate-100 text-slate-600 text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                    Batal
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    <span>Simpan Admin</span>
                </button>
            </div>

        </form>

    </div>

</div>
@endsection