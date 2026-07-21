<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Uraian;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Tahun Grafik
        |--------------------------------------------------------------------------
        */

        $tahun = $request->tahun ?? now()->year;

        /*
        |--------------------------------------------------------------------------
        | Data Pelatihan
        |--------------------------------------------------------------------------
        */

        $pelatihansRaw = Pelatihan::with('uraians')->get();

        /*
        |--------------------------------------------------------------------------
        | Statistik Global
        |--------------------------------------------------------------------------
        */

        $totalKegiatanGlobal = 0;
        $totalSelesaiGlobal = 0;
        $pelatihanTerlaksana = 0;

        $pelatihans = $pelatihansRaw->map(function ($pelatihan) use (&$totalKegiatanGlobal, &$totalSelesaiGlobal, &$pelatihanTerlaksana) {

            $total = $pelatihan->uraians->count();

            $selesai = $pelatihan->uraians
                ->where('progres', 'selesai')
                ->count();

            $onProgress = $pelatihan->uraians
                ->where('progres', 'on progress')
                ->count();

            $belum = $pelatihan->uraians
                ->where('progres', 'belum')
                ->count();

            $persen = $total > 0
                ? round(($selesai / $total) * 100, 1)
                : 0;

            $totalKegiatanGlobal += $total;
            $totalSelesaiGlobal += $selesai;

            if ($total > 0 && $selesai == $total) {
                $pelatihanTerlaksana++;
            }

            if ($persen >= 80) {
                $status = 'Baik';
                $statusColor = 'bg-green-100 text-green-800 border-green-200';
            } elseif ($persen >= 50) {
                $status = 'Perlu Perhatian';
                $statusColor = 'bg-yellow-100 text-yellow-800 border-yellow-200';
            } else {
                $status = 'Kritis';
                $statusColor = 'bg-red-100 text-red-800 border-red-200';
            }

            $pelatihan->total_kegiatan = $total;
            $pelatihan->selesai = $selesai;
            $pelatihan->on_progress = $onProgress;
            $pelatihan->belum = $belum;
            $pelatihan->persen = $persen;
            $pelatihan->status_label = $status;
            $pelatihan->status_color = $statusColor;

            return $pelatihan;
        });

        /*
        |--------------------------------------------------------------------------
        | Progress Global
        |--------------------------------------------------------------------------
        */

        $persenGlobal = $totalKegiatanGlobal > 0
            ? round(($totalSelesaiGlobal / $totalKegiatanGlobal) * 100, 1)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Grafik Penyelesaian per Bulan
        |--------------------------------------------------------------------------
        */

        $hasil = Uraian::whereNotNull('tanggal_selesai')
            ->whereYear('tanggal_selesai', $tahun)
            ->selectRaw('MONTH(tanggal_selesai) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $chartLabels = [
            'Jan','Feb','Mar','Apr','Mei','Jun',
            'Jul','Agu','Sep','Okt','Nov','Des'
        ];

        $chartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $hasil[$i] ?? 0;
        }

        /*
        |--------------------------------------------------------------------------
        | Statistik Grafik
        |--------------------------------------------------------------------------
        */

        $totalSelesaiTahun = array_sum($chartData);

        $rataPerBulan = round($totalSelesaiTahun / 12, 1);

        $nilaiTertinggi = max($chartData);

        $bulanTerbaik = '-';

        if ($nilaiTertinggi > 0) {
            $bulanTerbaik = $chartLabels[array_search($nilaiTertinggi, $chartData)];
        }

        /*
        |--------------------------------------------------------------------------
        | Donut Chart
        |--------------------------------------------------------------------------
        */

        $statusChart = [
            'belum' => Uraian::where('progres', 'belum')->count(),
            'progress' => Uraian::where('progres', 'on progress')->count(),
            'selesai' => Uraian::where('progres', 'selesai')->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Top 5 Pelatihan
        |--------------------------------------------------------------------------
        */

        $topPelatihan = $pelatihans
            ->sortByDesc('persen')
            ->take(5);

        /*
        |--------------------------------------------------------------------------
        | Activity Log
        |--------------------------------------------------------------------------
        */

        $activities = ActivityLog::with('user')
    ->latest()
    ->take(5)
    ->get();

        /*
        |--------------------------------------------------------------------------
        | Return View
        |--------------------------------------------------------------------------
        */

        return view('dashboard', compact(
            'pelatihans',
            'totalKegiatanGlobal',
            'totalSelesaiGlobal',
            'persenGlobal',
            'pelatihanTerlaksana',

            'tahun',
            'chartLabels',
            'chartData',
            'totalSelesaiTahun',
            'rataPerBulan',
            'bulanTerbaik',

            'statusChart',
            'topPelatihan',

            'activities'
        ));
    }
}