@extends('layouts.app')

@section('title', 'Edit Pelatihan')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Pelatihan
            </h1>

            <p class="text-slate-500 mt-1">
                Perbarui informasi pelatihan.
            </p>

        </div>

        <a href="{{ route('pelatihans.index') }}"
            class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-3 rounded-xl">

            <i class="fa-solid fa-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow border border-slate-200 p-8">

        <form action="{{ route('pelatihans.update', $pelatihan) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="block mb-2 font-semibold">
                        Nama Pelatihan
                    </label>

                    <input
                        type="text"
                        name="nama_pelatihan"
                        value="{{ old('nama_pelatihan', $pelatihan->nama_pelatihan) }}"
                        class="w-full border rounded-xl px-4 py-3">

                    @error('nama_pelatihan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Tahapan
                    </label>

                    <select
                        name="tahapan"
                        class="w-full border rounded-xl px-4 py-3">

                        <option value="Persiapan"
                            {{ old('tahapan', $pelatihan->tahapan) == 'Persiapan' ? 'selected' : '' }}>
                            Persiapan
                        </option>

                        <option value="Pelaksanaan"
                            {{ old('tahapan', $pelatihan->tahapan) == 'Pelaksanaan' ? 'selected' : '' }}>
                            Pelaksanaan
                        </option>

                        <option value="Evaluasi"
                            {{ old('tahapan', $pelatihan->tahapan) == 'Evaluasi' ? 'selected' : '' }}>
                            Evaluasi
                        </option>

                    </select>

                </div>

                <div class="md:col-span-2">

                    <label class="block mb-2 font-semibold">
                        Kegiatan
                    </label>

                    <input
                        type="text"
                        name="kegiatan"
                        value="{{ old('kegiatan', $pelatihan->kegiatan) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Hari
                    </label>

                    <input
                        type="text"
                        name="hari"
                        value="{{ old('hari', $pelatihan->hari) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal', $pelatihan->tanggal) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                <div class="md:col-span-2">

                    <label class="block mb-2 font-semibold">
                        Tempat
                    </label>

                    <input
                        type="text"
                        name="tempat"
                        value="{{ old('tempat', $pelatihan->tempat) }}"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

            </div>

            <div class="flex justify-end gap-3 mt-8">

                <a href="{{ route('pelatihans.index') }}"
                    class="px-6 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                    Batal

                </a>

                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold">

                    <i class="fa-solid fa-floppy-disk mr-2"></i>

                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection