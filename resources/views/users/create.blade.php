@extends('layouts.app')

@section('title','Tambah Admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-8">

        <h1 class="text-3xl font-bold mb-8">

            Tambah Admin

        </h1>

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            <div class="space-y-6">

                <div>

                    <label class="font-semibold">

                        Nama

                    </label>

                    <input
                        type="text"
                        name="name"
                        class="w-full mt-2 rounded-xl border-slate-300"
                        required>

                </div>

                <div>

                    <label class="font-semibold">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        class="w-full mt-2 rounded-xl border-slate-300"
                        required>

                </div>

                <div>

                    <label class="font-semibold">

                        Role

                    </label>

                    <select
                        name="role"
                        class="w-full mt-2 rounded-xl border-slate-300">

                        <option value="admin">
                            Admin
                        </option>

                        <option value="superadmin">
                            Super Admin
                        </option>

                    </select>

                </div>

                <div>

                    <label class="font-semibold">

                        Password

                    </label>

                    <input
                        type="password"
                        name="password"
                        class="w-full mt-2 rounded-xl border-slate-300"
                        required>

                </div>

                <div>

                    <label class="font-semibold">

                        Konfirmasi Password

                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="w-full mt-2 rounded-xl border-slate-300"
                        required>

                </div>

            </div>

            <div class="flex justify-end mt-8">

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection