@extends('layouts.app')

@section('title', 'Dashboard Progress Pelatihan 2026')

@section('content')
    <div class="mb-8 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">DASHBOARD PROGRESS PELATIHAN 2026</h1>
            <p class="text-xs text-slate-500 mt-0.5">Sistem Pemantauan Real-time Aktivitas dan Progres Pelatihan Mandiri</p>
        </div>
        <div class="bg-indigo-600 text-white px-4 py-1.5 rounded-lg text-xs font-semibold shadow-xs self-start sm:self-center">
            Jumlah Pelatihan: {{ $pelatihans->count() }}
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-5 rounded-2xl shadow-xs border border-slate-100 flex items-center space-x-4">
            <div class="p-3 bg-blue-50 text-blue-600 rounded-xl"><i class="fa-solid fa-layer-group text-xl"></i></div>
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Kegiatan</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalKegiatanGlobal }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-xs border border-slate-100 flex items-center space-x-4">
            <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl"><i class="fa-solid fa-circle-check text-xl"></i></div>
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Total Selesai</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalSelesaiGlobal }}</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-xs border border-slate-100 flex items-center space-x-4">
            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-xl"><i class="fa-solid fa-chart-pie text-xl"></i></div>
            <div class="w-full">
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">% Selesai</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $persenGlobal }}%</h3>
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-xs border border-slate-100 flex items-center space-x-4">
            <div class="p-3 bg-purple-50 text-purple-600 rounded-xl"><i class="fa-solid fa-flag-checkered text-xl"></i></div>
            <div>
                <p class="text-[11px] font-semibold text-slate-400 uppercase tracking-wider">Pelatihan Terlaksana</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $pelatihanTerlaksana }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-xs border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-600 text-xs font-semibold tracking-wider uppercase border-b border-slate-200">
                        <th class="py-4 px-6 text-center w-12">No</th>
                        <th class="py-4 px-6">Nama Pelatihan</th>
                        <th class="py-4 px-4 text-center">Total</th>
                        <th class="py-4 px-4 text-center">Selesai</th>
                        <th class="py-4 px-4 text-center">Progress</th>
                        <th class="py-4 px-4 text-center">Belum</th>
                        <th class="py-4 px-6 min-w-[160px]">% Selesai</th>
                        <th class="py-4 px-6 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @foreach($pelatihans as $index => $pelatihan)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="py-4 px-6 text-center font-medium text-slate-400">{{ $index + 1 }}</td>
                        <td class="py-4 px-6">
                            <a href="/trainings/{{ $pelatihan->id }}" class="font-bold text-indigo-600 hover:text-indigo-900 hover:underline block mb-0.5">
                                {{ $pelatihan->nama_pelatihan }}
                            </a>
                            <span class="text-xs text-slate-400">
                                {{ $pelatihan->tanggal }} &bull; {{ $pelatihan->tempat }}
                            </span>
                        </td>
                        <td class="py-4 px-4 text-center font-semibold text-slate-700">{{ $pelatihan->total_kegiatan }}</td>
                        <td class="py-4 px-4 text-center text-emerald-600 font-medium">{{ $pelatihan->selesai }}</td>
                        <td class="py-4 px-4 text-center text-amber-600 font-medium">{{ $pelatihan->on_progress }}</td>
                        <td class="py-4 px-4 text-center text-slate-400">{{ $pelatihan->belum }}</td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <span class="font-bold text-slate-700 min-w-[38px] text-right">{{ $pelatihan->persen }}%</span>
                                <div class="w-full bg-slate-100 rounded-full h-1.5">
                                    <div class="bg-indigo-600 h-1.5 rounded-full transition-all duration-500" style="width: {{ $pelatihan->persen }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6 text-center">
                            <span class="px-3 py-0.5 rounded-full text-[11px] font-bold border {{ $pelatihan->status_color }}">
                                {{ $pelatihan->status_label }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection