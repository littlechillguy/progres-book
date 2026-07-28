@extends('layouts.app')

@section('content')

<div class="py-8">

    <div class="max-w-3xl mx-auto">

        <div class="bg-white rounded-xl shadow">

            <div class="px-6 py-5 border-b">

                <h2 class="text-2xl font-bold text-gray-800">
                    Edit Profil
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Kelola informasi akun administrator.
                </p>

            </div>

            {{-- FORM PROFIL --}}
            <div class="p-6">

                <form
                    action="{{ route('profile.update') }}"
                    method="POST">

                    @csrf
                    @method('PUT')

                    <div class="space-y-5">

                        <div>

                            <label class="block mb-2 font-medium">

                                Nama

                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', auth()->user()->name) }}"
                                class="w-full rounded-lg border-gray-300 focus:border-sky-500 focus:ring-sky-500">

                            @error('name')

                                <p class="text-red-500 text-sm mt-1">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                        <div>

                            <label class="block mb-2 font-medium">

                                Email

                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', auth()->user()->email) }}"
                                class="w-full rounded-lg border-gray-300 focus:border-sky-500 focus:ring-sky-500">

                            @error('email')

                                <p class="text-red-500 text-sm mt-1">

                                    {{ $message }}

                                </p>

                            @enderror

                        </div>

                    </div>

                    <div class="mt-6">

                        <button
                            class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-2 rounded-lg">

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

            {{-- KEAMANAN AKUN --}}
            <div
                x-data="{ open:false }"
                class="border-t">

                <button
                    type="button"
                    @click="open=!open"
                    class="w-full px-6 py-5 flex items-center justify-between hover:bg-gray-50">

                    <span class="font-semibold text-gray-700">

                        <i class="fa-solid fa-lock mr-2"></i>

                        Keamanan Akun

                    </span>

                    <i
                        class="fa-solid"
                        :class="open ? 'fa-chevron-up' : 'fa-chevron-down'"></i>

                </button>

                <div
                    x-show="open"
                    x-transition
                    class="px-6 pb-6">

                    {{-- FORM PASSWORD DISINI --}}

                    <form
    action="{{ route('profile.password.update') }}"
    method="POST">

    @csrf
    @method('PUT')

    <div class="space-y-5">

    @if(session('success_password'))

    <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">

        {{ session('success_password') }}

    </div>

@endif

        {{-- Password Lama --}}

        <div x-data="{show:false}" class="relative">

            <label class="block mb-2 font-medium">

                Password Lama

            </label>

            <input
                :type="show ? 'text' : 'password'"
                name="current_password"
                class="w-full rounded-lg border-gray-300 pr-12 focus:border-sky-500 focus:ring-sky-500">

            <button
                type="button"
                @click="show=!show"
                class="absolute right-4 top-11 text-gray-500">

                <i
                    class="fa-solid"
                    :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>

            </button>

            @error('current_password')

                <p class="text-red-500 text-sm mt-1">

                    {{ $message }}

                </p>

            @enderror

        </div>

        {{-- Password Baru --}}

        <div x-data="{show:false}" class="relative">

            <label class="block mb-2 font-medium">

                Password Baru

            </label>

            <input
                :type="show ? 'text' : 'password'"
                name="password"
                class="w-full rounded-lg border-gray-300 pr-12 focus:border-sky-500 focus:ring-sky-500">

            <button
                type="button"
                @click="show=!show"
                class="absolute right-4 top-11 text-gray-500">

                <i
                    class="fa-solid"
                    :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>

            </button>

            @error('password')

                <p class="text-red-500 text-sm mt-1">

                    {{ $message }}

                </p>

            @enderror

        </div>

        {{-- Konfirmasi --}}

        <div x-data="{show:false}" class="relative">

            <label class="block mb-2 font-medium">

                Konfirmasi Password

            </label>

            <input
                :type="show ? 'text' : 'password'"
                name="password_confirmation"
                class="w-full rounded-lg border-gray-300 pr-12 focus:border-sky-500 focus:ring-sky-500">

            <button
                type="button"
                @click="show=!show"
                class="absolute right-4 top-11 text-gray-500">

                <i
                    class="fa-solid"
                    :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>

            </button>

        </div>

    </div>

    <div class="mt-6">

        <button
            class="bg-sky-600 hover:bg-sky-700 text-white px-6 py-2 rounded-lg">

            Simpan Password

        </button>

    </div>

</form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection