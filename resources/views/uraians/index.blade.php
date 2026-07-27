@extends('layouts.app')

@section('title', $pelatihan->nama_pelatihan)

@section('content')

    <div class="space-y-6 pb-12">

        {{-- 1. Header & Quick Info Card --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden">
            {{-- Accent Background Gradient Blur --}}
            <div class="absolute -right-10 -top-10 w-48 h-48 bg-indigo-500/5 rounded-full blur-2xl pointer-events-none">
            </div>

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-10">
                <div class="space-y-3 flex-1">
                    {{-- Back Button & Badge --}}
                    <div class="flex items-center gap-3">
                        <a href="{{ route('pelatihans.index') }}"
                            class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all duration-200 active:scale-95 border border-slate-200/60">
                            <i class="fa-solid fa-arrow-left text-[10px]"></i>
                            <span>Kembali</span>
                        </a>

                        @php
                            $tahapanClass = match ($pelatihan->tahapan) {
                                'Persiapan' => 'bg-amber-50 text-amber-700 border-amber-100',
                                'Pelaksanaan' => 'bg-sky-50 text-sky-700 border-sky-100',
                                'Evaluasi' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                default => 'bg-slate-100 text-slate-600 border-slate-200'
                            };
                        @endphp
                        <span
                            class="px-3 py-1 border font-bold rounded-lg text-[10px] tracking-wide inline-block {{ $tahapanClass }}">
                            {{ $pelatihan->tahapan }}
                        </span>
                    </div>

                    {{-- Title --}}
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight leading-snug">
                        {{ $pelatihan->nama_pelatihan }}
                    </h1>

                    {{-- Meta Details --}}
                    <div class="flex flex-wrap items-center gap-y-2 gap-x-4 text-xs font-semibold text-slate-500">
                        <div class="flex items-center gap-1.5">
                            <i class="fa-regular fa-calendar text-indigo-500"></i>
                            <span>{{ $pelatihan->hari }},
                                {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }}</span>
                        </div>
                        <span class="text-slate-300">•</span>
                        <div class="flex items-center gap-1.5">
                            <i class="fa-solid fa-location-dot text-indigo-500"></i>
                            <span>{{ $pelatihan->tempat }}</span>
                        </div>
                    </div>
                </div>

                {{-- Progress Box Widget --}}
                <div class="lg:w-80 bg-slate-50/80 p-4 rounded-xl border border-slate-200/60 space-y-2 shrink-0">
                    <div class="flex justify-between items-center text-xs">
                        <span class="font-bold text-slate-700">Progress Pelatihan</span>
                        <span class="font-black {{ $progress == 100 ? 'text-emerald-600' : 'text-indigo-600' }}">
                            {{ $progress }}%
                            <span
                                class="text-slate-400 font-semibold text-[10px] ml-0.5">({{ $selesai }}/{{ $total }})</span>
                        </span>
                    </div>
                    <div class="w-full bg-slate-200/70 rounded-full h-2 overflow-hidden">
                        <div class="h-2 rounded-full transition-all duration-700 ease-in-out {{ $progress == 100 ? 'bg-emerald-500' : 'bg-gradient-to-r from-indigo-500 to-sky-400' }}"
                            style="width: {{ $progress }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. Toolbar Filter & Form Pencarian --}}
       <div class="bg-white rounded-2xl p-4 border border-slate-200/60 shadow-sm">

    <form method="GET" action="{{ route('pelatihans.show', $pelatihan->id) }}">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-3">

            {{-- Search --}}
            <div class="md:col-span-4 relative">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari uraian kegiatan atau PIC..."
                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
            </div>

            {{-- Tahapan --}}
            <div class="md:col-span-2 relative">

                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-indigo-500 text-xs">
                    <i class="fa-solid fa-layer-group"></i>
                </div>

                <select
                    name="tahapan"
                    class="w-full pl-9 pr-8 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">

                    <option value="">Semua Tahapan</option>

                    <option value="Persiapan"
                        {{ request('tahapan') == 'Persiapan' ? 'selected' : '' }}>
                        Persiapan
                    </option>

                    <option value="Pelaksanaan"
                        {{ request('tahapan') == 'Pelaksanaan' ? 'selected' : '' }}>
                        Pelaksanaan
                    </option>

                    <option value="Evaluasi"
                        {{ request('tahapan') == 'Evaluasi' ? 'selected' : '' }}>
                        Evaluasi
                    </option>

                </select>

                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </div>

            </div>

            {{-- Status --}}
            <div class="md:col-span-2 relative">

                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-indigo-500 text-xs">
                    <i class="fa-solid fa-list-check"></i>
                </div>

                <select
                    name="progres"
                    class="w-full pl-9 pr-8 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">

                    <option value="">Semua Status</option>

                    <option value="selesai"
                        {{ request('progres') == 'selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="on progress"
                        {{ request('progres') == 'on progress' ? 'selected' : '' }}>
                        On Progress
                    </option>

                    <option value="belum"
                        {{ request('progres') == 'belum' ? 'selected' : '' }}>
                        Belum
                    </option>

                </select>

                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                    <i class="fa-solid fa-chevron-down text-[10px]"></i>
                </div>

            </div>

            {{-- Tanggal --}}
            <div class="md:col-span-2">

                <input
                    type="date"
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                    class="w-full px-3 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">

            </div>

            {{-- Tombol --}}
            <div class="md:col-span-2 flex gap-2">

                <button
                    type="submit"
                    class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2">

                    <i class="fa-solid fa-filter text-[11px]"></i>
                    Filter

                </button>

                <a
                    href="{{ route('pelatihans.show', $pelatihan->id) }}"
                    class="w-11 flex items-center justify-center bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl border border-slate-200 transition-all">

                    <i class="fa-solid fa-rotate-left"></i>

                </a>

            </div>

        </div>

    </form>

</div>

        {{-- 3. Header Table & Action Add --}}
        <div class="flex items-center justify-between gap-4 pt-2">
            <div>
                <h2 class="text-lg font-black text-slate-800 tracking-tight">
                    Uraian <span class="text-indigo-600">Kegiatan</span>
                </h2>
                <p class="text-xs text-slate-500 font-medium">
                    Daftar rinci tahapan dan penanggung jawab kegiatan pelatihan.
                </p>
            </div>

            @auth
                @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                    <a href="{{ route('uraians.create', $pelatihan) }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow transition-all duration-200 active:scale-95 shrink-0">
                        <i class="fa-solid fa-plus text-[10px]"></i>
                        <span>Tambah Data</span>
                    </a>
                @endif
            @endauth
        </div>

        {{-- 4. Tabel Uraian Kegiatan --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50 border-b border-slate-200 text-[11px] uppercase font-bold tracking-wider text-slate-500">
                            <th class="py-3 px-4 text-center w-12">No</th>
                            <th class="py-3 px-4 w-36">Tahapan</th>
                            <th class="py-3 px-4 min-w-[260px]">Uraian Kegiatan</th>
                            <th class="py-3 px-4 whitespace-nowrap">Tanggal</th>
                            <th class="py-3 px-4 text-center w-36">Status</th>
                            <th class="py-3 px-4 whitespace-nowrap">PIC</th>
                            <th class="py-3 px-4 w-44">Lampiran</th>
                            <th class="py-3 px-4 min-w-[180px]">Keterangan</th>

                            @auth
                                @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                                    <th class="py-3 px-4 text-center w-32">Aksi</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100 text-sm">

                        @forelse($uraians as $index => $uraian)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Nomor --}}
                                <td class="px-4 py-4 text-center text-slate-500 font-semibold">
                                    {{ $uraians->firstItem() + $index }}
                                </td>

                                {{-- Tahapan --}}
                                <td class="px-4 py-4">

                                    @php
                                        $badgeTahapan = match ($uraian->tahapan) {
                                            'Persiapan' => 'bg-amber-100 text-amber-700',
                                            'Pelaksanaan' => 'bg-sky-100 text-sky-700',
                                            'Evaluasi' => 'bg-emerald-100 text-emerald-700',
                                            default => 'bg-slate-100 text-slate-600'
                                        };
                                    @endphp

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeTahapan }}">
                                        {{ $uraian->tahapan }}
                                    </span>

                                </td>

                                {{-- Uraian --}}
                                <td class="px-4 py-4 font-semibold text-slate-800">
                                    {{ $uraian->uraian_kegiatan }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-4 py-4 whitespace-nowrap text-slate-600">

                                    {{ \Carbon\Carbon::parse($uraian->tanggal)->translatedFormat('d M Y') }}

                                    @if($uraian->tanggal_selesai)

                                        <div class="text-[11px] text-emerald-600 mt-1">

                                            Selesai :
                                            {{ \Carbon\Carbon::parse($uraian->tanggal_selesai)->translatedFormat('d M Y') }}

                                        </div>

                                    @endif

                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-4 text-center">

                                    @php
                                        $badgeStatus = match ($uraian->progres) {
                                            'belum' => 'bg-red-100 text-red-700',
                                            'on progress' => 'bg-yellow-100 text-yellow-700',
                                            'selesai' => 'bg-green-100 text-green-700',
                                            default => 'bg-slate-100 text-slate-700'
                                        };
                                    @endphp

                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badgeStatus }}">
                                        {{ ucfirst($uraian->progres) }}
                                    </span>

                                </td>

                                {{-- PIC --}}
                                <td class="px-4 py-4">
                                    <span class="bg-slate-100 px-3 py-1 rounded-lg text-xs font-medium">
                                        {{ $uraian->pic }}
                                    </span>
                                </td>

                                {{-- Lampiran --}}
                                <td class="px-4 py-4">

                                    @if($uraian->lampiran)

                                        <a href="{{ route('uraians.show', $uraian) }}"
                                            class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800">

                                            <i class="fa-solid {{ $uraian->fileIcon() }}"></i>

                                            {{ Str::limit($uraian->lampiran_nama, 20) }}

                                        </a>

                                    @else

                                        <span class="text-slate-400">-</span>

                                    @endif

                                </td>

                                {{-- Keterangan --}}
                                <td class="px-4 py-4 text-slate-500">
                                    {{ $uraian->keterangan ?: '-' }}
                                </td>

                                {{-- Aksi --}}
                                @auth
                                    @if(in_array(auth()->user()->role, ['admin', 'superadmin']))

                                        <td class="px-4 py-4">

                                            <div class="flex justify-center gap-2">

                                                <a href="{{ route('uraians.show', $uraian) }}"
                                                    class="w-8 h-8 rounded-lg bg-sky-100 hover:bg-sky-600 hover:text-white flex items-center justify-center">
                                                    <i class="fa-solid fa-eye text-xs"></i>
                                                </a>

                                                <a href="{{ route('uraians.edit', [$pelatihan, $uraian]) }}"
                                                    class="w-8 h-8 rounded-lg bg-amber-100 hover:bg-amber-500 hover:text-white flex items-center justify-center">
                                                    <i class="fa-solid fa-pen text-xs"></i>
                                                </a>

                                                <form action="{{ route('uraians.destroy', [$pelatihan, $uraian]) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        class="w-8 h-8 rounded-lg bg-red-100 hover:bg-red-600 hover:text-white flex items-center justify-center">

                                                        <i class="fa-solid fa-trash text-xs"></i>

                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    @endif
                                @endauth

                            </tr>

                        @empty

                            <tr>

                                <td colspan="{{ auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin']) ? 9 : 8 }}"
                                    class="py-14 text-center text-slate-500">

                                    <i class="fa-regular fa-folder-open text-5xl mb-3 block text-slate-300"></i>

                                    Belum ada data uraian.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

            @if($uraians->hasPages())
                <div class="border-t border-slate-100 p-4 bg-slate-50">
                    {{ $uraians->links() }}
                </div>
            @endif
        </div>

    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            height: 5px;
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scrollbar:hover::-webkit-scrollbar-thumb {
            background: #cbd5e1;
        }
    </style>

@endsection