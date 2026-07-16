<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | PUBLIC
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $query = Pelatihan::with('uraians');

        // Search
        if ($request->filled('search')) {
            $query->where('nama_pelatihan', 'like', '%' . $request->search . '%');
        }

        // Filter Tahapan
        if ($request->filled('tahapan')) {
            $query->where('tahapan', $request->tahapan);
        }

        $pelatihans = $query->latest()->get();

        foreach ($pelatihans as $pelatihan) {
            $this->hitungProgress($pelatihan);
        }

        return view('pelatihans.index', compact('pelatihans'));
    }

    public function show(Request $request, Pelatihan $pelatihan)
    {
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

        $this->hitungProgress($pelatihan);

        return view('pelatihans.show', [
            'pelatihan' => $pelatihan,
            'uraians'   => $uraians,
            'total'     => $pelatihan->total_kegiatan,
            'selesai'   => $pelatihan->total_selesai,
            'progress'  => $pelatihan->persen,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN
    |--------------------------------------------------------------------------
    */

    public function adminIndex()
    {
        $pelatihans = Pelatihan::with('uraians')
            ->latest()
            ->get();

        foreach ($pelatihans as $pelatihan) {
            $this->hitungProgress($pelatihan);
        }

        return view('admin.pelatihans.index', compact('pelatihans'));
    }

    public function create()
    {
        return view('admin.pelatihans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelatihan' => 'required|max:255',
            'tahapan'        => 'required|max:100',
            'kegiatan'       => 'required|max:255',
            'hari'           => 'required|max:50',
            'tanggal'        => 'required|date',
            'tempat'         => 'required|max:255',
        ]);

        Pelatihan::create($validated);

        return redirect()
            ->route('admin.pelatihans.index')
            ->with('success', 'Pelatihan berhasil ditambahkan.');
    }

    public function edit(Pelatihan $pelatihan)
    {
        return view('admin.pelatihans.edit', compact('pelatihan'));
    }

    public function update(Request $request, Pelatihan $pelatihan)
    {
        $validated = $request->validate([
            'nama_pelatihan' => 'required|max:255',
            'tahapan'        => 'required|max:100',
            'kegiatan'       => 'required|max:255',
            'hari'           => 'required|max:50',
            'tanggal'        => 'required|date',
            'tempat'         => 'required|max:255',
        ]);

        $pelatihan->update($validated);

        return redirect()
            ->route('admin.pelatihans.index')
            ->with('success', 'Pelatihan berhasil diperbarui.');
    }

    public function destroy(Pelatihan $pelatihan)
    {
        $pelatihan->delete();

        return redirect()
            ->route('admin.pelatihans.index')
            ->with('success', 'Pelatihan berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    private function hitungProgress(Pelatihan $pelatihan)
    {
        $total = $pelatihan->uraians->count();

        $selesai = $pelatihan->uraians
            ->where('progres', 'selesai')
            ->count();

        $pelatihan->total_kegiatan = $total;
        $pelatihan->total_selesai = $selesai;

        $pelatihan->persen = $total > 0
            ? round(($selesai / $total) * 100)
            : 0;
    }
}