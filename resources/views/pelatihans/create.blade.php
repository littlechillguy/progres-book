@extends('layouts.app')

@section('title', 'Tambah Pelatihan')

@section('content')
<div class="p-6 space-y-6 max-w-4xl mx-auto">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block"></span>
                Tambah Pelatihan
            </h1>
            <p class="text-xs text-slate-400 font-medium mt-1">
                Tambahkan data pelatihan baru ke dalam sistem SIMPRO.
            </p>
        </div>

        <div>
            <a href="{{ route('pelatihans.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- Main Card Container --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        
        <div class="p-6 sm:p-8">
            {{-- Card Sub-header --}}
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-graduation-cap text-base"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Formulir Pelatihan</h2>
                    <p class="text-xs text-slate-400">Isi detail data kegiatan pelatihan yang akan dilaksanakan.</p>
                </div>
            </div>

            <form action="{{ route('pelatihans.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama Pelatihan (Full width) --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Nama Pelatihan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-book-open text-xs"></i>
                            </span>
                            <input type="text" name="nama_pelatihan" value="{{ old('nama_pelatihan') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('nama_pelatihan') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="Masukkan nama pelatihan">
                        </div>
                        @error('nama_pelatihan')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tahapan --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Tahapan
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-layer-group text-xs"></i>
                            </span>
                            <select name="tahapan"
                                class="w-full pl-10 pr-8 py-2.5 bg-slate-50/50 border @error('tahapan') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150 appearance-none">
                                <option value="">-- Pilih Tahapan --</option>
                                <option value="Persiapan" @selected(old('tahapan') == 'Persiapan')>Persiapan</option>
                                <option value="Pelaksanaan" @selected(old('tahapan') == 'Pelaksanaan')>Pelaksanaan</option>
                                <option value="Evaluasi" @selected(old('tahapan') == 'Evaluasi')>Evaluasi</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </span>
                        </div>
                        @error('tahapan')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Hari --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Hari
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-calendar-day text-xs"></i>
                            </span>
                            <input type="text" name="hari" value="{{ old('hari') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('hari') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="Contoh: Senin - Rabu">
                        </div>
                        @error('hari')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Kegiatan (Full width) --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Kegiatan
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-list-check text-xs"></i>
                            </span>
                            <input type="text" name="kegiatan" value="{{ old('kegiatan') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('kegiatan') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="Rincian kegiatan singkat">
                        </div>
                        @error('kegiatan')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Tanggal Pelaksanaan
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-calendar text-xs"></i>
                            </span>
                            <input type="date" name="tanggal" value="{{ old('tanggal') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('tanggal') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150">
                        </div>
                        @error('tanggal')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tempat --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Tempat / Lokasi
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-location-dot text-xs"></i>
                            </span>
                            <input type="text" name="tempat" value="{{ old('tempat') }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('tempat') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="Lokasi pelaksanaan">
                        </div>
                        @error('tempat')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('pelatihans.index') }}"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-xl transition duration-150">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-xs font-semibold rounded-xl shadow-sm transition duration-150">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Pelatihan</span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>
@endsection