@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Dashboard Progress Pelatihan
            </h1>

            <p class="text-slate-500 mt-2">
                Monitoring pelaksanaan seluruh kegiatan pelatihan secara real-time.
            </p>

        </div>

    </div>

    {{-- Statistik --}}

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow border border-slate-100 p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-slate-500">
                        Total Pelatihan
                    </p>

                    <h2 class="text-4xl font-bold text-slate-800 mt-2">
                        {{ $pelatihans->count() }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-indigo-100 flex items-center justify-center">

                    <i class="fa-solid fa-graduation-cap text-indigo-600 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow border border-slate-100 p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-slate-500">
                        Total Kegiatan
                    </p>

                    <h2 class="text-4xl font-bold text-slate-800 mt-2">
                        {{ $totalKegiatanGlobal }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">

                    <i class="fa-solid fa-list-check text-blue-600 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow border border-slate-100 p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-slate-500">
                        Total Selesai
                    </p>

                    <h2 class="text-4xl font-bold text-green-600 mt-2">
                        {{ $totalSelesaiGlobal }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">

                    <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>

                </div>

            </div>

        </div>

        <div class="bg-white rounded-2xl shadow border border-slate-100 p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-sm text-slate-500">
                        Progress Keseluruhan
                    </p>

                    <h2 class="text-4xl font-bold text-orange-500 mt-2">
                        {{ $persenGlobal }}%
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center">

                    <i class="fa-solid fa-chart-line text-orange-600 text-xl"></i>

                </div>

            </div>

        </div>

    </div>

    {{-- Table --}}

    <div class="bg-white rounded-2xl shadow border border-slate-100 overflow-hidden">

        <div class="px-6 py-5 border-b flex justify-between items-center">

            <div>

                <h2 class="font-bold text-lg text-slate-800">
                    Daftar Pelatihan
                </h2>

                <p class="text-sm text-slate-500">

                    Klik nama pelatihan untuk melihat detail progres.

                </p>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr class="text-xs uppercase text-slate-500">

                        <th class="py-4 px-5 text-center">No</th>
                        <th class="py-4 px-5">Nama Pelatihan</th>
                        <th class="py-4 px-5">Tahapan</th>
                        <th class="py-4 px-5">Hari / Tanggal</th>
                        <th class="py-4 px-5">Tempat</th>
                        <th class="py-4 px-5">Progress</th>
                        <th class="py-4 px-5">Status</th>

                    </tr>

                </thead>

                <tbody class="divide-y">

                @forelse($pelatihans as $pelatihan)

                    <tr class="hover:bg-slate-50">

                        <td class="text-center py-4">

                            {{ $loop->iteration }}

                        </td>

                        <td class="px-5">

                            <a href="{{ route('pelatihans.show',$pelatihan) }}"
                                class="font-semibold text-indigo-600 hover:underline">

                                {{ $pelatihan->nama_pelatihan }}

                            </a>

                        </td>

                        <td>

                            {{ $pelatihan->tahapan }}

                        </td>

                        <td>

                            {{ $pelatihan->hari }}

                            <br>

                            <small class="text-slate-500">

                                {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }}

                            </small>

                        </td>

                        <td>

                            {{ $pelatihan->tempat }}

                        </td>

                        <td class="w-72">

                            <div class="flex items-center gap-3">

                                <div class="w-full bg-slate-200 rounded-full h-3">

                                    <div
                                        class="bg-indigo-600 h-3 rounded-full"
                                        style="width: {{ $pelatihan->persen }}%">
                                    </div>

                                </div>

                                <span class="font-bold text-sm">

                                    {{ $pelatihan->persen }}%

                                </span>

                            </div>

                        </td>

                        <td>

                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $pelatihan->status_color }}">

                                {{ $pelatihan->status_label }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="py-12 text-center text-slate-400">

                            Belum ada data pelatihan.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection