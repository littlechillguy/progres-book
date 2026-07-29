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
        $tahun = $request->tahun ?? now()->year;

        /*
        |--------------------------------------------------------------------------
        | Pelatihan Tahun Dipilih
        |--------------------------------------------------------------------------
        */

        $pelatihansRaw = Pelatihan::with([
            'uraians' => function ($q) use ($tahun) {
                $q->whereYear('tanggal', $tahun);
            }
        ])
            ->whereHas('uraians', function ($q) use ($tahun) {
                $q->whereYear('tanggal', $tahun);
            })
            ->get();

        $totalPelatihan = $pelatihansRaw->count();

        $totalKegiatanGlobal = 0;
        $totalSelesaiGlobal = 0;
        $pelatihanTerlaksana = 0;

        $pelatihans = $pelatihansRaw->map(function ($pelatihan) use (&$totalKegiatanGlobal, &$totalSelesaiGlobal, &$pelatihanTerlaksana, $tahun) {

            $uraians = $pelatihan->uraians;

            $total = $uraians->count();

            $selesai = $uraians
                ->where('progres', 'selesai')
                ->count();

            $onProgress = $uraians
                ->where('progres', 'on progress')
                ->count();

            $belum = $uraians
                ->where('progres', 'belum')
                ->count();

            $persen = $total > 0
                ? round(($selesai / $total) * 100, 1)
                : 0;

            $totalKegiatanGlobal += $total;
            $totalSelesaiGlobal += $selesai;

            if ($persen == 100) {
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
        | Progress Global Tahun Dipilih
        |--------------------------------------------------------------------------
        */

        $persenGlobal = $totalKegiatanGlobal > 0
            ? round(($totalSelesaiGlobal / $totalKegiatanGlobal) * 100, 1)
            : 0;

        /*
        |--------------------------------------------------------------------------
        | Grafik Bulanan
        |--------------------------------------------------------------------------
        */

        $hasil = Uraian::whereNotNull('tanggal_selesai')
            ->whereYear('tanggal_selesai', $tahun)
            ->selectRaw('MONTH(tanggal_selesai) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        $chartLabels = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        $chartData = [];

        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $hasil[$i] ?? 0;
        }

        /*
|--------------------------------------------------------------------------
| Ringkasan Tahunan (Berdasarkan Pelatihan)
|--------------------------------------------------------------------------
*/

        $totalSelesaiTahun = $pelatihans
            ->where('persen', 100)
            ->count();

        $rataPerBulan = round(
            $pelatihans->avg('persen'),
            1
        );

        $pelatihanTerbaik = $pelatihans
            ->sortByDesc('persen')
            ->first();

        $namaPelatihanTerbaik = $pelatihanTerbaik
            ? $pelatihanTerbaik->nama_pelatihan
            : '-';

        /*
        |--------------------------------------------------------------------------
        | Donut Chart Tahun Dipilih
        |--------------------------------------------------------------------------
        */

        $statusChart = [

            'belum' => Uraian::whereYear('tanggal', $tahun)
                ->where('progres', 'belum')
                ->count(),

            'progress' => Uraian::whereYear('tanggal', $tahun)
                ->where('progres', 'on progress')
                ->count(),

            'selesai' => Uraian::whereYear('tanggal', $tahun)
                ->where('progres', 'selesai')
                ->count(),
        ];

        /*
        |--------------------------------------------------------------------------
        | Bottom 5 Progress
        |--------------------------------------------------------------------------
        */

        $topPelatihan = $pelatihans
            ->sortBy('persen')
            ->take(5)
            ->values();

        /*
        |--------------------------------------------------------------------------
        | Activity Log
        |--------------------------------------------------------------------------
        */

        $activities = ActivityLog::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'pelatihans',
            'totalPelatihan',
            'totalKegiatanGlobal',
            'totalSelesaiGlobal',
            'pelatihanTerlaksana',
            'persenGlobal',
            'tahun',
            'chartLabels',
            'chartData',
            'totalSelesaiTahun',
            'rataPerBulan',
            'namaPelatihanTerbaik',
            'statusChart',
            'topPelatihan',
            'activities'
        ));
    }
}