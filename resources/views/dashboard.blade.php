@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="space-y-8">

        {{-- Header --}}
        <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
            <div>
                <h1 class="text-4xl font-black text-slate-800">
                    Dashboard PRO-BOOK
                </h1>
                <p class="text-slate-500 mt-2">
                    Monitoring seluruh progres pelaksanaan pelatihan pegawai.
                </p>
            </div>

            <form method="GET">
                <select name="tahun" onchange="this.form.submit()" class="rounded-xl border-slate-300 shadow-sm">
                    @for($i = date('Y'); $i >= 2024; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>
                            Tahun {{ $i }}
                        </option>
                    @endfor
                </select>
            </form>
        </div>

        {{-- Statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-slate-500">Total Pelatihan</p>
                <h2 class="text-4xl font-bold mt-3">
                    {{ $pelatihans->count() }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-slate-500">Total Kegiatan</p>
                <h2 class="text-4xl font-bold mt-3 text-indigo-600">
                    {{ $totalKegiatanGlobal }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-slate-500">Total Selesai</p>
                <h2 class="text-4xl font-bold mt-3 text-green-600">
                    {{ $totalSelesaiGlobal }}
                </h2>
            </div>

            <div class="bg-white rounded-2xl shadow p-6">
                <p class="text-slate-500">Progress Global</p>
                <h2 class="text-4xl font-bold mt-3 text-orange-500">
                    {{ $persenGlobal }}%
                </h2>
            </div>

        </div>

        {{-- Grafik --}}
        <div class="grid lg:grid-cols-3 gap-6">

            <div class="lg:col-span-2 bg-white rounded-2xl shadow p-6">

                <div class="mb-6">
                    <h2 class="text-2xl font-bold">
                        Penyelesaian Uraian Per Bulan
                    </h2>
                    <p class="text-slate-500">
                        Tahun {{ $tahun }}
                    </p>
                </div>

                <canvas id="chartBulanan" height="110"></canvas>

            </div>

            {{-- Ringkasan --}}
            <div class="bg-white rounded-2xl shadow p-6">

                <h2 class="text-xl font-bold mb-6">
                    Ringkasan
                </h2>

                <div class="space-y-6">

                    <div>
                        <p class="text-slate-500 text-sm">
                            Total Selesai Tahun Ini
                        </p>
                        <h3 class="text-4xl font-bold text-green-600">
                            {{ $totalSelesaiTahun }}
                        </h3>
                    </div>

                    <div>
                        <p class="text-slate-500 text-sm">
                            Rata-rata / Bulan
                        </p>
                        <h3 class="text-4xl font-bold text-indigo-600">
                            {{ $rataPerBulan }}
                        </h3>
                    </div>

                    <div>
                        <p class="text-slate-500 text-sm">
                            Bulan Terbaik
                        </p>
                        <h3 class="text-4xl font-bold text-orange-500">
                            {{ $bulanTerbaik }}
                        </h3>
                    </div>

                </div>

            </div>

        </div>

      {{-- Donut + Top Progress + Aktivitas --}}
<div class="grid lg:grid-cols-3 gap-6">

    {{-- Donut Chart --}}
    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold mb-5">
            Status Uraian
        </h2>

        <canvas id="statusChart"></canvas>

    </div>

    {{-- Top Progress --}}
    <div class="bg-white rounded-2xl shadow p-6">

        <h2 class="text-xl font-bold mb-5">
            Top 5 Progress Pelatihan
        </h2>

        <div class="space-y-4">

            @forelse($topPelatihan as $item)

                <div>

                    <div class="flex justify-between mb-1">

                        <span class="font-medium">
                            {{ $item->nama_pelatihan }}
                        </span>

                        <span class="font-semibold text-indigo-600">
                            {{ $item->persen }}%
                        </span>

                    </div>

                    <div class="w-full bg-slate-200 rounded-full h-2">

                        <div
                            class="bg-indigo-600 h-2 rounded-full"
                            style="width: {{ $item->persen }}%">
                        </div>

                    </div>

                </div>

            @empty

                <p class="text-slate-500 text-sm">
                    Belum ada data.
                </p>

            @endforelse

        </div>

    </div>

    {{-- Activity Log --}}
    <div class="bg-white rounded-2xl shadow p-6">

        <div class="flex items-center justify-between mb-5">

            <h2 class="text-xl font-bold">
    Activity Log
</h2>

<i class="fa-solid fa-clock-rotate-left text-indigo-600"></i>
</div>

<div class="space-y-5">

@forelse($activities as $activity)

<div class="flex gap-3">

    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center">
        <i class="fa-solid fa-user text-indigo-600"></i>
    </div>

    <div class="flex-1">

        <div class="flex justify-between">

            <div>
                <p class="font-semibold">
                    {{ $activity->aksi }}
                </p>

                <p class="text-xs text-indigo-500">
                    {{ $activity->modul }}
                </p>
            </div>

            <span class="text-xs text-slate-400">
                {{ $activity->created_at->diffForHumans() }}
            </span>

        </div>

        <p class="text-sm text-slate-600 mt-1">
            {{ $activity->deskripsi }}
        </p>

    </div>

</div>

@empty

<div class="text-center py-8">

    <i class="fa-solid fa-clock text-4xl text-slate-300"></i>

    <p class="text-slate-500 mt-3">
        Belum ada aktivitas.
    </p>

</div>

@endforelse

        </div>

    </div>

</div>

       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

new Chart(document.getElementById('chartBulanan'),{

    type:'bar',

    data:{

        labels:@json($chartLabels),

        datasets:[{

            label:'Uraian Selesai',

            data:@json($chartData),

            backgroundColor:'#4F46E5',

            borderRadius:8

        }]

    },

    options:{

        responsive:true,

        plugins:{

            legend:{
                display:false
            }

        },

        scales:{

            y:{

                beginAtZero:true,

                ticks:{
                    precision:0
                }

            }

        }

    }

});


new Chart(document.getElementById('statusChart'),{

    type:'doughnut',

    data:{

        labels:['Belum','On Progress','Selesai'],

        datasets:[{

            data:[
                {{ $statusChart['belum'] }},
                {{ $statusChart['progress'] }},
                {{ $statusChart['selesai'] }}
            ],

            backgroundColor:[
                '#ef4444',
                '#f59e0b',
                '#10b981'
            ],

            borderWidth:0

        }]

    },

    options:{

        responsive:true,

        cutout:'65%',

        plugins:{

            legend:{
                position:'bottom'
            }

        }

    }

});

</script>

@endsection