@extends('layouts.app')

@section('title', 'Edit Uraian')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Uraian
            </h1>

            <p class="text-slate-500 mt-2">
                {{ $pelatihan->nama_pelatihan }}
            </p>

        </div>

        <a href="{{ route('pelatihans.show',$pelatihan) }}"
            class="bg-slate-200 hover:bg-slate-300 px-5 py-3 rounded-xl">

            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow p-8">

        <form
            action="{{ route('uraians.update',[$pelatihan,$uraian]) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">

                {{-- PIC --}}
                <div>

                    <label class="font-semibold">
                        PIC
                    </label>

                    <input
                        type="text"
                        name="pic"
                        value="{{ old('pic',$uraian->pic) }}"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>

                    @error('pic')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Tanggal --}}
                <div>

                    <label class="font-semibold">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal',$uraian->tanggal) }}"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>

                    @error('tanggal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Tahapan --}}
                <div>

                    <label class="font-semibold">
                        Tahapan
                    </label>

                    <select
                        name="tahapan"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>

                        <option value="Persiapan"
                            {{ old('tahapan',$uraian->tahapan)=='Persiapan' ? 'selected' : '' }}>
                            Persiapan
                        </option>

                        <option value="Pelaksanaan"
                            {{ old('tahapan',$uraian->tahapan)=='Pelaksanaan' ? 'selected' : '' }}>
                            Pelaksanaan
                        </option>

                        <option value="Evaluasi"
                            {{ old('tahapan',$uraian->tahapan)=='Evaluasi' ? 'selected' : '' }}>
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

                    <select
                        id="progres"
                        name="progres"
                        class="w-full mt-2 rounded-lg border-slate-300">

                        <option value="belum"
                            {{ old('progres',$uraian->progres)=='belum' ? 'selected' : '' }}>
                            Belum
                        </option>

                        <option value="on progress"
                            {{ old('progres',$uraian->progres)=='on progress' ? 'selected' : '' }}>
                            On Progress
                        </option>

                        <option value="selesai"
                            {{ old('progres',$uraian->progres)=='selesai' ? 'selected' : '' }}>
                            Selesai
                        </option>

                    </select>

                    @error('progres')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Tanggal Selesai --}}
                <div
                    id="tanggalSelesaiGroup"
                    class="md:col-span-2 {{ old('progres',$uraian->progres)=='selesai' ? '' : 'hidden' }}">

                    <label class="font-semibold">
                        Tanggal Selesai
                    </label>

                    <input
                        type="date"
                        name="tanggal_selesai"
                        value="{{ old('tanggal_selesai',$uraian->tanggal_selesai) }}"
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

                    <textarea
                        name="uraian_kegiatan"
                        rows="4"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>{{ old('uraian_kegiatan',$uraian->uraian_kegiatan) }}</textarea>

                    @error('uraian_kegiatan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                {{-- Lampiran Lama --}}
                @if($uraian->lampiran)

                <div class="md:col-span-2">

                    <label class="font-semibold">
                        Lampiran Saat Ini
                    </label>

                    <div class="mt-3 border rounded-xl p-4 flex justify-between items-center bg-slate-50">

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

                        <a
                            href="{{ route('uraians.show',$uraian) }}"
                            class="text-indigo-600 hover:text-indigo-800">

                            <i class="fa-solid fa-eye mr-1"></i>
                            Lihat

                        </a>

                    </div>

                </div>

                @endif

                {{-- Upload Baru --}}
                <div class="md:col-span-2">

                    <label class="font-semibold">
                        Ganti Lampiran
                    </label>

                    <div class="mt-2 border-2 border-dashed border-slate-300 rounded-xl p-8 text-center">

                        <i class="fa-solid fa-cloud-arrow-up text-4xl text-indigo-600 mb-4"></i>

                        <p class="font-semibold">
                            Upload Lampiran Baru
                        </p>

                        <p class="text-sm text-slate-500 mb-5">
                            Kosongkan jika tidak ingin mengganti file.
                        </p>

                        <input
                            type="file"
                            name="lampiran"
                            class="block w-full text-sm">

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

                    <textarea
                        name="keterangan"
                        rows="3"
                        class="w-full mt-2 rounded-lg border-slate-300">{{ old('keterangan',$uraian->keterangan) }}</textarea>

                    @error('keterangan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a
                    href="{{ route('pelatihans.show',$pelatihan) }}"
                    class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

                    Batal

                </a>

                <button
                    type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                    <i class="fa-solid fa-save mr-2"></i>
                    Simpan Perubahan

                </button>

            </div>

        </form>

    </div>

</div>

<script>

document.addEventListener('DOMContentLoaded',function(){

    const progres=document.getElementById('progres');
    const group=document.getElementById('tanggalSelesaiGroup');
    const tanggal=document.querySelector('[name="tanggal_selesai"]');

    function toggleTanggal(){

        if(progres.value==='selesai'){

            group.classList.remove('hidden');

        }else{

            group.classList.add('hidden');
            tanggal.value='';

        }

    }

    toggleTanggal();

    progres.addEventListener('change',toggleTanggal);

});

</script>

@endsection