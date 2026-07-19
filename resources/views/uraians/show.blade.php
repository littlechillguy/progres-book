@extends('layouts.app')

@section('title', 'Detail Uraian')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-6">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Detail Uraian
            </h1>

            <p class="text-slate-500 mt-2">
                {{ $uraian->pelatihan->nama_pelatihan }}
            </p>

        </div>

        <a href="{{ route('pelatihans.show', $uraian->pelatihan) }}"
            class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 transition">

            <i class="fa-solid fa-arrow-left mr-2"></i>
            Kembali

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        {{-- Informasi --}}
        <div class="border-b p-8">

            <div class="grid md:grid-cols-3 gap-6">

                <div>

                    <p class="text-sm text-slate-500">
                        Tanggal
                    </p>

                    <h3 class="font-semibold text-lg">
                        {{ \Carbon\Carbon::parse($uraian->tanggal)->translatedFormat('d F Y') }}
                    </h3>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        PIC
                    </p>

                    <h3 class="font-semibold text-lg">
                        {{ $uraian->pic }}
                    </h3>

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Status
                    </p>

                    @if($uraian->progres == 'selesai')

                        <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                            Selesai
                        </span>

                    @elseif($uraian->progres == 'on progress')

                        <span class="inline-flex px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                            On Progress
                        </span>

                    @else

                        <span class="inline-flex px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                            Belum
                        </span>

                    @endif

                </div>

            </div>

        </div>

        {{-- Uraian --}}
        <div class="p-8">

            <h3 class="text-xl font-bold mb-4">
                Uraian Kegiatan
            </h3>

            <div class="leading-8 text-slate-700 whitespace-pre-line">
                {{ $uraian->uraian_kegiatan }}
            </div>

        </div>

        {{-- Lampiran --}}
        <div class="border-t p-8">

            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">

                <i class="fa-solid fa-paperclip text-indigo-600"></i>

                Lampiran

            </h3>

            @if($uraian->lampiran)

                {{-- Preview Gambar --}}
                @if($uraian->isImage())

                    <div class="rounded-xl overflow-hidden border mb-6 bg-slate-50">

                        <img
                            src="{{ asset('storage/'.$uraian->lampiran) }}"
                            loading="lazy"
                            class="w-full object-contain max-h-[700px] rounded-lg">

                    </div>

                {{-- Preview PDF --}}
                @elseif($uraian->isPdf())

                    <div class="rounded-xl overflow-hidden border mb-6">

                        <iframe
                            src="{{ asset('storage/'.$uraian->lampiran) }}"
                            width="100%"
                            height="700"
                            class="rounded-lg">

                        </iframe>

                    </div>

                    <p class="text-sm text-slate-500 mb-6">

                        Jika preview tidak muncul,
                        <a
                            href="{{ asset('storage/'.$uraian->lampiran) }}"
                            target="_blank"
                            class="text-indigo-600 hover:underline">

                            klik di sini.

                        </a>

                    </p>

                {{-- Word / Excel / PPT --}}
                @else

                    <div class="bg-slate-50 border rounded-xl p-10 text-center">

                        <i class="fa-solid {{ $uraian->fileIcon() }} text-7xl text-indigo-600 mb-4"></i>

                        <h4 class="text-lg font-semibold">

                            {{ $uraian->lampiran_nama }}

                        </h4>

                        <span class="inline-flex mt-3 px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs">

                            {{ strtoupper($uraian->lampiran_tipe) }}

                        </span>

                        <p class="text-slate-500 mt-4">

                            Preview belum tersedia untuk tipe file ini.

                        </p>

                    </div>

                @endif

                {{-- Informasi File --}}
                <div class="mt-6 bg-slate-50 border rounded-xl p-6">

                    <div class="flex flex-wrap justify-between items-center gap-6">

                        <div>

                            <p class="text-sm text-slate-500">
                                Nama File
                            </p>

                            <p class="font-semibold text-lg">

                                {{ $uraian->lampiran_nama }}

                            </p>

                            <div class="flex items-center gap-3 mt-2">

                                <span class="px-2 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs">

                                    {{ strtoupper($uraian->lampiran_tipe) }}

                                </span>

                                <span class="text-sm text-slate-500">

                                    {{ number_format(Storage::disk('public')->size($uraian->lampiran)/1024,1) }}
                                    KB

                                </span>

                            </div>

                        </div>

                        <div class="flex gap-3">

                            <a
                                href="{{ asset('storage/'.$uraian->lampiran) }}"
                                target="_blank"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl transition">

                                <i class="fa-solid fa-up-right-from-square mr-2"></i>

                                Buka

                            </a>

                            <a
                                href="{{ asset('storage/'.$uraian->lampiran) }}"
                                download="{{ $uraian->lampiran_nama }}"
                                class="bg-green-600 hover:bg-green-700 text-white px-5 py-3 rounded-xl transition">

                                <i class="fa-solid fa-download mr-2"></i>

                                Download

                            </a>

                        </div>

                    </div>

                </div>

            @else

                {{-- Tidak ada lampiran --}}
                <div class="bg-slate-50 border rounded-xl p-10 text-center">

                    <i class="fa-regular fa-folder-open text-6xl text-slate-400 mb-5"></i>

                    <h4 class="text-xl font-semibold mb-2">

                        Tidak Ada Lampiran

                    </h4>

                    <p class="text-slate-500">

                        Belum ada file yang diunggah untuk uraian kegiatan ini.

                    </p>

                </div>

            @endif

        </div>

        {{-- Keterangan --}}
        @if($uraian->keterangan)

        <div class="border-t p-8">

            <h3 class="text-xl font-bold mb-4">

                Keterangan

            </h3>

            <div class="leading-8 text-slate-700 whitespace-pre-line">

                {{ $uraian->keterangan }}

            </div>

        </div>

        @endif

    </div>

</div>

@endsection