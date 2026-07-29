@extends('layouts.app')

@section('title', 'Detail Uraian')

@section('content')
<div class="p-6 space-y-6 max-w-5xl mx-auto">

    {{-- Header Page --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block"></span>
                Detail Uraian Kegiatan
            </h1>
            <p class="text-xs text-slate-400 font-medium mt-1">
                Pelatihan: <span class="text-indigo-600 font-semibold">{{ $uraian->pelatihan->nama_pelatihan }}</span>
            </p>
        </div>

        <div>
            <a href="{{ route('pelatihans.show', $uraian->pelatihan) }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-600 text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                <span>Kembali</span>
            </a>
        </div>
    </div>

    {{-- Main Container Card --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        
        {{-- Quick Info Metrics Bar --}}
        <div class="p-6 bg-slate-50/50 border-b border-slate-100 grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            
            {{-- Tanggal --}}
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-calendar text-sm"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal</p>
                    <p class="text-xs font-bold text-slate-800 mt-0.5">
                        {{ \Carbon\Carbon::parse($uraian->tanggal)->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>

            {{-- Tanggal Selesai --}}
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-calendar-check text-sm"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Tanggal Selesai</p>
                    <p class="text-xs font-bold text-slate-800 mt-0.5">
                        @if($uraian->tanggal_selesai)
                            {{ \Carbon\Carbon::parse($uraian->tanggal_selesai)->translatedFormat('d F Y') }}
                        @else
                            <span class="text-slate-400 font-normal">-</span>
                        @endif
                    </p>
                </div>
            </div>

            {{-- PIC --}}
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-user text-sm"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">PIC</p>
                    <p class="text-xs font-bold text-slate-800 mt-0.5">
                        {{ $uraian->pic }}
                    </p>
                </div>
            </div>

            {{-- Status Progress --}}
            <div class="flex items-start gap-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-bars-progress text-sm"></i>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Status Progress</p>
                    <div class="mt-1">
                        @if($uraian->progres == 'selesai')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-emerald-50 border border-emerald-200/60 text-emerald-700 text-xs font-semibold">
                                <i class="fa-solid fa-circle-check text-[10px]"></i> Selesai
                            </span>
                        @elseif($uraian->progres == 'on progress')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-amber-50 border border-amber-200/60 text-amber-700 text-xs font-semibold">
                                <i class="fa-solid fa-clock-rotate-left text-[10px]"></i> On Progress
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg bg-rose-50 border border-rose-200/60 text-rose-700 text-xs font-semibold">
                                <i class="fa-solid fa-circle-dot text-[10px]"></i> Belum
                            </span>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        {{-- Detail Content Sections --}}
        <div class="p-6 sm:p-8 space-y-8">

            {{-- Uraian Kegiatan Section --}}
            <div class="space-y-3">
                <div class="flex items-center gap-2 text-slate-800">
                    <i class="fa-solid fa-align-left text-indigo-600 text-sm"></i>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Uraian Kegiatan</h3>
                </div>
                <div class="p-5 bg-slate-50/70 rounded-2xl border border-slate-100 text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                    {{ $uraian->uraian_kegiatan }}
                </div>
            </div>

            {{-- Keterangan Section --}}
            @if($uraian->keterangan)
            <div class="space-y-3 pt-6 border-t border-slate-100">
                <div class="flex items-center gap-2 text-slate-800">
                    <i class="fa-solid fa-note-sticky text-amber-500 text-sm"></i>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Keterangan Tambahan</h3>
                </div>
                <div class="p-5 bg-amber-50/40 rounded-2xl border border-amber-100/60 text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                    {{ $uraian->keterangan }}
                </div>
            </div>
            @endif

            {{-- Lampiran Section --}}
            <div class="space-y-4 pt-6 border-t border-slate-100">
                <div class="flex items-center gap-2 text-slate-800">
                    <i class="fa-solid fa-paperclip text-indigo-600 text-sm"></i>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-500">Lampiran Berkas</h3>
                </div>

                @if($uraian->lampiran)
                    
                    {{-- File Preview Container --}}
                    @if($uraian->isImage())
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-900/5 p-2 flex justify-center">
                            <img src="{{ asset('storage/' . $uraian->lampiran) }}" loading="lazy"
                                class="max-h-[600px] w-auto object-contain rounded-xl shadow-sm">
                        </div>
                    @elseif($uraian->isPdf())
                        <div class="rounded-2xl overflow-hidden border border-slate-200 bg-slate-50 shadow-inner">
                            <iframe src="{{ asset('storage/' . $uraian->lampiran) }}" class="w-full h-[600px] rounded-2xl"></iframe>
                        </div>
                        <p class="text-xs text-slate-400 text-center">
                            Jika pratinjau PDF tidak muncul dengan benar, 
                            <a href="{{ asset('storage/' . $uraian->lampiran) }}" target="_blank" class="text-indigo-600 font-semibold hover:underline">
                                klik di sini untuk membuka tab baru <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                            </a>
                        </p>
                    @else
                        <div class="p-8 bg-slate-50 border border-slate-200 rounded-2xl text-center space-y-3">
                            <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mx-auto">
                                <i class="fa-solid {{ $uraian->fileIcon() }} text-3xl"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">{{ $uraian->lampiran_nama }}</h4>
                                <span class="inline-block mt-1 px-2.5 py-0.5 rounded-md bg-indigo-100 text-indigo-700 text-[10px] font-bold tracking-wide uppercase">
                                    {{ strtoupper($uraian->lampiran_tipe) }}
                                </span>
                            </div>
                            <p class="text-xs text-slate-400">Pratinjau langsung tidak tersedia untuk format berkas ini.</p>
                        </div>
                    @endif

                    {{-- File Meta Info Bar & Actions --}}
                    <div class="p-4 sm:p-5 bg-slate-50 rounded-2xl border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-10 h-10 rounded-xl bg-white border border-slate-200 text-indigo-600 flex items-center justify-center shrink-0 shadow-sm">
                                <i class="fa-solid {{ $uraian->fileIcon() }} text-base"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-bold text-slate-800 truncate">{{ $uraian->lampiran_nama }}</p>
                                <div class="flex items-center gap-2 mt-0.5">
                                    <span class="px-2 py-0.5 rounded bg-indigo-100 text-indigo-700 text-[10px] font-bold uppercase">
                                        {{ strtoupper($uraian->lampiran_tipe) }}
                                    </span>
                                    <span class="text-[11px] text-slate-400 font-medium">
                                        {{ number_format(Storage::disk('public')->size($uraian->lampiran) / 1024, 1) }} KB
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-2.5 w-full sm:w-auto">
                            <a href="{{ asset('storage/' . $uraian->lampiran) }}" target="_blank"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                                <i class="fa-solid fa-up-right-from-square text-xs"></i>
                                <span>Buka File</span>
                            </a>

                            <a href="{{ asset('storage/' . $uraian->lampiran) }}" download="{{ $uraian->lampiran_nama }}"
                                class="flex-1 sm:flex-none inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 active:bg-emerald-800 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-200">
                                <i class="fa-solid fa-download text-xs"></i>
                                <span>Unduh File</span>
                            </a>
                        </div>
                    </div>

                @else

                    {{-- Empty State --}}
                    <div class="p-8 bg-slate-50/50 border border-dashed border-slate-200 rounded-2xl text-center">
                        <div class="w-12 h-12 bg-slate-100 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-3">
                            <i class="fa-regular fa-folder-open text-xl"></i>
                        </div>
                        <h4 class="text-xs font-bold text-slate-700">Tidak Ada Lampiran</h4>
                        <p class="text-xs text-slate-400 mt-0.5">Belum ada dokumen atau gambar yang diunggah untuk uraian kegiatan ini.</p>
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>
@endsection