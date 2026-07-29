<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;
use App\Services\ActivityLogger;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

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

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    if ($request->filled('search')) {
        $query->where('nama_pelatihan', 'like', '%' . $request->search . '%');
    }

    /*
    |--------------------------------------------------------------------------
    | Filter Tahapan
    |--------------------------------------------------------------------------
    */

    if ($request->filled('tahapan')) {
        $query->where('tahapan', $request->tahapan);
    }

    /*
    |--------------------------------------------------------------------------
    | Pagination
    |--------------------------------------------------------------------------
    */

    $pelatihans = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    /*
    |--------------------------------------------------------------------------
    | Hitung Progress
    |--------------------------------------------------------------------------
    */

    foreach ($pelatihans as $pelatihan) {
        $this->hitungProgress($pelatihan);
    }

    /*
    |--------------------------------------------------------------------------
    | Favorit User
    |--------------------------------------------------------------------------
    */

    if (Auth::check()) {

        $favoriteIds = Favorite::where('user_id', Auth::id())
            ->pluck('pelatihan_id');

        foreach ($pelatihans as $pelatihan) {
            $pelatihan->favorit = $favoriteIds->contains($pelatihan->id);
        }

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

            ->when($request->filled('tahapan'), function ($query) use ($request) {
                $query->where('tahapan', $request->tahapan);
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

        // Progress TOTAL seluruh uraian pelatihan
        $total = $pelatihan->uraians()->count();

        $selesai = $pelatihan->uraians()
            ->where('progres', 'selesai')
            ->count();

        $progress = $total > 0
            ? round(($selesai / $total) * 100)
            : 0;

        return view('uraians.index', [
            'pelatihan' => $pelatihan,
            'uraians' => $uraians,
            'total' => $total,
            'selesai' => $selesai,
            'progress' => $progress,
        ]);
    }

    public function create()
    {
        return view('pelatihans.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pelatihan' => 'required|max:255',
            'tahapan' => 'required|max:100',
            'kegiatan' => 'required|max:255',
            'hari' => 'required|max:50',
            'tanggal' => 'required|date',
            'tempat' => 'required|max:255',
        ]);

        $pelatihan = Pelatihan::create($validated);

        ActivityLogger::log(
            'Pelatihan',
            'Tambah',
            $pelatihan->id,
            'Menambahkan pelatihan "' . $pelatihan->nama_pelatihan . '"',
            [],
            $pelatihan->toArray()
        );

        return redirect()
            ->route('pelatihans.index')
            ->with('success', 'Pelatihan berhasil ditambahkan.');
    }

    public function edit(Pelatihan $pelatihan)
    {
        return view('pelatihans.edit', compact('pelatihan'));
    }

    public function update(Request $request, Pelatihan $pelatihan)
    {
        $validated = $request->validate([
            'nama_pelatihan' => 'required|max:255',
            'tahapan' => 'required|max:100',
            'kegiatan' => 'required|max:255',
            'hari' => 'required|max:50',
            'tanggal' => 'required|date',
            'tempat' => 'required|max:255',
        ]);

        $old = $pelatihan->toArray();

        $pelatihan->update($validated);

        ActivityLogger::log(
            'Pelatihan',
            'Edit',
            $pelatihan->id,
            'Mengubah pelatihan "' . $pelatihan->nama_pelatihan . '"',
            $old,
            $pelatihan->fresh()->toArray()
        );

        return redirect()
            ->route('pelatihans.index')
            ->with('success', 'Pelatihan berhasil diperbarui.');
    }

    public function destroy(Pelatihan $pelatihan)
    {
        $old = $pelatihan->toArray();

        ActivityLogger::log(
            'Pelatihan',
            'Hapus',
            $pelatihan->id,
            'Menghapus pelatihan "' . $pelatihan->nama_pelatihan . '"',
            $old,
            []
        );

        $pelatihan->delete();

        return redirect()
            ->route('pelatihans.index')
            ->with('success', 'Pelatihan berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER
    |--------------------------------------------------------------------------
    */

    private function hitungProgress(Pelatihan $pelatihan)
    {
        // hanya hitung uraian sesuai tahapan pelatihan
        $uraians = $pelatihan->uraians
            ->where('tahapan', $pelatihan->tahapan);

        $total = $uraians->count();

        $selesai = $uraians
            ->where('progres', 'selesai')
            ->count();

        $pelatihan->total_kegiatan = $total;
        $pelatihan->total_selesai = $selesai;

        $pelatihan->persen = $total > 0
            ? round(($selesai / $total) * 100)
            : 0;

        return $pelatihan->persen;
    }
public function favorite(Pelatihan $pelatihan)
{
    $favorite = Favorite::where('user_id', Auth::id())
        ->where('pelatihan_id', $pelatihan->id)
        ->first();

    if ($favorite) {

        $favorite->delete();

    } else {

        Favorite::create([
            'user_id'      => Auth::id(),
            'pelatihan_id' => $pelatihan->id,
        ]);

    }

    return back()->with('success', 'Status favorit berhasil diperbarui.');
}

    public function updateTahapan(Request $request, Pelatihan $pelatihan)
{
    $request->validate([
        'tahapan' => 'required|in:Persiapan,Pelaksanaan,Evaluasi'
    ]);

    $oldTahapan = $pelatihan->tahapan;

    $pelatihan->update([
        'tahapan' => $request->tahapan
    ]);

    ActivityLogger::log(
        'Pelatihan',
        'Update Tahapan',
        $pelatihan->id,
        'Mengubah tahapan pelatihan "' . $pelatihan->nama_pelatihan . '"',
        [
            'tahapan' => $oldTahapan
        ],
        [
            'tahapan' => $request->tahapan
        ]
    );

    $this->hitungProgress($pelatihan);

    return response()->json([
        'success' => true,
        'persen' => $pelatihan->persen,
        'total' => $pelatihan->total_kegiatan,
        'selesai' => $pelatihan->total_selesai,
    ]);
}
}