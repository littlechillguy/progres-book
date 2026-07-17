@extends('layouts.app')

@section('title', 'Tambah Uraian')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Tambah Uraian
            </h1>

            <p class="text-slate-500 mt-2">
                {{ $pelatihan->nama_pelatihan }}
            </p>
        </div>

        <a href="{{ route('pelatihans.show', $pelatihan) }}"
            class="bg-slate-200 hover:bg-slate-300 px-5 py-3 rounded-xl">

            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow p-8">

        <form action="{{ route('uraians.store', $pelatihan) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf

            <div class="grid md:grid-cols-2 gap-6">

                {{-- PIC --}}
                <div>

                    <label class="font-semibold">
                        PIC
                    </label>

                    <input
                        type="text"
                        name="pic"
                        value="{{ old('pic') }}"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>

                </div>

                {{-- Tanggal --}}
                <div>

                    <label class="font-semibold">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal') }}"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>

                </div>

                {{-- Progress --}}
                <div>

                    <label class="font-semibold">
                        Progress
                    </label>

                    <select
                        name="progres"
                        class="w-full mt-2 rounded-lg border-slate-300">

                        <option value="belum"
                            {{ old('progres')=='belum'?'selected':'' }}>
                            Belum
                        </option>

                        <option value="on progress"
                            {{ old('progres')=='on progress'?'selected':'' }}>
                            On Progress
                        </option>

                        <option value="selesai"
                            {{ old('progres')=='selesai'?'selected':'' }}>
                            Selesai
                        </option>

                    </select>

                </div>

                {{-- Uraian --}}
                <div class="md:col-span-2">

                    <label class="font-semibold">
                        Uraian Kegiatan
                    </label>

                    <textarea
                        name="uraian_kegiatan"
                        rows="4"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>{{ old('uraian_kegiatan') }}</textarea>

                </div>

                {{-- Lampiran --}}
                <div class="md:col-span-2">

                    <label class="font-semibold">
                        Lampiran
                    </label>

                    <div class="mt-2 border-2 border-dashed border-slate-300 rounded-xl p-8 text-center hover:border-indigo-500 transition">

                        <i class="fa-solid fa-cloud-arrow-up text-4xl text-indigo-600 mb-3"></i>

                        <p class="font-semibold text-slate-700">
                            Upload Lampiran
                        </p>

                        <p class="text-sm text-slate-500 mb-5">
                            PDF, Word, Excel, PowerPoint, JPG, JPEG, PNG
                            <br>
                            Maksimal 10 MB
                        </p>

                        <input
                            type="file"
                            name="lampiran"
                            class="block w-full text-sm">

                    </div>

                </div>

                {{-- Link --}}
                <div class="md:col-span-2">

                    <label class="font-semibold">
                        Link Referensi (Opsional)
                    </label>

                    <input
                        type="url"
                        name="link"
                        value="{{ old('link') }}"
                        placeholder="https://..."
                        class="w-full mt-2 rounded-lg border-slate-300">

                </div>

                {{-- Keterangan --}}
                <div class="md:col-span-2">

                    <label class="font-semibold">
                        Keterangan
                    </label>

                    <textarea
                        name="keterangan"
                        rows="3"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        placeholder="Tambahkan catatan...">{{ old('keterangan') }}</textarea>

                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('pelatihans.show', $pelatihan) }}"
                    class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                    Batal

                </a>

                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                    <i class="fa-solid fa-save mr-2"></i>

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection