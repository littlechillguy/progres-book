<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua data pelatihan beserta relasi uraians untuk efisiensi query (Eager Loading)
        $pelatihansRaw = Pelatihan::with('uraians')->get();

        // 1. Hitung Statistik Global (Summary Cards)
        $totalKegiatanGlobal = 0;
        $totalSelesaiGlobal = 0;
        $pelatihanTerlaksana = 0;

        $pelatihans = $pelatihansRaw->map(function ($pelatihan) use (&$totalKegiatanGlobal, &$totalSelesaiGlobal, &$pelatihanTerlaksana) {
            $total = $pelatihan->uraians->count();
            $selesai = $pelatihan->uraians->where('progres', 'selesai')->count();
            $onProgress = $pelatihan->uraians->where('progres', 'on progress')->count();
            $belum = $pelatihan->uraians->where('progres', 'belum')->count();
            
            $persen = $total > 0 ? round(($selesai / $total) * 100, 1) : 0;
            
            // Akumulasi untuk global card
            $totalKegiatanGlobal += $total;
            $totalSelesaiGlobal += $selesai;
            
            if ($total > 0 && $selesai === $total) {
                $pelatihanTerlaksana++;
            }

            // Penentuan Status Berdasarkan Persentase
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

        $persenGlobal = $totalKegiatanGlobal > 0 ? round(($totalSelesaiGlobal / $totalKegiatanGlobal) * 100, 1) : 0;

        return view('dashboard', compact(
            'pelatihans', 
            'totalKegiatanGlobal', 
            'totalSelesaiGlobal', 
            'persenGlobal', 
            'pelatihanTerlaksana'
        ));
    }
}