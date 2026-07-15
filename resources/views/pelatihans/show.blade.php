@extends('layouts.app')

@section('title', $pelatihan->nama_pelatihan)

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <a href="{{ route('pelatihans.index') }}"
               class="text-indigo-600 hover:underline text-sm">

                ← Kembali ke Data Pelatihan

            </a>

            <h1 class="text-3xl font-bold text-slate-800 mt-2">

                {{ $pelatihan->nama_pelatihan }}

            </h1>

            <p class="text-slate-500 mt-1">

                Detail Progress Pelatihan

            </p>

        </div>

        @auth

            @if(auth()->user()->role == 'admin')

                <a href="#"
                   class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">

                    + Tambah Uraian

                </a>

            @endif

        @endauth

    </div>

    <div class="bg-white rounded-xl shadow border">

        <div class="grid md:grid-cols-2 gap-6 p-6">

            <div>

                <label class="text-xs uppercase text-slate-500">
                    Tahapan
                </label>

                <p class="font-semibold text-lg">

                    {{ $pelatihan->tahapan }}

                </p>

            </div>

            <div>

                <label class="text-xs uppercase text-slate-500">
                    Kegiatan
                </label>

                <p class="font-semibold">

                    {{ $pelatihan->kegiatan }}

                </p>

            </div>

            <div>

                <label class="text-xs uppercase text-slate-500">
                    Hari
                </label>

                <p>

                    {{ $pelatihan->hari }}

                </p>

            </div>

            <div>

                <label class="text-xs uppercase text-slate-500">
                    Tanggal
                </label>

                <p>

                    {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }}

                </p>

            </div>

            <div class="md:col-span-2">

                <label class="text-xs uppercase text-slate-500">
                    Tempat
                </label>

                <p>

                    {{ $pelatihan->tempat }}

                </p>

            </div>

        </div>

    </div>

    <div class="bg-white rounded-xl shadow border">

        <div class="border-b px-6 py-4">

            <h2 class="font-bold text-lg">

                Progress Pelatihan

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="p-4 text-center w-16">No</th>
                        <th>Uraian Kegiatan</th>
                        <th>Tanggal</th>
                        <th>Progress</th>
                        <th>PIC</th>
                        <th>Link File</th>
                        <th>Keterangan</th>

                        @auth

                            @if(auth()->user()->role=='admin')

                                <th width="120">

                                    Aksi

                                </th>

                            @endif

                        @endauth

                    </tr>

                </thead>

                <tbody>

                @forelse($pelatihan->uraians as $uraian)

                    <tr class="border-t hover:bg-slate-50">

                        <td class="text-center">

                            {{ $uraian->urutan }}

                        </td>

                        <td>

                            {{ $uraian->uraian_kegiatan }}

                        </td>

                        <td>

                            {{ \Carbon\Carbon::parse($uraian->tanggal)->format('d M Y') }}

                        </td>

                        <td>

                            @if($uraian->progres=='selesai')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">

                                    Selesai

                                </span>

                            @elseif($uraian->progres=='on progress')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">

                                    On Progress

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">

                                    Belum

                                </span>

                            @endif

                        </td>

                        <td>

                            {{ $uraian->pic }}

                        </td>

                        <td>

                            @if($uraian->link)

                                <a href="{{ $uraian->link }}"
                                   target="_blank"
                                   class="text-indigo-600 hover:underline">

                                    Lihat File

                                </a>

                            @else

                                -

                            @endif

                        </td>

                        <td>

                            {{ $uraian->keterangan }}

                        </td>

                        @auth

                            @if(auth()->user()->role=='admin')

                                <td>

                                    <div class="flex gap-3">

                                        <a href="#"
                                           class="text-amber-500">

                                            <i class="fa fa-pen"></i>

                                        </a>

                                        <a href="#"
                                           class="text-red-600">

                                            <i class="fa fa-trash"></i>

                                        </a>

                                    </div>

                                </td>

                            @endif

                        @endauth

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="text-center py-8 text-slate-500">

                            Belum ada uraian kegiatan.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection