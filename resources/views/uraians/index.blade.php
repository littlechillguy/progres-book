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

                    <div class="flex justify-between items-center">

                        <div class="flex flex-col">
                            <span class="font-bold text-slate-700 text-xs">
                                Progress Total
                            </span>

                            <span class="text-[11px] font-semibold text-indigo-600">
                                {{ $pelatihan->nama_pelatihan }}
                            </span>
                        </div>

                        <span class="font-black {{ $progress == 100 ? 'text-emerald-600' : 'text-indigo-600' }}">
                            {{ $progress }}%
                            <span class="text-slate-400 font-semibold text-[10px] ml-0.5">
                                ({{ $selesai }}/{{ $total }})
                            </span>
                        </span>

                    </div>

                    <div class="w-full bg-slate-200/70 rounded-full h-2 overflow-hidden">
                        <div class="h-2 rounded-full transition-all duration-700 ease-in-out {{ $progress == 100 ? 'bg-emerald-500' : 'bg-gradient-to-r from-indigo-500 to-sky-400' }}"
                            style="width: {{ $progress }}%">
                        </div>
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
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari uraian kegiatan atau PIC..."
                            class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">
                    </div>

                    {{-- Tahapan --}}
                    <div class="md:col-span-2 relative">

                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-indigo-500 text-xs">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>

                        <select name="tahapan"
                            class="w-full pl-9 pr-8 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">

                            <option value="">Semua Tahapan</option>

                            <option value="Persiapan" {{ request('tahapan') == 'Persiapan' ? 'selected' : '' }}>
                                Persiapan
                            </option>

                            <option value="Pelaksanaan" {{ request('tahapan') == 'Pelaksanaan' ? 'selected' : '' }}>
                                Pelaksanaan
                            </option>

                            <option value="Evaluasi" {{ request('tahapan') == 'Evaluasi' ? 'selected' : '' }}>
                                Evaluasi
                            </option>

                        </select>

                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </div>

                    </div>

                    {{-- Status --}}
                    <div class="md:col-span-2 relative">

                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-indigo-500 text-xs">
                            <i class="fa-solid fa-list-check"></i>
                        </div>

                        <select name="progres"
                            class="w-full pl-9 pr-8 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl appearance-none focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">

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

                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </div>

                    </div>

                    {{-- Tanggal --}}
                    <div class="md:col-span-2">

                        <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                            class="w-full px-3 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500">

                    </div>

                    {{-- Tombol --}}
                    <div class="md:col-span-2 flex gap-2">

                        <button type="submit"
                            class="flex-1 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2">

                            <i class="fa-solid fa-filter text-[11px]"></i>
                            Filter

                        </button>

                        <a href="{{ route('pelatihans.show', $pelatihan->id) }}"
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
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse align-middle">
                <thead>
                    <tr
                        class="bg-slate-50/80 border-b border-slate-200 text-[11px] uppercase font-bold tracking-wider text-slate-500">
                        <th class="py-3.5 px-3 text-center w-10">No</th>
                        <th class="py-3.5 px-3 whitespace-nowrap">Tahapan</th>
                        <th class="py-3.5 px-3">Uraian Kegiatan</th>
                        <th class="py-3.5 px-3 whitespace-nowrap">Tanggal</th>
                        <th class="py-3.5 px-3 text-center whitespace-nowrap">Status</th>
                        <th class="py-3.5 px-3 whitespace-nowrap">PIC</th>
                        <th class="py-3.5 px-3 whitespace-nowrap">Lampiran</th>
                        <th class="py-3.5 px-3">Keterangan</th>
                        @auth
                            @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                                <th class="py-3.5 px-3 text-center whitespace-nowrap">Aksi</th>
                            @endif
                        @endauth
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($uraians as $index => $uraian)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            {{-- Nomor --}}
                            <td class="px-3 py-4 text-center text-slate-400 font-semibold text-xs whitespace-nowrap">
                                {{ $uraians->firstItem() + $index }}
                            </td>

                            {{-- Tahapan --}}
                            <td class="px-3 py-4 whitespace-nowrap">
                                @php
                                    $badgeTahapan = match ($uraian->tahapan) {
                                        'Persiapan' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                        'Pelaksanaan' => 'bg-sky-50 text-sky-700 ring-sky-600/20',
                                        'Evaluasi' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                                        default => 'bg-slate-50 text-slate-600 ring-slate-500/20'
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset {{ $badgeTahapan }}">
                                    {{ $uraian->tahapan }}
                                </span>
                            </td>

                            {{-- Uraian --}}
                            <td class="px-3 py-4 font-semibold text-slate-800 leading-relaxed break-words">
                                {{ $uraian->uraian_kegiatan }}
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-3 py-4 whitespace-nowrap text-slate-600 text-xs">
                                <div class="font-medium text-slate-700">
                                    {{ \Carbon\Carbon::parse($uraian->tanggal)->translatedFormat('d M Y') }}
                                </div>
                                @if($uraian->tanggal_selesai)
                                    <div class="text-[11px] text-emerald-600 mt-1 font-medium flex items-center gap-1">
                                        <i class="fa-solid fa-circle-check text-[10px]"></i>
                                        <span>Selesai:
                                            {{ \Carbon\Carbon::parse($uraian->tanggal_selesai)->translatedFormat('d M Y') }}</span>
                                    </div>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td class="px-3 py-4 text-center whitespace-nowrap">
                                @php
                                    $badgeStatus = match (strtolower($uraian->progres)) {
                                        'belum' => 'bg-rose-50 text-rose-700 ring-rose-600/20',
                                        'on progress' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                        'selesai' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                                        default => 'bg-slate-50 text-slate-700 ring-slate-500/20'
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold ring-1 ring-inset {{ $badgeStatus }}">
                                    {{ ucfirst($uraian->progres) }}
                                </span>
                            </td>

                            {{-- PIC --}}
                            <td class="px-3 py-4 whitespace-nowrap">
                                <span
                                    class="inline-block bg-slate-100 text-slate-700 px-2.5 py-1 rounded-lg text-xs font-medium">
                                    {{ $uraian->pic }}
                                </span>
                            </td>

                            {{-- Lampiran --}}
                            <td class="px-3 py-4 whitespace-nowrap">
                                @if($uraian->lampiran)
                                    <a href="{{ route('uraians.show', $uraian) }}"
                                        class="inline-flex items-center gap-1.5 text-xs font-medium text-sky-600 hover:text-sky-800 transition-colors bg-sky-50 hover:bg-sky-100 px-2.5 py-1.5 rounded-lg border border-sky-100 group">
                                        <i
                                            class="fa-solid {{ $uraian->fileIcon() }} text-sky-500 group-hover:scale-110 transition-transform"></i>
                                        <span class="truncate max-w-[100px]">
                                            {{ Str::limit($uraian->lampiran_nama, 15) }}
                                        </span>
                                    </a>
                                @else
                                    @auth
                                        @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                                            <div class="upload-wrapper">
                                                <input type="file" class="hidden upload-input"
                                                    data-url="{{ route('uraians.upload', $uraian) }}">
                                                <button type="button"
                                                    class="upload-btn inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-sky-600 hover:bg-sky-700 text-white text-xs font-medium transition-colors shadow-sm">
                                                    <i class="fa-solid fa-cloud-arrow-up text-xs"></i>
                                                    <span>Upload</span>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-slate-400 text-xs">-</span>
                                        @endif
                                    @else
                                        <span class="text-slate-400 text-xs">-</span>
                                    @endauth
                                @endif
                            </td>

                            {{-- Keterangan --}}
                            <td class="px-3 py-4 text-xs text-slate-500 break-words">
                                {{ $uraian->keterangan ?: '-' }}
                            </td>

                            {{-- Aksi --}}
                            <td class="px-3 py-4 whitespace-nowrap">
                                <div class="flex items-center justify-center gap-1.5">

                                    {{-- Lihat Detail (Publik) --}}
                                    <a href="{{ route('uraians.show', $uraian) }}" title="Lihat Detail"
                                        class="w-8 h-8 rounded-lg bg-slate-100 hover:bg-sky-600 hover:text-white text-slate-600 flex items-center justify-center transition-colors">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>

                                    @auth
                                        @if(in_array(auth()->user()->role, ['admin', 'superadmin']))

                                            {{-- Edit --}}
                                            <a href="{{ route('uraians.edit', [$pelatihan, $uraian]) }}" title="Edit Data"
                                                class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-500 hover:text-white text-amber-600 flex items-center justify-center transition-colors">
                                                <i class="fa-solid fa-pen text-xs"></i>
                                            </a>

                                            {{-- Delete --}}
                                            <form action="{{ route('uraians.destroy', [$pelatihan, $uraian]) }}" method="POST"
                                                class="delete-form">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" title="Hapus Data"
                                                    class="w-8 h-8 rounded-lg bg-rose-50 hover:bg-rose-600 hover:text-white text-rose-600 flex items-center justify-center transition-colors">
                                                    <i class="fa-solid fa-trash text-xs"></i>
                                                </button>
                                            </form>

                                        @endif
                                    @endauth

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin']) ? 9 : 8 }}"
                                class="py-12 text-center text-slate-500">
                                <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fa-regular fa-folder-open text-xl text-slate-400"></i>
                                </div>
                                <p class="font-semibold text-slate-700 text-sm">Belum ada data uraian</p>
                                <p class="text-xs text-slate-400 mt-0.5">Uraian kegiatan untuk pelatihan ini belum ditambahkan.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if($uraians->hasPages())
                <div class="border-t border-slate-100 px-5 py-3.5 bg-slate-50/50">
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Upload Lampiran
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('.upload-btn').forEach(function (btn) {

                btn.addEventListener('click', function () {

                    this.closest('.upload-wrapper')
                        .querySelector('.upload-input')
                        .click();

                });

            });

            document.querySelectorAll('.upload-input').forEach(function (input) {

                input.addEventListener('change', function () {

                    if (this.files.length === 0) return;

                    const file = this.files[0];

                    const formData = new FormData();
                    formData.append('lampiran', file);

                    fetch(this.dataset.url, {

                        method: 'POST',

                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },

                        body: formData

                    })
                        .then(res => {

                            if (!res.ok) {
                                throw new Error('Upload gagal');
                            }

                            return res.json();

                        })
                        .then(data => {

                            if (data.success) {

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: 'Lampiran berhasil diunggah.',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {

                                    location.reload();

                                });

                            }

                        })
                        .catch(err => {

                            console.error(err);

                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Upload lampiran gagal.'
                            });

                        });

                });

            });


            /*
            |--------------------------------------------------------------------------
            | Hapus Uraian
            |--------------------------------------------------------------------------
            */

            document.querySelectorAll('.delete-form').forEach(function (form) {

                form.addEventListener('submit', function (e) {

                    e.preventDefault();

                    Swal.fire({

                        title: 'Hapus uraian?',
                        text: 'Data yang dihapus tidak dapat dikembalikan.',
                        icon: 'warning',

                        showCancelButton: true,

                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#64748b',

                        confirmButtonText: 'Ya, Hapus',
                        cancelButtonText: 'Batal',

                        reverseButtons: true

                    }).then((result) => {

                        if (result.isConfirmed) {

                            form.submit();

                        }

                    });

                });

            });

        });
    </script>

@endsection