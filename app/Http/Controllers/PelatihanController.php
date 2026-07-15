<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihans = Pelatihan::with('uraians')
            ->latest()
            ->get();

        foreach ($pelatihans as $pelatihan) {

            $total = $pelatihan->uraians->count();

            $selesai = $pelatihan->uraians
                ->where('progres', 'selesai')
                ->count();

            $pelatihan->persen = $total > 0
                ? round(($selesai / $total) * 100)
                : 0;
        }

        return view('pelatihans.index', compact('pelatihans'));
    }

    public function show(Pelatihan $pelatihan)
    {
        $pelatihan->load('uraians');

        return view('pelatihans.show', compact('pelatihan'));
    }
}