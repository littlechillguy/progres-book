@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6 max-w-4xl mx-auto">

    {{-- Header Page Ala SIMPRO --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block"></span>
                Edit Profil
            </h1>
            <p class="text-xs text-slate-400 font-medium mt-1">
                Kelola informasi akun dan pengaturan keamanan pengguna SIMPRO.
            </p>
        </div>

        <div>
            <a href="javascript:history.back()"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- Main Card Container --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        
        {{-- FORM INFORMASI PRIBADI --}}
        <div class="p-6 sm:p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-user-gear text-base"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Informasi Pribadi</h2>
                    <p class="text-xs text-slate-400">Perbarui nama lengkap dan alamat email terdaftar Anda.</p>
                </div>
            </div>

            <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    {{-- Input Nama --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Nama Lengkap
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-user text-xs"></i>
                            </span>
                            <input type="text" name="name"
                                value="{{ old('name', auth()->user()->name) }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Input Email --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-envelope text-xs"></i>
                            </span>
                            <input type="email" name="email"
                                value="{{ old('email', auth()->user()->email) }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="nama@email.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- Tombol Simpan Profil --}}
                <div class="flex justify-end pt-2">
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>

        {{-- KEAMANAN AKUN (ACCORDION) --}}
        <div x-data="{ open: {{ $errors->has('current_password') || $errors->has('password') || session('success_password') ? 'true' : 'false' }} }"
            class="border-t border-slate-100">
            
            {{-- Accordion Header Toggle --}}
            <button type="button" @click="open = !open"
                class="w-full px-6 sm:px-8 py-5 flex items-center justify-between bg-slate-50/50 hover:bg-slate-100/60 transition-colors duration-150 group">
                <div class="flex items-center gap-3.5">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-shield-halved text-base"></i>
                    </div>
                    <div class="text-left">
                        <h2 class="text-sm font-bold text-slate-800 group-hover:text-sky-600 transition-colors">
                            Keamanan Akun
                        </h2>
                        <p class="text-xs text-slate-400">Ganti kata sandi berkala untuk menjaga keamanan akun Anda.</p>
                    </div>
                </div>

                <div class="w-8 h-8 rounded-lg bg-white border border-slate-200 flex items-center justify-center text-slate-400 group-hover:border-slate-300 transition-all">
                    <i class="fa-solid text-xs transition-transform duration-200"
                        :class="open ? 'fa-chevron-up text-sky-600' : 'fa-chevron-down'"></i>
                </div>
            </button>

            {{-- Accordion Content Body --}}
            <div x-show="open" x-transition x-cloak class="p-6 sm:p-8 bg-white border-t border-slate-100">
                
                {{-- Alert Flash Password Success --}}
                @if(session('success_password'))
                    <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200/80 text-emerald-700 px-4 py-3 text-xs font-semibold flex items-center gap-2.5">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-sm"></i>
                        <span>{{ session('success_password') }}</span>
                    </div>
                @endif

                <form action="{{ route('profile.password.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        
                        {{-- Password Lama --}}
                        <div x-data="{ show: false }" class="space-y-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                                Password Lama
                            </label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="current_password"
                                    class="w-full pl-4 pr-10 py-2.5 bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                    placeholder="••••••••">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                                    <i class="fa-solid text-xs" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Password Baru --}}
                        <div x-data="{ show: false }" class="space-y-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                                Password Baru
                            </label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password"
                                    class="w-full pl-4 pr-10 py-2.5 bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                    placeholder="••••••••">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                                    <i class="fa-solid text-xs" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div x-data="{ show: false }" class="space-y-2">
                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="password_confirmation"
                                    class="w-full pl-4 pr-10 py-2.5 bg-slate-50/50 border border-slate-200 focus:bg-white focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                    placeholder="••••••••">
                                <button type="button" @click="show = !show"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600">
                                    <i class="fa-solid text-xs" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    {{-- Tombol Simpan Password --}}
                    <div class="flex justify-end pt-2">
                        <button type="submit"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-sky-600 hover:bg-sky-700 active:bg-sky-800 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                            <i class="fa-solid fa-key text-xs"></i>
                            <span>Simpan Password</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection