@extends('layouts.app')

@section('title', 'Data Pelatihan')

@section('content')

    <div class="space-y-6 pb-12">

        {{-- 1. Header Minimalis & Navigasi Utama --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200/80">
            <div>
                <div class="flex items-center gap-2.5">
                    <span class="relative flex h-2.5 w-2.5">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-600"></span>
                    </span>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                        Data <span class="text-indigo-600 font-extrabold">Pelatihan</span>
                    </h1>
                </div>
                <p class="text-xs text-slate-500 font-medium mt-1">
                    Daftar seluruh pelatihan yang sedang berlangsung.
                </p>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center gap-2 px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all duration-200 active:scale-95 border border-slate-200/60">
                    <i class="fa-solid fa-arrow-left text-[11px]"></i>
                    <span>Dashboard</span>
                </a>

                @auth
                    @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                        <a href="{{ route('pelatihans.create') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow-md transition-all duration-200 active:scale-95">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            <span>Tambah Pelatihan</span>
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        {{-- Alert Success dengan Accent Emerald Soft --}}
        @if(session('success'))
            <div
                class="p-4 rounded-2xl bg-emerald-50/80 border border-emerald-200/80 text-emerald-800 text-xs font-semibold flex items-center gap-3 shadow-xs">
                <span
                    class="w-6 h-6 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center shrink-0 text-xs">
                    <i class="fa-solid fa-circle-check"></i>
                </span>
                <div class="flex-1">{{ session('success') }}</div>
            </div>
        @endif

        {{-- 2. Filter Bar & Form Pencarian Modern --}}
        <div class="bg-white rounded-2xl p-4 border border-slate-200/60 shadow-sm">
            <form method="GET" action="{{ route('pelatihans.index') }}">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3">

                    {{-- Input Search --}}
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari nama pelatihan..."
                            class="w-full pl-9 pr-4 py-2 bg-slate-50/60 border border-slate-200/80 text-slate-700 text-xs font-semibold rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all placeholder:text-slate-400">
                    </div>

                    {{-- Select Tahapan --}}
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-indigo-500 text-xs">
                            <i class="fa-solid fa-layer-group"></i>
                        </div>
                        <select name="tahapan"
                            class="w-full pl-9 pr-8 py-2 bg-slate-50/60 border border-slate-200/80 text-slate-700 text-xs font-semibold rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all appearance-none cursor-pointer">
                            <option value="">Semua Tahapan</option>
                            <option value="Persiapan" {{ request('tahapan') == 'Persiapan' ? 'selected' : '' }}>Persiapan
                            </option>
                            <option value="Pelaksanaan" {{ request('tahapan') == 'Pelaksanaan' ? 'selected' : '' }}>
                                Pelaksanaan</option>
                            <option value="Evaluasi" {{ request('tahapan') == 'Evaluasi' ? 'selected' : '' }}>Evaluasi
                            </option>
                        </select>
                        <div
                            class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400 text-xs">
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl shadow-xs hover:shadow transition-all duration-200 flex items-center justify-center gap-2 active:scale-95">
                        <i class="fa-solid fa-magnifying-glass text-[11px]"></i>
                        <span>Cari</span>
                    </button>

                    {{-- Reset Button --}}
                    <a href="{{ route('pelatihans.index') }}"
                        class="w-full py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold rounded-xl transition-all duration-200 flex items-center justify-center gap-2 border border-slate-200/60 active:scale-95">
                        <i class="fa-solid fa-rotate-left text-[11px]"></i>
                        <span>Reset</span>
                    </a>

                </div>
            </form>
        </div>

        {{-- 3. Tabel Data Pelatihan Elegant --}}
        <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
            <div class="overflow-x-auto custom-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr
                            class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                            <th class="py-3.5 px-4 text-center w-12">No</th>
                            <th class="py-3.5 px-4 min-w-[200px]">Nama Pelatihan</th>
                            <th class="py-3.5 px-4 whitespace-nowrap">Tahapan</th>
                           
                            <th class="py-3.5 px-4 whitespace-nowrap">Hari / Tanggal</th>
                            <th class="py-3.5 px-4 whitespace-nowrap">Tempat</th>
                            <th class="py-3.5 px-4 w-40">Progress</th>
                            @auth
                                @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                                    <th class="py-3.5 px-4 text-center whitespace-nowrap w-16">Favorit</th>
                                    <th class="py-3.5 px-4 text-center whitespace-nowrap w-24">Aksi</th>
                                @endif
                            @endauth
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                        @forelse($pelatihans as $pelatihan)
                            <tr data-href="{{ route('pelatihans.show', $pelatihan) }}"
                                class="pelatihan-row group cursor-pointer hover:bg-indigo-50/40 transition duration-200">

                                {{-- Nomor --}}
                                <td class="py-4 px-4 text-center text-slate-400 font-semibold align-middle">
                                    {{ $pelatihans->firstItem() + $loop->index }}
                                </td>

                                {{-- Nama Pelatihan --}}
                                <td class="py-4 px-4 align-middle">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 font-bold text-xs group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-xs">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </div>
                                        <div
                                            class="font-bold text-slate-800 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-snug">
                                            {{ $pelatihan->nama_pelatihan }}
                                        </div>
                                    </div>
                                </td>

                                {{-- Tahapan --}}
<td class="py-4 px-4 whitespace-nowrap align-middle ignore-row-click">

    @php
        $tahapanClass = match ($pelatihan->tahapan) {
            'Persiapan' => 'bg-amber-50 text-amber-700 border-amber-100',
            'Pelaksanaan' => 'bg-sky-50 text-sky-700 border-sky-100',
            'Evaluasi' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
            default => 'bg-slate-100 text-slate-600 border-slate-200'
        };
    @endphp

    @auth
        @if(in_array(auth()->user()->role, ['admin', 'superadmin']))

            <select
                class="tahapan-select px-2.5 py-1 border font-bold rounded-lg text-[10px] tracking-wide cursor-pointer {{ $tahapanClass }}"
                data-url="{{ route('pelatihans.updateTahapan', $pelatihan) }}">

                <option value="Persiapan" {{ $pelatihan->tahapan == 'Persiapan' ? 'selected' : '' }}>
                    Persiapan
                </option>

                <option value="Pelaksanaan" {{ $pelatihan->tahapan == 'Pelaksanaan' ? 'selected' : '' }}>
                    Pelaksanaan
                </option>

                <option value="Evaluasi" {{ $pelatihan->tahapan == 'Evaluasi' ? 'selected' : '' }}>
                    Evaluasi
                </option>

            </select>

        @else

            <span class="px-2.5 py-1 border font-bold rounded-lg text-[10px] tracking-wide inline-block {{ $tahapanClass }}">
                {{ $pelatihan->tahapan }}
            </span>

        @endif
    @else

        <span class="px-2.5 py-1 border font-bold rounded-lg text-[10px] tracking-wide inline-block {{ $tahapanClass }}">
            {{ $pelatihan->tahapan }}
        </span>

    @endauth

</td>

                                {{-- Kegiatan --}}
                              

                                {{-- Hari / Tanggal --}}
                                <td class="py-4 px-4 whitespace-nowrap align-middle">
                                    <div class="space-y-0.5">
                                        <span class="block font-bold text-slate-800">{{ $pelatihan->hari }}</span>
                                        <span class="text-[10px] text-slate-400 font-semibold">
                                            {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Tempat --}}
                                <td class="py-4 px-4 whitespace-nowrap align-middle">
                                    <span
                                        class="px-2.5 py-1 bg-slate-100 text-slate-600 font-semibold rounded-md text-[11px] inline-flex items-center gap-1.5">
                                        <i class="fa-solid fa-location-dot text-[10px] text-slate-400"></i>
                                        {{ $pelatihan->tempat }}
                                    </span>
                                </td>

                                {{-- Progress Bar Gradien --}}
                                <td class="py-4 px-4 whitespace-nowrap align-middle">
                                    <div class="space-y-1">
                                        <div class="flex justify-between items-center text-[11px]">
                                            <span
                                                class="font-black text-indigo-600 progress-value">{{ $pelatihan->persen }}%</span>
                                            <span class="text-[10px] text-slate-400 font-semibold">
                                                {{ $pelatihan->persen == 100 ? 'Selesai' : 'Progress' }}
                                            </span>
                                        </div>
                                        <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                                            <div class="progress-bar bg-gradient-to-r from-indigo-500 to-sky-400 h-full rounded-full transition-all duration-500"
                                                style="width: {{ $pelatihan->persen }}%">
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Logika Auth Admin --}}
                                @auth
                                    @if(in_array(auth()->user()->role, ['admin', 'superadmin']))

                                        {{-- FAVORIT --}}
                                        <td class="py-4 px-4 text-center whitespace-nowrap align-middle">
                                        <form action="{{ route('pelatihans.favorite', $pelatihan) }}" method="POST"
                                            class="ignore-row-click inline-block">
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="w-8 h-8 rounded-lg hover:bg-slate-100 flex items-center justify-center transition-all group/star">

                                                
                                                
                                                @if($pelatihan->favorit)
                                                    <i class="fa-solid fa-star text-amber-400"></i>
                                                @else
                                                    <i class="fa-regular fa-star text-slate-300"></i>
                                                @endif

                                            </button>
                                        </form>
                                    </td>

                                        {{-- AKSI --}}
                                        <td class="py-4 px-4 text-center whitespace-nowrap align-middle">
                                            <div class="flex items-center justify-center gap-1.5">
                                                {{-- Edit --}}
                                                <a href="{{ route('pelatihans.edit', $pelatihan) }}"
                                                    class="ignore-row-click w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-all shadow-2xs"
                                                    title="Edit">
                                                    <i class="fa-solid fa-pen-to-square text-xs"></i>
                                                </a>

                                                {{-- Hapus --}}
                                                <form id="delete-pelatihan-{{ $pelatihan->id }}" 
      action="{{ route('pelatihans.destroy', $pelatihan) }}" 
      method="POST" 
      class="ignore-row-click inline">
    @csrf
    @method('DELETE')
    <button type="button"
            onclick="event.stopPropagation(); confirmDeletePelatihan('delete-pelatihan-{{ $pelatihan->id }}', '{{ addslashes($pelatihan->nama_pelatihan ?? $pelatihan->nama ?? 'pelatihan ini') }}')"
            class="ignore-row-click w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all duration-200 shadow-2xs"
            title="Hapus Pelatihan">
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
                                <td
                                    colspan="{{ auth()->check() && in_array(auth()->user()->role, ['admin', 'superadmin']) ? 9 : 7 }}">
                                    <div class="max-w-xs mx-auto text-center space-y-2">
                                        <div
                                            class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-lg shadow-inner">
                                            <i class="fa-regular fa-folder-open"></i>
                                        </div>
                                        <p class="text-xs font-bold text-slate-700">Belum ada data pelatihan</p>
                                        <p class="text-[11px] text-slate-400">Tidak ada data yang cocok dengan kriteria
                                            pencarian Anda.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                    <div class="mt-6">
                        {{ $pelatihans->links() }}
                    </div>
            </div>
        </div>

    </div>

    <style>
        /* Custom Scrollbar Tipis & Halus untuk Tabel Wide */
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

    {{-- Library SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', () => {

        // 1. Handling Klik Baris Tabel Pelatihan (Mengabaikan elemen ber-class .ignore-row-click)
        document.querySelectorAll('.pelatihan-row').forEach(row => {
            row.addEventListener('click', e => {
                if (!e.target.closest('.ignore-row-click')) {
                    window.location.href = row.dataset.href;
                }
            });
        });

        // 2. Handling Perubahan Dropdown Tahapan Pelatihan (AJAX PATCH)
        document.querySelectorAll('.tahapan-select').forEach(select => {

            select.dataset.oldValue = select.value;

            select.addEventListener('change', function () {
                const tahapan = this.value;
                const old = this.dataset.oldValue;
                const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

                // Visual Feedback: Disable Dropdown & Kursor Loading
                this.disabled = true;
                this.classList.add('opacity-50', 'cursor-wait', 'pointer-events-none');

                fetch(this.dataset.url, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ tahapan })
                })
                .then(res => {
                    if (!res.ok) throw new Error('Terjadi kesalahan pada server.');
                    return res.json();
                })
                .then(data => {
                    if (data.success) {
                        // Update Style Badge Tahapan
                        updateTahapanStyle(this, tahapan);
                        this.dataset.oldValue = tahapan;

                        // Update Nilai Persentase & Progress Bar di Tabel
                        const row = this.closest('tr');
                        if (row) {
                            const persenEl = row.querySelector('.progress-value');
                            const barEl = row.querySelector('.progress-bar');

                            if (persenEl && data.persen !== undefined) {
                                persenEl.textContent = data.persen + '%';
                            }
                            if (barEl && data.persen !== undefined) {
                                barEl.style.width = data.persen + '%';
                            }
                        }

                        // Tampilkan Toast Sukses
                        showToast('Tahapan berhasil diperbarui', 'success');
                    } else {
                        throw new Error(data.message || 'Gagal menyimpan perubahan');
                    }
                })
                .catch(err => {
                    // Revert Nilai Select ke Nilai Sebelum Perubahan & Tampilkan Toast Error
                    this.value = old;
                    showToast(err.message || 'Gagal menyimpan perubahan', 'error');
                })
                .finally(() => {
                    // Kembalikan State Select ke Normal
                    this.disabled = false;
                    this.classList.remove('opacity-50', 'cursor-wait', 'pointer-events-none');
                });
            });
        });
    });

    /**
     * SweetAlert Modal Konfirmasi Hapus Pelatihan
     */
    function confirmDeletePelatihan(formId, namaPelatihan) {
        Swal.fire({
            title: 'Hapus Pelatihan?',
            text: `Data pelatihan "${namaPelatihan}" akan dihapus permanen beserta seluruh rekapan di dalamnya.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e11d48', // Rose-600
            cancelButtonColor: '#94a3b8',  // Slate-400
            confirmButtonText: '<i class="fa-solid fa-trash text-xs mr-1"></i> Ya, Hapus Data',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl p-6 font-sans',
                title: 'text-lg font-bold text-slate-800',
                htmlContainer: 'text-xs text-slate-500 mt-2',
                confirmButton: 'px-4 py-2.5 text-xs font-semibold rounded-xl shadow-sm',
                cancelButton: 'px-4 py-2.5 text-xs font-semibold rounded-xl'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }

    /**
     * Helper Function: Mengubah Style Badge Select Tahapan Pelatihan
     */
    function updateTahapanStyle(select, tahapan) {
        const colorClasses = [
            'bg-amber-50', 'text-amber-700', 'border-amber-100', 'border-amber-200',
            'bg-sky-50', 'text-sky-700', 'border-sky-100', 'border-sky-200',
            'bg-emerald-50', 'text-emerald-700', 'border-emerald-100', 'border-emerald-200'
        ];
        select.classList.remove(...colorClasses);

        const styleMap = {
            'Persiapan': ['bg-amber-50', 'text-amber-700', 'border-amber-200'],
            'Pelaksanaan': ['bg-sky-50', 'text-sky-700', 'border-sky-200'],
            'Evaluasi': ['bg-emerald-50', 'text-emerald-700', 'border-emerald-200']
        };

        if (styleMap[tahapan]) {
            select.classList.add(...styleMap[tahapan]);
        }
    }

    /**
     * Helper Function: Pop-up Toast Alert Interaktif (SweetAlert2)
     */
    function showToast(message, iconType = 'success') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            },
            customClass: {
                popup: 'rounded-2xl shadow-xl border border-slate-100 bg-white p-3.5 font-sans',
                title: 'text-xs font-bold text-slate-800'
            }
        });

        Toast.fire({
            icon: iconType,
            title: message,
            iconColor: iconType === 'success' ? '#10b981' : '#f43f5e'
        });
    }
</script>

@endsection