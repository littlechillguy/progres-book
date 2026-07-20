@extends('layouts.app')

@section('title', 'Edit Uraian')

@section('content')

    <div class="max-w-5xl mx-auto px-6 py-6">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-8">

            <div>

                <h1 class="text-3xl font-bold text-slate-800">
                    Edit Uraian
                </h1>

                <p class="text-slate-500 mt-2">
                    {{ $pelatihan->nama_pelatihan }}
                </p>

            </div>

            <a href="{{ route('pelatihans.show', $pelatihan) }}"
                class="bg-slate-200 hover:bg-slate-300 px-5 py-3 rounded-xl transition">

                <i class="fa-solid fa-arrow-left mr-2"></i>
                Kembali

            </a>

        </div>

        <div class="bg-white rounded-2xl shadow p-8">

            <form action="{{ route('uraians.update', [$pelatihan, $uraian]) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- PIC --}}
                    <div>

                        <label class="font-semibold">
                            PIC
                        </label>

                        <input type="text" name="pic" value="{{ old('pic', $uraian->pic) }}"
                            class="w-full mt-2 rounded-lg border-slate-300" required>

                    </div>

                    {{-- Tanggal --}}
                    <div>

                        <label class="font-semibold">
                            Tanggal
                        </label>

                        <input type="date" name="tanggal" value="{{ old('tanggal', $uraian->tanggal) }}"
                            class="w-full mt-2 rounded-lg border-slate-300" required>

                    </div>

                    {{-- Progress --}}
                    <div>

                        <label class="font-semibold">
                            Progress
                        </label>

                        <select id="progres" name="progres" class="w-full mt-2 rounded-lg border-slate-300">

                            <option value="belum" {{ old('progres', $uraian->progres) == 'belum' ? 'selected' : '' }}>
                                Belum
                            </option>

                            <option value="on progress" {{ old('progres', $uraian->progres) == 'on progress' ? 'selected' : '' }}>
                                On Progress
                            </option>

                            <option value="selesai" {{ old('progres', $uraian->progres) == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>

                    </div>

                    <div id="tanggalSelesaiGroup"
                        class="{{ old('progres', $uraian->progres) == 'selesai' ? '' : 'hidden' }}">

                        <label class="font-semibold">
                            Tanggal Selesai
                        </label>

                        <input type="date" name="tanggal_selesai"
                            value="{{ old('tanggal_selesai', $uraian->tanggal_selesai) }}"
                            class="w-full mt-2 rounded-lg border-slate-300">

                    </div>

                    {{-- Uraian --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Uraian Kegiatan
                        </label>

                        <textarea name="uraian_kegiatan" rows="4" class="w-full mt-2 rounded-lg border-slate-300"
                            required>{{ old('uraian_kegiatan', $uraian->uraian_kegiatan) }}</textarea>

                    </div>

                    {{-- Lampiran Lama --}}
                    @if($uraian->lampiran)

                        <div class="md:col-span-2">

                            <label class="font-semibold">
                                Lampiran Saat Ini
                            </label>

                            <div class="mt-3 flex items-center justify-between border rounded-xl p-4 bg-slate-50">

                                <div class="flex items-center gap-3">

                                    <i class="fa-solid {{ $uraian->fileIcon() }} text-3xl text-indigo-600"></i>

                                    <div>

                                        <p class="font-semibold">
                                            {{ $uraian->lampiran_nama }}
                                        </p>

                                        <p class="text-sm text-slate-500">
                                            File yang sedang digunakan
                                        </p>

                                    </div>

                                </div>

                                <a href="{{ route('uraians.show', $uraian) }}"
                                    class="text-indigo-600 hover:text-indigo-800 font-semibold">

                                    <i class="fa-solid fa-eye mr-1"></i>
                                    Lihat File

                                </a>

                            </div>

                        </div>

                    @endif

                    {{-- Upload Baru --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Ganti Lampiran (Opsional)
                        </label>

                        <div class="mt-2 border-2 border-dashed border-slate-300 rounded-xl p-8 text-center">

                            <i class="fa-solid fa-cloud-arrow-up text-4xl text-indigo-600 mb-3"></i>

                            <p class="font-semibold">
                                Upload File Baru
                            </p>

                            <p class="text-sm text-slate-500 mb-5">
                                Kosongkan jika tidak ingin mengganti lampiran.
                            </p>

                            <input type="file" name="lampiran"
                                accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx,.ppt,.pptx" class="block w-full text-sm">

                        </div>

                        @error('lampiran')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Keterangan --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Keterangan
                        </label>

                        <textarea name="keterangan" rows="3"
                            class="w-full mt-2 rounded-lg border-slate-300">{{ old('keterangan', $uraian->keterangan) }}</textarea>

                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-3">

                    <a href="{{ route('pelatihans.show', $pelatihan) }}"
                        class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                        Batal

                    </a>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                        <i class="fa-solid fa-save mr-2"></i>
                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const progres = document.getElementById('progres');
            const tanggal = document.getElementById('tanggalSelesaiGroup');
            const inputTanggal = document.querySelector('[name="tanggal_selesai"]');

            function toggleTanggal() {

                if (progres.value === 'selesai') {

                    tanggal.classList.remove('hidden');

                } else {

                    tanggal.classList.add('hidden');
                    inputTanggal.value = '';

                }

            }

            toggleTanggal();

            progres.addEventListener('change', toggleTanggal);

        });

    </script>

@endsection