<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Uraian;
use Illuminate\Http\Request;

class UraianController extends Controller
{
    public function create()
    {
        $pelatihans = Pelatihan::all();

        return view('uraians.create', compact('pelatihans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelatihan_id' => 'required|exists:pelatihans,id',
            'uraian_kegiatan' => 'required',
            'tanggal' => 'required|date',
            'progres' => 'required',
            'pic' => 'required',
        ]);

        $urutan = Uraian::where('pelatihan_id', $request->pelatihan_id)
            ->max('urutan');

        Uraian::create([
            'pelatihan_id' => $request->pelatihan_id,
            'urutan' => $urutan ? $urutan + 1 : 1,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'tanggal' => $request->tanggal,
            'progres' => $request->progres,
            'pic' => $request->pic,
            'link' => $request->link,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pelatihans.show', $request->pelatihan_id)
            ->with('success', 'Uraian berhasil ditambahkan.');
    }

    public function show(Uraian $uraian)
    {
        return view('uraians.show', compact('uraian'));
    }

    public function edit(Uraian $uraian)
    {
        $pelatihans = Pelatihan::all();

        return view('uraians.edit', compact('uraian', 'pelatihans'));
    }

    public function update(Request $request, Uraian $uraian)
    {
        $request->validate([
            'pelatihan_id' => 'required|exists:pelatihans,id',
            'uraian_kegiatan' => 'required',
            'tanggal' => 'required|date',
            'progres' => 'required',
            'pic' => 'required',
        ]);

        $uraian->update($request->all());

        return redirect()->route('pelatihans.show', $request->pelatihan_id)
            ->with('success', 'Uraian berhasil diperbarui.');
    }

    public function destroy(Uraian $uraian)
    {
        $pelatihan = $uraian->pelatihan_id;

        $uraian->delete();

        return redirect()->route('pelatihans.show', $pelatihan)
            ->with('success', 'Uraian berhasil dihapus.');
    }
}