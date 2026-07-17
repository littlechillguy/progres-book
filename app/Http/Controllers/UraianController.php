<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Uraian;
use Illuminate\Http\Request;

class UraianController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create(Pelatihan $pelatihan)
    {
        return view('uraians.create', compact('pelatihan'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Pelatihan $pelatihan)
    {
        $request->validate([
            'uraian_kegiatan' => 'required|string',
            'tanggal'          => 'required|date',
            'progres'          => 'required',
            'pic'              => 'required|string',
            'link'             => 'nullable|url',
            'keterangan'       => 'nullable|string',
        ]);

        $urutan = Uraian::where('pelatihan_id', $pelatihan->id)->max('urutan');

        Uraian::create([
            'pelatihan_id'    => $pelatihan->id,
            'urutan'          => $urutan ? $urutan + 1 : 1,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'tanggal'         => $request->tanggal,
            'progres'         => $request->progres,
            'pic'             => $request->pic,
            'link'            => $request->link,
            'keterangan'      => $request->keterangan,
        ]);

        return redirect()
            ->route('pelatihans.show', $pelatihan)
            ->with('success', 'Uraian berhasil ditambahkan.');
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Pelatihan $pelatihan, Uraian $uraian)
    {
        return view('uraians.edit', compact(
            'pelatihan',
            'uraian'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Pelatihan $pelatihan, Uraian $uraian)
    {
        $request->validate([
            'uraian_kegiatan' => 'required|string',
            'tanggal'          => 'required|date',
            'progres'          => 'required',
            'pic'              => 'required|string',
            'link'             => 'nullable|url',
            'keterangan'       => 'nullable|string',
        ]);

        $uraian->update([
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'tanggal'         => $request->tanggal,
            'progres'         => $request->progres,
            'pic'             => $request->pic,
            'link'            => $request->link,
            'keterangan'      => $request->keterangan,
        ]);

        return redirect()
            ->route('pelatihans.show', $pelatihan)
            ->with('success', 'Uraian berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | Destroy
    |--------------------------------------------------------------------------
    */

    public function destroy(Pelatihan $pelatihan, Uraian $uraian)
    {
        $uraian->delete();

        return redirect()
            ->route('pelatihans.show', $pelatihan)
            ->with('success', 'Uraian berhasil dihapus.');
    }

    public function show(Uraian $uraian)
{
    return view('uraians.show', compact('uraian'));
}
}