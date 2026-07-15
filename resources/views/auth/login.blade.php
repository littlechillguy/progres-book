@extends('layouts.guest')

@section('title', 'Login Admin')

@section('content')

<div class="min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">

            <div class="mx-auto w-20 h-20 rounded-2xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/30">

                <i class="fa-solid fa-graduation-cap text-4xl text-white"></i>

            </div>

            <h1 class="mt-5 text-3xl font-bold text-slate-800">
                PRO-BOOK
            </h1>

            <p class="text-slate-500 mt-1">
                Dashboard Monitoring Progress Pelatihan
            </p>

            <p class="text-xs uppercase tracking-[0.2em] text-slate-400 mt-2">
                Kementerian HAM
            </p>

        </div>

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8">

            <h2 class="text-xl font-bold text-slate-800 mb-1">
                Login Administrator
            </h2>

            <p class="text-sm text-slate-500 mb-6">
                Masukkan email dan password administrator.
            </p>

            @if(session('status'))
                <div class="mb-5 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">

                @csrf

                {{-- Email --}}
                <div class="mb-5">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="admin@email.com">

                    @error('email')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Password --}}
                <div class="mb-5">

                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-indigo-500 focus:ring-indigo-500"
                        placeholder="********">

                    @error('password')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Remember --}}
                <div class="flex items-center justify-between mb-6">

                    <label class="flex items-center gap-2">

                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-slate-300 text-indigo-600">

                        <span class="text-sm text-slate-600">
                            Ingat Saya
                        </span>

                    </label>

                </div>

                {{-- Button --}}
                <button
                    type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 transition text-white font-semibold py-3 rounded-xl">

                    <i class="fa-solid fa-right-to-bracket mr-2"></i>

                    Login

                </button>

            </form>

            {{-- Back --}}
            <div class="mt-6 text-center">

                <a href="{{ route('dashboard') }}"
                    class="text-sm text-slate-500 hover:text-indigo-600">

                    <i class="fa-solid fa-arrow-left mr-1"></i>

                    Kembali ke Dashboard

                </a>

            </div>

        </div>

        <p class="text-center text-xs text-slate-400 mt-6">
            © {{ date('Y') }} PRO-BOOK • Sistem Monitoring Progress Pelatihan
        </p>

    </div>

</div>

@endsection