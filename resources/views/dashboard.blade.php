@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-6 pb-12">

    {{-- 1. Header Minimalis Modern --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200/80">
        <div>
            <div class="flex items-center gap-2.5">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-indigo-600"></span>
                </span>
                <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                    Dashboard <span class="text-indigo-600 font-extrabold">PRO-BOOK</span>
                </h1>
            </div>
            <p class="text-xs text-slate-500 font-medium mt-1">
                Monitoring pelaksanaan pelatihan pegawai Kementerian HAM secara terpusat.
            </p>
        </div>

        {{-- Filter Tahun dengan Style Glass Soft --}}
        <form method="GET" class="relative shrink-0">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-indigo-500 text-xs">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
            <select name="tahun" onchange="this.form.submit()" 
                class="pl-9 pr-9 py-2 bg-indigo-50/60 border border-indigo-100 text-slate-700 text-xs font-bold rounded-xl shadow-sm hover:bg-indigo-50 hover:border-indigo-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all appearance-none cursor-pointer">
                @for($i = date('Y'); $i >= 2024; $i--)
                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                        Tahun {{ $i }}
                    </option>
                @endfor
            </select>
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-slate-400 text-xs">
                <i class="fa-solid fa-chevron-down text-[10px]"></i>
            </div>
        </form>
    </div>

    {{-- 2. Stat Cards: Soft Pastel Accent + Elevated Hover --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        
        {{-- Card 1: Slate / Indigo Soft --}}
        <div class="group bg-gradient-to-br from-white via-white to-slate-50/80 rounded-2xl p-5 border border-slate-200/70 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Total Pelatihan</p>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight mt-1">{{ $pelatihans->count() }}</h2>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-600 flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-[11px]">
                <span class="text-slate-500 font-medium">Program Terdaftar</span>
                <span class="px-2 py-0.5 rounded-md bg-slate-100 text-slate-600 font-bold text-[10px]">Base</span>
            </div>
        </div>

        {{-- Card 2: Sky Soft --}}
        <div class="group bg-gradient-to-br from-white via-white to-sky-50/60 rounded-2xl p-5 border border-sky-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-sky-600/80 uppercase tracking-wider">Total Kegiatan</p>
                    <h2 class="text-3xl font-black text-sky-900 tracking-tight mt-1">{{ $totalKegiatanGlobal }}</h2>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-sky-100/80 text-sky-600 flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-sky-100/60 flex items-center justify-between text-[11px]">
                <span class="text-sky-700/70 font-medium">Uraian Pekerjaan</span>
                <span class="px-2 py-0.5 rounded-md bg-sky-100 text-sky-700 font-bold text-[10px]">Total</span>
            </div>
        </div>

        {{-- Card 3: Emerald Soft --}}
        <div class="group bg-gradient-to-br from-white via-white to-emerald-50/60 rounded-2xl p-5 border border-emerald-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-emerald-600/80 uppercase tracking-wider">Total Selesai</p>
                    <h2 class="text-3xl font-black text-emerald-900 tracking-tight mt-1">{{ $totalSelesaiGlobal }}</h2>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-100/80 text-emerald-600 flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-emerald-100/60 flex items-center justify-between text-[11px]">
                <span class="text-emerald-700/70 font-medium">Sudah Rampung</span>
                <span class="px-2 py-0.5 rounded-md bg-emerald-100 text-emerald-700 font-bold text-[10px]">Done</span>
            </div>
        </div>

        {{-- Card 4: Violet Soft --}}
        <div class="group bg-gradient-to-br from-white via-white to-violet-50/60 rounded-2xl p-5 border border-violet-100 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-[11px] font-bold text-violet-600/80 uppercase tracking-wider">Progress Global</p>
                    <h2 class="text-3xl font-black text-violet-900 tracking-tight mt-1">{{ $persenGlobal }}%</h2>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-violet-100/80 text-violet-600 flex items-center justify-center text-lg shadow-sm group-hover:scale-110 transition-transform duration-300">
                    <i class="fa-solid fa-chart-pie"></i>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-violet-100/60 flex items-center justify-between text-[11px]">
                <span class="text-violet-700/70 font-medium">Rata-rata Pencapaian</span>
                <span class="px-2 py-0.5 rounded-md bg-violet-100 text-violet-700 font-bold text-[10px]">Overall</span>
            </div>
        </div>

    </div>

    {{-- 3. Middle Section: Donut Chart, Top 5 Pelatihan, & Ringkasan --}}
    <div class="grid lg:grid-cols-3 gap-5">

        {{-- Donut Chart Status --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-slate-800 text-sm">Status Uraian</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Distribusi pengerjaan kegiatan</p>
                </div>
                <span class="w-8 h-8 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-chart-donut"></i>
                </span>
            </div>
            <div class="relative h-52 my-2 flex items-center justify-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        {{-- Top 5 Pelatihan --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-bold text-slate-800 text-sm">Top 5 Pelatihan</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Progres tertinggi saat ini</p>
                </div>
                <span class="w-8 h-8 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-trophy"></i>
                </span>
            </div>

            <div class="space-y-3.5">
                @forelse($topPelatihan as $item)
                    <div class="group">
                        <div class="flex justify-between items-center text-xs mb-1.5">
                            <span class="font-semibold text-slate-700 truncate pr-2 group-hover:text-indigo-600 transition-colors">{{ $item->nama_pelatihan }}</span>
                            <span class="font-bold text-indigo-600 bg-indigo-50/80 px-2 py-0.5 rounded-md text-[11px]">{{ $item->persen }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-500 to-sky-400 h-full rounded-full transition-all duration-500" style="width: {{ $item->persen }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10">
                        <i class="fa-solid fa-inbox text-slate-300 text-2xl mb-2"></i>
                        <p class="text-xs text-slate-400 font-medium">Belum ada data pelatihan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Ringkasan Tahunan --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-3">
                <div>
                    <h3 class="font-bold text-slate-800 text-sm">Ringkasan {{ $tahun }}</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Pencapaian kinerja tahunan</p>
                </div>
                <span class="w-8 h-8 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xs">
                    <i class="fa-solid fa-calendar-days"></i>
                </span>
            </div>

            <div class="space-y-2.5 flex-1 flex flex-col justify-center">
                {{-- Soft Emerald Card --}}
                <div class="p-3.5 rounded-xl bg-emerald-50/70 border border-emerald-100/80 flex items-center justify-between hover:border-emerald-200 transition-colors">
                    <span class="text-xs font-semibold text-emerald-800">Total Selesai</span>
                    <span class="text-sm font-black text-emerald-600">{{ $totalSelesaiTahun }} <span class="text-[10px] font-medium text-emerald-700/80">Kegiatan</span></span>
                </div>

                {{-- Soft Sky Card --}}
                <div class="p-3.5 rounded-xl bg-sky-50/70 border border-sky-100/80 flex items-center justify-between hover:border-sky-200 transition-colors">
                    <span class="text-xs font-semibold text-sky-800">Rata-rata / Bulan</span>
                    <span class="text-sm font-black text-sky-600">{{ $rataPerBulan }} <span class="text-[10px] font-medium text-sky-700/80">Kegiatan</span></span>
                </div>

                {{-- Soft Amber Card --}}
                <div class="p-3.5 rounded-xl bg-amber-50/70 border border-amber-100/80 flex items-center justify-between hover:border-amber-200 transition-colors">
                    <span class="text-xs font-semibold text-amber-800">Bulan Terbaik</span>
                    <span class="text-sm font-black text-amber-600">{{ $bulanTerbaik }}</span>
                </div>
            </div>
        </div>

    </div>

    {{-- 4. Bottom Section: Main Line Chart & Activity Log --}}
    <div class="grid lg:grid-cols-3 gap-5">

        {{-- Main Line Chart --}}
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm flex flex-col justify-between">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="font-bold text-slate-800 text-sm">Tren Penyelesaian Uraian</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Grafik perkembangan selama tahun {{ $tahun }}</p>
                </div>
                <span class="text-[11px] font-bold text-indigo-600 bg-indigo-50/80 border border-indigo-100 px-2.5 py-1 rounded-lg">
                    Data Bulanan
                </span>
            </div>

            <div class="relative w-full flex-1 min-h-[230px]">
                <canvas id="chartBulanan"></canvas>
            </div>
        </div>

        {{-- Activity Log --}}
        <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm flex flex-col h-[340px]">
            <div class="flex items-center justify-between pb-3 mb-3 border-b border-slate-100">
                <div>
                    <h3 class="font-bold text-slate-800 text-sm">Activity Log</h3>
                    <p class="text-[11px] text-slate-400 mt-0.5">Aktivitas user terbaru</p>
                </div>
                <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-bold rounded-full">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Live
                </span>
            </div>

            <div class="space-y-3 overflow-y-auto pr-1 custom-scrollbar flex-1">
                @forelse($activities as $activity)
                    <div class="flex gap-3 text-xs group p-1.5 hover:bg-slate-50/80 rounded-xl transition-colors">
                        <div class="w-7 h-7 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0 group-hover:bg-indigo-600 group-hover:text-white transition-all text-[10px] shadow-xs">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex justify-between items-baseline">
                                <p class="font-bold text-slate-800 truncate text-[11px] group-hover:text-indigo-600 transition-colors">{{ $activity->user->name ?? 'System' }}</p>
                                <span class="text-[10px] text-slate-400 font-medium shrink-0">{{ $activity->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-slate-500 mt-0.5 leading-relaxed truncate text-[11px]">{{ $activity->deskripsi }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <i class="fa-regular fa-bell-slash text-slate-300 text-2xl mb-2"></i>
                        <p class="text-xs text-slate-400 font-medium">Belum ada aktivitas terekam.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

{{-- Chart.js Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    Chart.defaults.font.family = 'ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';

    // 1. Line Chart Tren Penyelesaian (Polished Gradient Fill)
    new Chart(document.getElementById('chartBulanan'), {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Uraian Selesai',
                data: @json($chartData),
                borderColor: '#6366f1', // Indigo 500
                backgroundColor: (context) => {
                    const ctx = context.chart.ctx;
                    const gradient = ctx.createLinearGradient(0, 0, 0, 230);
                    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.18)');
                    gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');
                    return gradient;
                },
                borderWidth: 2.5,
                tension: 0.35,
                fill: true,
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#6366f1',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#6366f1',
                pointHoverBorderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    titleFont: { size: 11, weight: 'bold' },
                    bodyFont: { size: 11 },
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f8fafc', drawBorder: false },
                    ticks: { color: '#94a3b8', font: { size: 10, weight: '500' } }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#94a3b8', font: { size: 10, weight: '500' } }
                }
            }
        }
    });

    // 2. Donut Chart Status (Soft Pastel Tone)
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Belum', 'On Progress', 'Selesai'],
            datasets: [{
                data: [
                    {{ $statusChart['belum'] ?? 0 }},
                    {{ $statusChart['progress'] ?? 0 }},
                    {{ $statusChart['selesai'] ?? 0 }}
                ],
                backgroundColor: [
                    '#f43f5e', // Rose-500 (Soft Red)
                    '#f59e0b', // Amber-500 (Soft Orange/Yellow)
                    '#10b981'  // Emerald-500 (Soft Green)
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '75%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 14,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        color: '#64748b',
                        font: { size: 11, weight: '600' }
                    }
                }
            }
        }
    });
</script>

<style>
    /* Custom Scrollbar Tipis & Halus */
    .custom-scrollbar::-webkit-scrollbar {
        width: 3px;
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