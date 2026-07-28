@extends('layouts.app')

@section('content')

<div class="p-6">

    <div class="bg-white rounded-xl shadow p-6">

        <h1 class="text-2xl font-bold text-gray-800">
            👤 Profil Saya
        </h1>

        <div class="mt-6 space-y-4">

            <div>
                <p class="text-sm text-gray-500">Nama</p>
                <p class="font-semibold">{{ Auth::user()->name }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Email</p>
                <p class="font-semibold">{{ Auth::user()->email }}</p>
            </div>

            <div>
                <p class="text-sm text-gray-500">Role</p>
                <p class="font-semibold">
                    {{ ucfirst(Auth::user()->role ?? '-') }}
                </p>
            </div>

        </div>

        <div class="mt-8">

            <a href="{{ route('profile.edit') }}"
                class="inline-flex items-center px-5 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-lg transition">

                <i class="fa-solid fa-user-pen mr-2"></i>

                Edit Profil

            </a>

        </div>

    </div>

</div>

@endsection