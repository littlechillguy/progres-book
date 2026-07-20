@extends('layouts.app')

@section('title', $pelatihan->nama_pelatihan)

@section('content')
    <div class="space-y-6 max-w-7xl mx-auto">

        {{-- Header Card --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div class="flex flex-col md:flex-row justify-between items-start gap-4">
                <div class="flex-1">
                    <a href="{{ route('pelatihans.index') }}"
                        class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 font-medium transition-colors mb-2">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                    </a>

                    <h1 class="text-2xl md:text-3xl font-bold text-slate-800 tracking-tight">
                        {{ $pelatihan->nama_pelatihan }}
                    </h1>

                    <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-2 text-sm text-slate-600 font-medium">
                        <span class="bg-slate-100 px-2.5 py-1 rounded-md">{{ $pelatihan->tahapan }}</span>
                        <span class="text-slate-300">•</span>
                        <span><i class="fa-regular fa-calendar mr-1"></i> {{ $pelatihan->hari }},
                            {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }}</span>
                        <span class="text-slate-300">•</span>
                        <span><i class="fa-solid fa-location-dot mr-1"></i> {{ $pelatihan->tempat }}</span>
                    </div>
                </div>

            </div>

            {{-- Progress Bar --}}
            <div class="mt-6 pt-5 border-t border-slate-100">
                <div class="flex justify-between items-end mb-2">
                    <span class="text-sm font-semibold text-slate-700">Progress Pelatihan</span>
                    <span class="text-sm font-bold {{ $progress == 100 ? 'text-green-600' : 'text-indigo-600' }}">
                        {{ $progress }}% <span
                            class="text-slate-500 font-normal text-xs ml-1">({{ $selesai }}/{{ $total }})</span>
                    </span>
                </div>
                <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                    <div class="h-2.5 rounded-full transition-all duration-700 ease-in-out {{ $progress == 100 ? 'bg-green-500' : 'bg-indigo-600' }}"
                        style="width: {{ $progress }}%"></div>
                </div>
            </div>
        </div>

        {{-- Main Content Card (Toolbar + Table) --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- Toolbar Filter --}}
            <div class="p-5 border-b border-slate-200 bg-slate-50/50">

                <form method="GET" action="{{ route('pelatihans.show', $pelatihan->id) }}">

                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">

                        {{-- Search --}}
                        <div class="md:col-span-5 relative">

                            <div
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-search text-sm"></i>
                            </div>

                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Cari uraian kegiatan atau PIC..."
                                class="w-full pl-9 pr-4 py-2 text-sm border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition">

                        </div>

                        {{-- Status --}}
                        <div class="md:col-span-2">

                            <select name="progres"
                                class="w-full py-2 px-3 text-sm border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition cursor-pointer">

                                <option value="">Semua Status</option>

                                <option value="selesai" {{ request('progres') == 'selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>

                                <option value="on progress" {{ request('progres') == 'on progress' ? 'selected' : '' }}>
                                    On Progress
                                </option>

                                <option value="belum" {{ request('progres') == 'belum' ? 'selected' : '' }}>
                                    Belum
                                </option>

                            </select>

                        </div>

                        {{-- Tanggal --}}
                        <div class="md:col-span-2">

                            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                                class="w-full py-2 px-3 text-sm border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition">

                        </div>

                        {{-- Button --}}
                        <div class="md:col-span-3 flex gap-2">

                            <button type="submit"
                                class="flex-1 bg-slate-800 hover:bg-slate-900 text-white rounded-lg text-sm font-semibold transition-colors shadow-sm py-2">

                                <i class="fa-solid fa-filter mr-2"></i>
                                Filter

                            </button>

                            <a href="{{ route('pelatihans.show', $pelatihan->id) }}"
                                class="flex-1 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 rounded-lg text-sm font-semibold flex items-center justify-center transition-colors shadow-sm py-2">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>

            <div class="flex justify-between items-center mb-6 pt-3 px-6">

                <div>
                    <h2 class="text-2xl font-bold text-slate-800">
                        Uraian Kegiatan
                    </h2>

                    <p class="text-slate-500 text-sm mt-1">
                        Daftar uraian kegiatan pelatihan.
                    </p>
                </div>

                @auth
                    @if(auth()->user()->role == 'admin')

                        <a href="{{ route('uraians.create', $pelatihan) }}"
                            class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-semibold shadow-sm transition">

                            <i class="fa-solid fa-plus"></i>

                            Tambah Data

                        </a>

                    @endif
                @endauth

            </div>

            {{-- Table --}}
            <div class="overflow-hidden rounded-lg">
                <!-- Ubah overflow-x-auto menjadi overflow-hidden jika ingin paksa tanpa scroll -->
                <table class="w-full text-left text-sm text-slate-600 table-fixed">
                    <thead class="bg-slate-50 text-slate-700 uppercase text-xs font-semibold border-b border-slate-200">
                        <tr>
                            <th class="px-2 py-3 text-center w-12">No</th>
                            <th class="px-3 py-3 w-3/12">Uraian Kegiatan</th>
                            <th class="px-2 py-3 w-24">Tanggal</th>
                            <th class="px-2 py-3 text-center w-28">Status</th>
                            <th class="px-2 py-3 w-24">PIC</th>
                            <th class="px-3 py-3 w-32">Lampiran</th>
                            <th class="px-3 py-3 w-2/12">Keterangan</th>
                            @auth
                                @if(auth()->user()->role == 'admin')
                                    <th class="px-2 py-3 text-center w-24">Aksi</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($uraians as $index => $uraian)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                {{-- No --}}
                                <td class="px-2 py-3 text-center font-medium text-slate-900 align-top">
                                    {{ $uraians->firstItem() + $index }}
                                </td>

                                {{-- Uraian Kegiatan --}}
                                <td class="px-3 py-3 font-medium text-slate-800 align-top">
                                    {{ $uraian->uraian_kegiatan }}
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-2 py-3 text-slate-500 text-xs align-top">
                                    {{ \Carbon\Carbon::parse($uraian->tanggal)->format('d M Y') }}
                                </td>

                                {{-- Status --}}
                                <td class="px-2 py-3 text-center align-top">

                                    @if($uraian->progres == 'selesai')

                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-green-50 text-green-700 ring-1 ring-inset ring-green-600/20">
                                            Selesai
                                        </span>

                                        @if($uraian->tanggal_selesai)
                                            <div class="mt-1 text-[11px] text-slate-500">
                                                {{ \Carbon\Carbon::parse($uraian->tanggal_selesai)->translatedFormat('d M Y') }}
                                            </div>
                                        @endif

                                    @elseif($uraian->progres == 'on progress')

                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-amber-50 text-amber-700 ring-1 ring-inset ring-amber-600/20">
                                            On Progress
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-medium bg-red-50 text-red-700 ring-1 ring-inset ring-red-600/10">
                                            Belum
                                        </span>

                                    @endif

                                </td>

                                {{-- PIC --}}
                                <td class="px-2 py-3 font-medium text-slate-700 text-xs align-top truncate">
                                    {{ $uraian->pic ?? '-' }}
                                </td>

                                {{-- Lampiran --}}
                                <td class="px-3 py-3 align-top">
                                    @if($uraian->lampiran)
                                        <a href="{{ route('uraians.show', $uraian) }}"
                                            class="inline-flex items-center gap-1.5 text-indigo-600 hover:text-indigo-800 transition group max-w-full"
                                            title="{{ $uraian->lampiran_nama }}">
                                            <i class="fa-solid {{ $uraian->fileIcon() }} text-sm"></i>
                                            <span class="text-xs font-semibold truncate max-w-[80px] group-hover:underline">
                                                {{ $uraian->lampiran_nama }}
                                            </span>
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-xs italic">-</span>
                                    @endif
                                </td>

                                {{-- Keterangan --}}
                                <td class="px-3 py-3 text-slate-500 text-xs align-top truncate"
                                    title="{{ $uraian->keterangan }}">
                                    {{ $uraian->keterangan ?? '-' }}
                                </td>

                                {{-- Aksi --}}
                                @auth
                                    @if(auth()->user()->role == 'admin')
                                        <td class="px-2 py-3 align-top">
                                            <div class="flex justify-center items-center gap-3">
                                                {{-- Detail --}}
                                                <a href="{{ route('uraians.show', $uraian) }}"
                                                    class="text-sky-600 hover:text-sky-800 transition-colors" title="Detail">
                                                    <i class="fa-solid fa-eye text-sm"></i>
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('uraians.edit', ['pelatihan' => $pelatihan, 'uraian' => $uraian]) }}"
                                                    class="text-amber-500 hover:text-amber-700 transition-colors" title="Edit">
                                                    <i class="fa-solid fa-pen text-sm"></i>
                                                </a>

                                                {{-- Hapus --}}
                                                <form
                                                    action="{{ route('uraians.destroy', ['pelatihan' => $pelatihan, 'uraian' => $uraian]) }}"
                                                    method="POST" class="inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-800 transition-colors"
                                                        title="Hapus">
                                                        <i class="fa-solid fa-trash text-sm"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    @endif
                                @endauth
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-12 text-center">
                                    <div class="inline-flex flex-col items-center justify-center">
                                        <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3"></i>
                                        <p class="text-slate-500 font-medium">Belum ada data uraian kegiatan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            @if($uraians->hasPages())
                <div class="px-5 py-4 border-t border-slate-200 bg-white">
                    {{-- withQueryString() berguna agar filter pencarian tidak hilang saat pindah halaman --}}
                    {{ $uraians->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection