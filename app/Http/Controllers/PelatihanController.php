<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index(Request $request)
{
    $query = Pelatihan::with('uraians');

    // Search berdasarkan nama pelatihan
    if ($request->filled('search')) {
        $query->where('nama_pelatihan', 'like', '%' . $request->search . '%');
    }

    // Filter berdasarkan tahapan
    if ($request->filled('tahapan')) {
        $query->where('tahapan', $request->tahapan);
    }

    $pelatihans = $query->latest()->get();

    // Hitung progress setiap pelatihan
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

    // Di dalam PelatihanController.php

public function show(Request $request, $id)
{
    $pelatihan = Pelatihan::findOrFail($id);

    $uraians = $pelatihan->uraians()

        ->when($request->filled('search'), function ($query) use ($request) {

            $query->where(function ($q) use ($request) {

                $q->where('uraian_kegiatan', 'like', '%' . $request->search . '%')
                  ->orWhere('pic', 'like', '%' . $request->search . '%');

            });

        })

        ->when($request->filled('progres'), function ($query) use ($request) {

            $query->where('progres', $request->progres);

        })

        ->when($request->filled('tanggal'), function ($query) use ($request) {

            $query->whereDate('tanggal', $request->tanggal);

        })

        ->orderBy('urutan')
        ->paginate(15)
        ->withQueryString();

    // Progress keseluruhan
    $total = $pelatihan->uraians()->count();

    $selesai = $pelatihan->uraians()
        ->where('progres', 'selesai')
        ->count();

    $progress = $total > 0
        ? round(($selesai / $total) * 100)
        : 0;

    return view('pelatihans.show', compact(
        'pelatihan',
        'uraians',
        'total',
        'selesai',
        'progress'
    ));
}
}