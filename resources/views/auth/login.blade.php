@extends('layouts.guest')

@section('title', 'Login Admin - SIMPRO')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-slate-50 via-indigo-50/20 to-slate-100 p-4 relative overflow-hidden">
    
    {{-- Ambient Glow Decorative Effects --}}
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-indigo-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">

        {{-- Header / Brand Logo --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-500/30 ring-4 ring-indigo-50 mb-4 transition-transform hover:scale-105 duration-300">
                <i class="fa-solid fa-graduation-cap text-3xl"></i>
            </div>

            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                SIMPRO
            </h1>

            <p class="text-sm font-medium text-slate-500 mt-1">
                Dashboard Monitoring Progress Pelatihan
            </p>

            <div class="mt-2.5 inline-block">
                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-widest bg-slate-200/60 text-slate-600 border border-slate-300/50">
                    Kementerian HAM
                </span>
            </div>
        </div>

        {{-- Login Card --}}
        <div class="bg-white/90 backdrop-blur-xl rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200/80 p-8 sm:p-10 transition-all">

            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-800">
                    Login Administrator
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Masukkan email dan password terdaftar untuk melanjutkan.
                </p>
            </div>

            {{-- Alert Status --}}
            @if(session('status'))
                <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-2xl text-xs font-medium">
                    <i class="fa-solid fa-circle-check text-emerald-500 text-base shrink-0"></i>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- Email Input --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Email
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-envelope text-sm"></i>
                        </div>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('email') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl text-sm text-slate-800 placeholder-slate-400 transition-all focus:outline-none focus:ring-4 focus:bg-white"
                            placeholder="admin@email.com">
                    </div>

                    @error('email')
                        <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">
                        Password
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-lock text-sm"></i>
                        </div>

                        <input
                            id="password-input"
                            type="password"
                            name="password"
                            required
                            class="w-full pl-10 pr-10 py-2.5 bg-slate-50/50 border @error('password') border-rose-500 focus:ring-rose-500/20 focus:border-rose-500 @else border-slate-200 focus:ring-indigo-500/20 focus:border-indigo-600 @enderror rounded-xl text-sm text-slate-800 placeholder-slate-400 transition-all focus:outline-none focus:ring-4 focus:bg-white"
                            placeholder="••••••••">

                        {{-- Toggle Show/Hide Password Button --}}
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility()" 
                            class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors focus:outline-none">
                            <i id="toggle-icon" class="fa-solid fa-eye text-sm"></i>
                        </button>
                    </div>

                    @error('password')
                        <p class="text-rose-500 text-xs mt-1.5 flex items-center gap-1 font-medium">
                            <i class="fa-solid fa-circle-exclamation text-[11px]"></i>
                            <span>{{ $message }}</span>
                        </p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between pt-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/30 transition">

                        <span class="text-xs font-medium text-slate-600 group-hover:text-slate-800 transition">
                            Ingat Saya
                        </span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 active:scale-[0.98] transition-all duration-200 text-white text-sm font-semibold py-3 rounded-xl shadow-lg shadow-indigo-600/25 flex items-center justify-center gap-2 mt-2">
                    <i class="fa-solid fa-right-to-bracket text-xs"></i>
                    <span>Login Administrator</span>
                </button>

            </form>

            {{-- Back Link --}}
            <div class="mt-6 pt-6 border-t border-slate-100 text-center">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors group">
                    <i class="fa-solid fa-arrow-left transition-transform group-hover:-translate-x-1"></i>
                    <span>Kembali ke Dashboard</span>
                </a>
            </div>

        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-slate-400 mt-8 font-medium">
            © {{ date('Y') }} <span class="font-bold text-slate-500">SIMPRO</span> • Kementerian HAM
        </p>

    </div>

</div>

{{-- Script Toggle Password Visibility --}}
<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('password-input');
        const icon = document.getElementById('toggle-icon');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection