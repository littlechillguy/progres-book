@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8 pb-10">

    {{-- 1. Header Section --}}
    <div class="flex flex-col lg:flex-row justify-between lg:items-end gap-5 border-b border-slate-200 pb-5">
        <div>
            <h1 class="text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600 tracking-tight pb-1">
                Dashboard PRO-BOOK
            </h1>
            <p class="text-slate-500 mt-1 font-medium">
                Monitoring seluruh progres pelaksanaan pelatihan pegawai.
            </p>
        </div>

        <form method="GET" class="relative group">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <i class="fa-regular fa-calendar text-indigo-500"></i>
            </div>
            <select name="tahun" onchange="this.form.submit()" 
                class="pl-10 pr-10 py-2.5 bg-white border border-slate-200 text-slate-700 text-sm font-bold rounded-xl shadow-sm hover:border-indigo-400 hover:ring-2 hover:ring-indigo-100 transition-all appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @for($i = date('Y'); $i >= 2024; $i--)
                    <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                        Tahun {{ $i }}
                    </option>
                @endfor
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                <i class="fa-solid fa-chevron-down text-slate-400 text-xs"></i>
            </div>
        </form>
    </div>

    {{-- 2. Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
        
        {{-- Card 1 --}}
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:shadow-slate-200/50 border border-slate-100 p-6 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full transition-transform duration-500 group-hover:scale-125"></div>
            <div class="relative">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Pelatihan</p>
                <h2 class="text-4xl font-black text-slate-800 mt-2">{{ $pelatihans->count() }}</h2>
            </div>
        </div>

        {{-- Card 2 --}}
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:shadow-indigo-100/50 border border-slate-100 p-6 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full transition-transform duration-500 group-hover:scale-125"></div>
            <div class="relative">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Kegiatan</p>
                <h2 class="text-4xl font-black text-indigo-600 mt-2">{{ $totalKegiatanGlobal }}</h2>
            </div>
        </div>

        {{-- Card 3 --}}
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:shadow-emerald-100/50 border border-slate-100 p-6 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full transition-transform duration-500 group-hover:scale-125"></div>
            <div class="relative">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total Selesai</p>
                <h2 class="text-4xl font-black text-emerald-500 mt-2">{{ $totalSelesaiGlobal }}</h2>
            </div>
        </div>

        {{-- Card 4 --}}
        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:shadow-orange-100/50 border border-slate-100 p-6 transition-all duration-300 hover:-translate-y-1 relative overflow-hidden">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-orange-50 rounded-full transition-transform duration-500 group-hover:scale-125"></div>
            <div class="relative">
                <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Progress Global</p>
                <h2 class="text-4xl font-black text-orange-500 mt-2">{{ $persenGlobal }}%</h2>
            </div>
        </div>

    </div>

    {{-- 3. Bagian Tengah (Status, Top 5, Ringkasan) --}}
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Status Uraian (Donut Chart) --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-t-2xl"></div>
            <h2 class="text-lg font-bold text-slate-800 mb-6 mt-1">Status Uraian</h2>
            <div class="relative h-64 flex justify-center items-center">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        {{-- Top 5 Progress --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-indigo-500 to-violet-500 rounded-t-2xl"></div>
            <h2 class="text-lg font-bold text-slate-800 mb-6 mt-1">Top 5 Progress Pelatihan</h2>
            
            <div class="space-y-5">
                @forelse($topPelatihan as $item)
                    <div class="group cursor-default">
                        <div class="flex justify-between items-end mb-1.5">
                            <span class="font-bold text-sm text-slate-700 truncate pr-4 group-hover:text-indigo-600 transition-colors">
                                {{ $item->nama_pelatihan }}
                            </span>
                            <span class="font-black text-sm text-indigo-600">
                                {{ $item->persen }}%
                            </span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2.5 shadow-inner">
                            <div class="bg-gradient-to-r from-indigo-500 to-violet-500 h-2.5 rounded-full shadow-sm" style="width: {{ $item->persen }}%"></div>
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-10 opacity-60">
                        <i class="fa-solid fa-ranking-star text-3xl text-slate-300 mb-3"></i>
                        <p class="text-slate-500 text-sm font-medium">Belum ada data pelatihan.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Ringkasan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 relative flex flex-col justify-between">
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-t-2xl"></div>
            <h2 class="text-lg font-bold text-slate-800 mb-6 mt-1">Ringkasan {{ $tahun }}</h2>
            
            <div class="space-y-6 flex-1">
                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 hover:border-emerald-200 transition-colors">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Selesai Tahun Ini</p>
                    <h3 class="text-3xl font-black text-emerald-600">{{ $totalSelesaiTahun }}</h3>
                </div>

                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 hover:border-indigo-200 transition-colors">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Rata-rata / Bulan</p>
                    <h3 class="text-3xl font-black text-indigo-600">{{ $rataPerBulan }}</h3>
                </div>

                <div class="bg-slate-50 rounded-xl p-4 border border-slate-100 hover:border-orange-200 transition-colors">
                    <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Bulan Terbaik</p>
                    <h3 class="text-3xl font-black text-orange-500">{{ $bulanTerbaik }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- 4. Bagian Bawah (Grafik Bulanan & Activity Log) --}}
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Chart Bulanan (Lebih lebar, ambil 2 kolom) --}}
        {{-- TAMBAHAN: Tambahkan "flex flex-col h-full" di sini --}}
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col h-full">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-xl font-bold text-slate-800">Tren Penyelesaian Uraian</h2>
                    <p class="text-sm text-slate-500 mt-1 font-medium">Grafik aktivitas pelatihan selama tahun {{ $tahun }}</p>
                </div>
                <div class="w-10 h-10 rounded-full bg-indigo-50 flex items-center justify-center border border-indigo-100">
                    <i class="fa-solid fa-chart-line text-indigo-500"></i>
                </div>
            </div>
            
            {{-- TAMBAHAN: Tambahkan "flex-1 min-h-[250px]" agar pembungkus melar ke bawah --}}
            <div class="relative w-full flex-1 min-h-[250px]">
                {{-- TAMBAHAN: Hapus atribut height="100" --}}
                <canvas id="chartBulanan"></canvas>
            </div>
        </div>

        {{-- Activity Log --}}
        {{-- Hapus max-h-[450px] agar selaras dengan grid atau ubah menjadi h-[400px] jika ingin fixed --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col h-full h-[450px]">
            <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-100">
                <h2 class="text-lg font-bold text-slate-800">Activity Log</h2>
                <div class="px-3 py-1 bg-violet-50 text-violet-600 rounded-full text-xs font-bold">Terbaru</div>
            </div>

            <div class="space-y-6 overflow-y-auto pr-2 custom-scrollbar flex-1">
                @forelse($activities as $activity)
                    <div class="flex gap-4 group">
                        {{-- Timeline Bullet --}}
                        <div class="flex flex-col items-center">
                            <div class="w-2.5 h-2.5 rounded-full bg-indigo-500 ring-4 ring-indigo-50 mt-1.5 group-hover:bg-violet-500 transition-colors"></div>
                            @if(!$loop->last)
                                <div class="w-0.5 h-full bg-slate-100 mt-2 group-hover:bg-indigo-100 transition-colors"></div>
                            @endif
                        </div>
                        
                        {{-- Konten Log --}}
                        <div class="pb-1">
                            <p class="font-bold text-sm text-slate-800 group-hover:text-indigo-600 transition-colors">
                                {{ $activity->user->name ?? 'System' }}
                            </p>
                            <p class="text-sm text-slate-500 mt-0.5 leading-snug">
                                {{ $activity->deskripsi }}
                            </p>
                            <p class="text-xs font-semibold text-slate-400 mt-1.5 flex items-center gap-1.5">
                                <i class="fa-regular fa-clock"></i> {{ $activity->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 flex flex-col items-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-3">
                            <i class="fa-solid fa-inbox text-xl text-slate-300"></i>
                        </div>
                        <p class="text-slate-500 text-sm font-medium">Belum ada aktivitas terekam.</p>
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

{{-- Script Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Area Chart (Tren Penyelesaian per Bulan)
    new Chart(document.getElementById('chartBulanan'), {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Uraian Selesai',
                data: @json($chartData),
                borderColor: '#6366f1', // Garis utama (Indigo-500)
                backgroundColor: 'rgba(99, 102, 241, 0.15)', // Area di bawah garis yang transparan
                borderWidth: 3,
                tension: 0.4, // Membuat garis melengkung (smooth curve)
                fill: true, // Mengaktifkan efek Area
                pointBackgroundColor: '#ffffff', // Warna titik
                pointBorderColor: '#6366f1', // Warna border titik
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6,
                pointHoverBackgroundColor: '#6366f1',
                pointHoverBorderColor: '#ffffff',
                pointHoverBorderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e293b',
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                }
            },
            interaction: {
                intersect: false, // Menampilkan tooltip meskipun kursor tidak tepat di atas titik
                mode: 'index',
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f1f5f9', drawBorder: false }, // Border grid tipis
                    ticks: { precision: 0, color: '#64748b' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b', font: { weight: '600' } }
                }
            }
        }
    });

    // 2. Donut Chart (Status Uraian)
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
                    '#f43f5e', // Rose-500
                    '#f59e0b', // Amber-500
                    '#10b981'  // Emerald-500
                ],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        color: '#475569',
                        font: { weight: '600' }
                    }
                }
            }
        }
    });
</script>

<style>
    /* Custom Scrollbar untuk Activity Log */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: #94a3b8;
    }
</style>
@endsection