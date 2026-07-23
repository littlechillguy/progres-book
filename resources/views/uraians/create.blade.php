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

            <form action="{{ route('uraians.store', $pelatihan) }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="grid md:grid-cols-2 gap-6">

                    {{-- PIC --}}
                    <div>

                        <label class="font-semibold">
                            PIC
                        </label>

                        <input type="text" name="pic" value="{{ old('pic') }}"
                            class="w-full mt-2 rounded-lg border-slate-300" required>

                        @error('pic')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Tanggal --}}
                    <div>

                        <label class="font-semibold">
                            Tanggal
                        </label>

                        <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                            class="w-full mt-2 rounded-lg border-slate-300" required>

                        @error('tanggal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Tahapan --}}
                    <div>

                        <label class="font-semibold">
                            Tahapan
                        </label>

                        <select name="tahapan" class="w-full mt-2 rounded-lg border-slate-300" required>

                            <option value="">Pilih Tahapan</option>

                            <option value="Persiapan" {{ old('tahapan') == 'Persiapan' ? 'selected' : '' }}>
                                Persiapan
                            </option>

                            <option value="Pelaksanaan" {{ old('tahapan') == 'Pelaksanaan' ? 'selected' : '' }}>
                                Pelaksanaan
                            </option>

                            <option value="Evaluasi" {{ old('tahapan') == 'Evaluasi' ? 'selected' : '' }}>
                                Evaluasi
                            </option>

                        </select>

                        @error('tahapan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Progress --}}
                    <div>

                        <label class="font-semibold">
                            Progress
                        </label>

                        <select id="progres" name="progres" class="w-full mt-2 rounded-lg border-slate-300">

                            <option value="belum" {{ old('progres') == 'belum' ? 'selected' : '' }}>
                                Belum
                            </option>

                            <option value="on progress" {{ old('progres') == 'on progress' ? 'selected' : '' }}>
                                On Progress
                            </option>

                            <option value="selesai" {{ old('progres') == 'selesai' ? 'selected' : '' }}>
                                Selesai
                            </option>

                        </select>

                        @error('progres')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Tanggal Selesai --}}
                    <div id="tanggalSelesaiGroup" class="md:col-span-2 {{ old('progres') == 'selesai' ? '' : 'hidden' }}">

                        <label class="font-semibold">
                            Tanggal Selesai
                        </label>

                        <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full mt-2 rounded-lg border-slate-300">

                        @error('tanggal_selesai')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Uraian --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Uraian Kegiatan
                        </label>

                        <textarea name="uraian_kegiatan" rows="4" class="w-full mt-2 rounded-lg border-slate-300"
                            required>{{ old('uraian_kegiatan') }}</textarea>

                        @error('uraian_kegiatan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    {{-- Lampiran --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Lampiran (Opsional)
                        </label>

                        <div
                            class="mt-2 border-2 border-dashed border-slate-300 rounded-xl p-8 text-center hover:border-indigo-500 transition">

                            <i class="fa-solid fa-cloud-arrow-up text-5xl text-indigo-600 mb-4"></i>

                            <p class="font-semibold text-slate-700">
                                Klik atau pilih file untuk diupload
                            </p>

                            <p class="text-sm text-slate-500 mt-2">
                                PDF, Word, Excel, PPT, JPG, JPEG, PNG
                            </p>

                            <p class="text-xs text-slate-400 mt-2 mb-5">
                                Maksimal 10 MB
                            </p>

                            <input type="file" name="lampiran" class="block w-full text-sm
                                file:mr-4
                                file:py-2
                                file:px-4
                                file:rounded-lg
                                file:border-0
                                file:bg-indigo-600
                                file:text-white
                                hover:file:bg-indigo-700">

                        </div>

                        @error('lampiran')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror

                    </div>


                    {{-- Keterangan --}}
                    <div class="md:col-span-2">

                        <label class="font-semibold">
                            Keterangan
                        </label>

                        <textarea name="keterangan" rows="3" class="w-full mt-2 rounded-lg border-slate-300"
                            placeholder="Tambahkan catatan...">{{ old('keterangan') }}</textarea>

                        @error('keterangan')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-3">

                    <a href="{{ route('pelatihans.show', $pelatihan) }}"
                        class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                        Batal

                    </a>

                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                        <i class="fa-solid fa-save mr-2"></i>

                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const progres = document.getElementById('progres');
            const tanggal = document.getElementById('tanggalSelesaiGroup');

            function toggleTanggal() {

                if (progres.value === 'selesai') {

                    tanggal.classList.remove('hidden');

                } else {

                    tanggal.classList.add('hidden');

                    document.querySelector('[name="tanggal_selesai"]').value = '';

                }

            }

            toggleTanggal();

            progres.addEventListener('change', toggleTanggal);

        });

    </script>

@endsection