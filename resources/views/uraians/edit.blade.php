@extends('layouts.app')

@section('title', 'Edit Uraian')

@section('content')
<div class="p-6 space-y-6 max-w-4xl mx-auto">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block"></span>
                Edit Uraian Kegiatan
            </h1>
            <p class="text-xs text-slate-400 font-medium mt-1">
                Pelatihan: <span class="text-indigo-600 font-semibold">{{ $pelatihan->nama_pelatihan }}</span>
            </p>
        </div>

        <div>
            <a href="{{ route('pelatihans.show', $pelatihan) }}"
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
                    <i class="fa-solid fa-file-pen text-base"></i>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-800">Formulir Edit Uraian</h2>
                    <p class="text-xs text-slate-400">Perbarui detail uraian kegiatan pelaksanaan pelatihan.</p>
                </div>
            </div>

            <form action="{{ route('uraians.update', [$pelatihan, $uraian]) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- PIC --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Person in Charge (PIC) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-user text-xs"></i>
                            </span>
                            <input type="text" name="pic" value="{{ old('pic', $uraian->pic) }}" required
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('pic') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="Nama penanggung jawab">
                        </div>
                        @error('pic')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tanggal --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Tanggal <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-calendar text-xs"></i>
                            </span>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $uraian->tanggal) }}" required
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('tanggal') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150">
                        </div>
                        @error('tanggal')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tahapan --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Tahapan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-layer-group text-xs"></i>
                            </span>
                            <select name="tahapan" required
                                class="w-full pl-10 pr-8 py-2.5 bg-slate-50/50 border @error('tahapan') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150 appearance-none">
                                <option value="">-- Pilih Tahapan --</option>
                                <option value="Persiapan" @selected(old('tahapan', $uraian->tahapan) == 'Persiapan')>Persiapan</option>
                                <option value="Pelaksanaan" @selected(old('tahapan', $uraian->tahapan) == 'Pelaksanaan')>Pelaksanaan</option>
                                <option value="Evaluasi" @selected(old('tahapan', $uraian->tahapan) == 'Evaluasi')>Evaluasi</option>
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

                    {{-- Progress --}}
                    <div class="space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Status Progress
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-bars-progress text-xs"></i>
                            </span>
                            <select id="progres" name="progres"
                                class="w-full pl-10 pr-8 py-2.5 bg-slate-50/50 border @error('progres') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150 appearance-none">
                                <option value="belum" @selected(old('progres', $uraian->progres) == 'belum')>Belum</option>
                                <option value="on progress" @selected(old('progres', $uraian->progres) == 'on progress')>On Progress</option>
                                <option value="selesai" @selected(old('progres', $uraian->progres) == 'selesai')>Selesai</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-chevron-down text-xs"></i>
                            </span>
                        </div>
                        @error('progres')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Tanggal Selesai (Dynamic) --}}
                    <div id="tanggalSelesaiGroup" class="md:col-span-2 space-y-2 {{ old('progres', $uraian->progres) == 'selesai' ? '' : 'hidden' }}">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Tanggal Selesai
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-calendar-check text-xs"></i>
                            </span>
                            <input type="date" name="tanggal_selesai" value="{{ old('tanggal_selesai', $uraian->tanggal_selesai) }}"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('tanggal_selesai') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150">
                        </div>
                        @error('tanggal_selesai')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Uraian Kegiatan --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Uraian Kegiatan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute top-3 left-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-align-left text-xs"></i>
                            </span>
                            <textarea name="uraian_kegiatan" rows="4" required
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('uraian_kegiatan') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="Tuliskan penjelasan detail mengenai kegiatan pelatihan...">{{ old('uraian_kegiatan', $uraian->uraian_kegiatan) }}</textarea>
                        </div>
                        @error('uraian_kegiatan')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Lampiran Saat Ini --}}
                    @if($uraian->lampiran)
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Lampiran Saat Ini
                        </label>
                        <div class="p-4 bg-slate-50/80 border border-slate-200 rounded-2xl flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3 overflow-hidden">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                                    <i class="fa-solid {{ $uraian->fileIcon() }} text-lg"></i>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-slate-800 truncate">
                                        {{ $uraian->lampiran_nama }}
                                    </p>
                                    <p class="text-[11px] text-slate-400">
                                        File terlampir aktif
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('uraians.show', $uraian) }}"
                                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white border border-slate-200 hover:bg-slate-100 text-indigo-600 text-xs font-semibold rounded-lg shadow-sm transition shrink-0">
                                <i class="fa-solid fa-eye text-xs"></i>
                                <span>Lihat</span>
                            </a>
                        </div>
                    </div>
                    @endif

                    {{-- Upload Lampiran Baru / Ganti Lampiran --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            {{ $uraian->lampiran ? 'Ganti Lampiran' : 'Unggah Lampiran (Opsional)' }}
                        </label>
                        <div class="border-2 border-dashed border-slate-200 hover:border-indigo-400 rounded-2xl p-6 text-center bg-slate-50/30 transition-all group">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-200">
                                <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                            </div>
                            <p class="text-xs font-bold text-slate-700">
                                {{ $uraian->lampiran ? 'Pilih file baru untuk menggantikan' : 'Pilih file untuk diunggah' }}
                            </p>
                            <p class="text-[11px] text-slate-400 mt-1">
                                Kosongkan jika tidak ingin mengubah file lampiran.
                            </p>
                            <div class="mt-4 max-w-xs mx-auto">
                                <input type="file" name="lampiran"
                                    class="block w-full text-xs text-slate-500 file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition cursor-pointer">
                            </div>
                        </div>
                        @error('lampiran')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Keterangan --}}
                    <div class="md:col-span-2 space-y-2">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider">
                            Keterangan Tambahan
                        </label>
                        <div class="relative">
                            <span class="absolute top-3 left-3.5 pointer-events-none text-slate-400">
                                <i class="fa-solid fa-note-sticky text-xs"></i>
                            </span>
                            <textarea name="keterangan" rows="3"
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 border @error('keterangan') border-red-400 bg-red-50/10 @else border-slate-200 @enderror focus:bg-white focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 rounded-xl text-xs font-medium text-slate-800 transition duration-150"
                                placeholder="Tambahkan catatan khusus bila ada...">{{ old('keterangan', $uraian->keterangan) }}</textarea>
                        </div>
                        @error('keterangan')
                            <p class="text-red-500 text-xs font-medium mt-1 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                    <a href="{{ route('pelatihans.show', $pelatihan) }}"
                        class="inline-flex items-center justify-center px-5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-xl transition duration-150">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white text-xs font-semibold rounded-xl shadow-sm transition duration-150">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>

            </form>
        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const progres = document.getElementById('progres');
        const group = document.getElementById('tanggalSelesaiGroup');
        const tanggal = document.querySelector('[name="tanggal_selesai"]');

        function toggleTanggal() {
            if (progres.value === 'selesai') {
                group.classList.remove('hidden');
            } else {
                group.classList.add('hidden');
                if (tanggal) {
                    tanggal.value = '';
                }
            }
        }

        toggleTanggal();
        progres.addEventListener('change', toggleTanggal);
    });
</script>
@endsection