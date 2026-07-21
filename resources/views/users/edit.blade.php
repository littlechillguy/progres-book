@extends('layouts.app')

@section('title','Edit User')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-2xl shadow p-8">

        <h1 class="text-3xl font-bold mb-8">

            Edit User

        </h1>

        <form action="{{ route('users.update',$user) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-6">

                <div>

                    <label class="font-semibold">

                        Nama

                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name',$user->name) }}"
                        class="w-full mt-2 rounded-xl border-slate-300">

                </div>

                <div>

                    <label class="font-semibold">

                        Email

                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email',$user->email) }}"
                        class="w-full mt-2 rounded-xl border-slate-300">

                </div>

                <div>

                    <label class="font-semibold">

                        Role

                    </label>

                    <select
                        name="role"
                        class="w-full mt-2 rounded-xl border-slate-300">

                        <option value="admin"
                            {{ $user->role=='admin'?'selected':'' }}>
                            Admin
                        </option>

                        <option value="superadmin"
                            {{ $user->role=='superadmin'?'selected':'' }}>
                            Super Admin
                        </option>

                    </select>

                </div>

            </div>

            <div class="flex justify-end mt-8">

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection