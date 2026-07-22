@extends('layouts.app')

@section('title', $pelatihan->nama_pelatihan)

@section('content')

<div class="space-y-6 pb-12">

    {{-- 1. Header & Quick Info Card --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden">
        {{-- Accent Background Gradient Blur --}}
        <div class="absolute -right-10 -top-10 w-48 h-48 bg-indigo-500/5 rounded-full blur-2xl pointer-events-none"></div>

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
                        $tahapanClass = match($pelatihan->tahapan) {
                            'Persiapan' => 'bg-amber-50 text-amber-700 border-amber-100',
                            'Pelaksanaan' => 'bg-sky-50 text-sky-700 border-sky-100',
                            'Evaluasi' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                            default => 'bg-slate-100 text-slate-600 border-slate-200'
                        };
                    @endphp
                    <span class="px-3 py-1 border font-bold rounded-lg text-[10px] tracking-wide inline-block {{ $tahapanClass }}">
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
                        <span>{{ $pelatihan->hari }}, {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }}</span>
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
                        <span class="text-slate-400 font-semibold text-[10px] ml-0.5">({{ $selesai }}/{{ $total }})</span>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-12 gap-3">

                {{-- Search Input --}}
                <div class="md:col-span-5 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari uraian kegiatan atau PIC..."
                           class="w-full pl-9 pr-4 py-2 bg-slate-50/60 border border-slate-200/80 text-slate-700 text-xs font-semibold rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder:text-slate-400">
                </div>

                {{-- Select Status --}}
                <div class="md:col-span-3 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-indigo-500 text-xs">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <select name="progres" 
                            class="w-full pl-9 pr-8 py-2 bg-slate-50/60 border border-slate-200/80 text-slate-700 text-xs font-semibold rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all appearance-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="selesai" {{ request('progres') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="on progress" {{ request('progres') == 'on progress' ? 'selected' : '' }}>On Progress</option>
                        <option value="belum" {{ request('progres') == 'belum' ? 'selected' : '' }}>Belum</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </div>
                </div>

                {{-- Select Tanggal --}}
                <div class="md:col-span-2 relative">
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                           class="w-full px-3 py-2 bg-slate-50/60 border border-slate-200/80 text-slate-700 text-xs font-semibold rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all">
                </div>

                {{-- Filter & Reset Buttons --}}
                <div class="md:col-span-2 flex gap-2">
                    <button type="submit" 
                            class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs hover:shadow transition-all duration-200 flex items-center justify-center gap-1.5 active:scale-95">
                        <i class="fa-solid fa-filter text-[10px]"></i>
                        <span>Filter</span>
                    </button>

                    <a href="{{ route('pelatihans.show', $pelatihan->id) }}" 
                       class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all duration-200 flex items-center justify-center border border-slate-200/60 active:scale-95" 
                       title="Reset Filter">
                        <i class="fa-solid fa-rotate-left text-[11px]"></i>
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
            @if(auth()->user()->role == 'admin')
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
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-4 text-center w-12">No</th>
                        <th class="py-3.5 px-4 min-w-[220px]">Uraian Kegiatan</th>
                        <th class="py-3.5 px-4 whitespace-nowrap">Tanggal</th>
                        <th class="py-3.5 px-4 text-center whitespace-nowrap w-28">Status</th>
                        <th class="py-3.5 px-4 whitespace-nowrap">PIC</th>
                        <th class="py-3.5 px-4 whitespace-nowrap min-w-[130px]">Lampiran</th>
                        <th class="py-3.5 px-4 min-w-[160px]">Keterangan</th>
                        @auth
                            @if(auth()->user()->role == 'admin')
                                <th class="py-3.5 px-4 text-center whitespace-nowrap w-28">Aksi</th>
                            @endif
                        @endauth
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                    @forelse($uraians as $index => $uraian)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            
                            {{-- Nomor --}}
                            <td class="py-4 px-4 text-center text-slate-400 font-semibold align-middle">
                                {{ $uraians->firstItem() + $index }}
                            </td>

                            {{-- Uraian Kegiatan --}}
                            <td class="py-4 px-4 font-bold text-slate-800 leading-relaxed align-middle">
                                {{ $uraian->uraian_kegiatan }}
                            </td>

                            {{-- Tanggal --}}
                            <td class="py-4 px-4 whitespace-nowrap font-semibold text-slate-500 align-middle">
                                {{ \Carbon\Carbon::parse($uraian->tanggal)->format('d M Y') }}
                            </td>

                            {{-- Status Badge --}}
                            <td class="py-4 px-4 text-center whitespace-nowrap align-middle">
                                @if($uraian->progres == 'selesai')
                                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-100 inline-block">
                                        Selesai
                                    </span>
                                    @if($uraian->tanggal_selesai)
                                        <div class="mt-1 text-[10px] font-semibold text-slate-400">
                                            {{ \Carbon\Carbon::parse($uraian->tanggal_selesai)->translatedFormat('d M Y') }}
                                        </div>
                                    @endif
                                @elseif($uraian->progres == 'on progress')
                                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-50 text-amber-700 border border-amber-100 inline-block">
                                        On Progress
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold bg-rose-50 text-rose-700 border border-rose-100 inline-block">
                                        Belum
                                    </span>
                                @endif
                            </td>

                            {{-- PIC --}}
                            <td class="py-4 px-4 whitespace-nowrap align-middle">
                                <span class="font-bold text-slate-700 bg-slate-100/80 px-2 py-0.5 rounded-md text-[11px]">
                                    {{ $uraian->pic ?? '-' }}
                                </span>
                            </td>

                            {{-- Lampiran --}}
                            <td class="py-4 px-4 whitespace-nowrap align-middle">
                                @if($uraian->lampiran)
                                    <a href="{{ route('uraians.show', $uraian) }}"
                                       class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white rounded-lg transition-all duration-200 text-[11px] font-bold"
                                       title="{{ $uraian->lampiran_nama }}">
                                        <i class="fa-solid {{ $uraian->fileIcon() }}"></i>
                                        <span class="truncate max-w-[100px]">
                                            {{ $uraian->lampiran_nama }}
                                        </span>
                                    </a>
                                @else
                                    <span class="text-slate-400 italic text-[11px]">-</span>
                                @endif
                            </td>

                            {{-- Keterangan --}}
                            <td class="py-4 px-4 text-slate-500 align-middle leading-relaxed" title="{{ $uraian->keterangan }}">
                                <span class="line-clamp-2">{{ $uraian->keterangan ?? '-' }}</span>
                            </td>

                            {{-- Aksi Admin --}}
                            @auth
                                @if(auth()->user()->role == 'admin')
                                    <td class="py-4 px-4 text-center whitespace-nowrap align-middle">
                                        <div class="flex items-center justify-center gap-1.5">
                                            {{-- Detail --}}
                                            <a href="{{ route('uraians.show', $uraian) }}"
                                               class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-500 hover:text-white flex items-center justify-center transition-all shadow-2xs" 
                                               title="Detail">
                                                <i class="fa-solid fa-eye text-xs"></i>
                                            </a>

                                            {{-- Edit --}}
                                            <a href="{{ route('uraians.edit', ['pelatihan' => $pelatihan, 'uraian' => $uraian]) }}"
                                               class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-all shadow-2xs" 
                                               title="Edit">
                                                <i class="fa-solid fa-pen-to-square text-xs"></i>
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('uraians.destroy', ['pelatihan' => $pelatihan, 'uraian' => $uraian]) }}" method="POST" 
                                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all shadow-2xs" 
                                                        title="Hapus">
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
                            <td colspan="{{ auth()->check() && auth()->user()->role == 'admin' ? 8 : 7 }}" class="py-12 text-center bg-white">
                                <div class="max-w-xs mx-auto text-center space-y-2">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-lg shadow-inner">
                                        <i class="fa-regular fa-folder-open"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Belum ada data uraian kegiatan</p>
                                    <p class="text-[11px] text-slate-400">Tidak ada data yang cocok dengan kriteria filter Anda.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        @if($uraians->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $uraians->withQueryString()->links() }}
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