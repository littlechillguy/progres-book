@extends('layouts.app')

@section('title', 'Tambah Pelatihan')

@section('content')

<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Tambah Pelatihan
            </h1>

            <p class="text-slate-500 mt-1">
                Tambahkan data pelatihan baru ke dalam sistem.
            </p>
        </div>

        <a href="{{ route('pelatihans.index') }}"
            class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-3 rounded-xl font-semibold transition">

            <i class="fa-solid fa-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow border border-slate-200">

        <form action="{{ route('pelatihans.store') }}"
            method="POST"
            class="p-8">

            @csrf

            <div class="grid md:grid-cols-2 gap-6">

                {{-- Nama Pelatihan --}}
                <div class="md:col-span-2">

                    <label class="block mb-2 font-semibold text-slate-700">
                        Nama Pelatihan
                    </label>

                    <input
                        type="text"
                        name="nama_pelatihan"
                        value="{{ old('nama_pelatihan') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none @error('nama_pelatihan') border-red-500 @enderror">

                    @error('nama_pelatihan')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Tahapan --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Tahapan
                    </label>

                    <select
                        name="tahapan"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500">

                        <option value="">Pilih Tahapan</option>

                        <option value="Persiapan" @selected(old('tahapan')=='Persiapan')>
                            Persiapan
                        </option>

                        <option value="Pelaksanaan" @selected(old('tahapan')=='Pelaksanaan')>
                            Pelaksanaan
                        </option>

                        <option value="Evaluasi" @selected(old('tahapan')=='Evaluasi')>
                            Evaluasi
                        </option>

                    </select>

                    @error('tahapan')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Hari --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Hari
                    </label>

                    <input
                        type="text"
                        name="hari"
                        value="{{ old('hari') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500">

                    @error('hari')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Kegiatan --}}
                <div class="md:col-span-2">

                    <label class="block mb-2 font-semibold text-slate-700">
                        Kegiatan
                    </label>

                    <input
                        type="text"
                        name="kegiatan"
                        value="{{ old('kegiatan') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500">

                    @error('kegiatan')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Tanggal --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500">

                    @error('tanggal')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Tempat --}}
                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Tempat
                    </label>

                    <input
                        type="text"
                        name="tempat"
                        value="{{ old('tempat') }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500">

                    @error('tempat')
                        <p class="text-red-500 text-sm mt-2">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            <div class="flex justify-end gap-3 mt-10">

                <a href="{{ route('pelatihans.index') }}"
                    class="px-6 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 font-semibold">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">

                    <i class="fa-solid fa-floppy-disk mr-2"></i>

                    Simpan Pelatihan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection