<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index()
    {
        $pelatihans = Pelatihan::latest()->get();

        return view('pelatihans.index', compact('pelatihans'));
    }

    public function create()
    {
        return view('pelatihans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelatihan' => 'required',
            'tahapan' => 'required',
            'kegiatan' => 'required',
            'hari' => 'required',
            'tanggal' => 'required|date',
            'tempat' => 'required',
        ]);

        Pelatihan::create($request->all());

        return redirect()->route('pelatihans.index')
            ->with('success', 'Pelatihan berhasil ditambahkan.');
    }

    public function show(Pelatihan $pelatihan)
    {
        $pelatihan->load('uraians');

        return view('pelatihans.show', compact('pelatihan'));
    }

    public function edit(Pelatihan $pelatihan)
    {
        return view('pelatihans.edit', compact('pelatihan'));
    }

    public function update(Request $request, Pelatihan $pelatihan)
    {
        $request->validate([
            'nama_pelatihan' => 'required',
            'tahapan' => 'required',
            'kegiatan' => 'required',
            'hari' => 'required',
            'tanggal' => 'required|date',
            'tempat' => 'required',
        ]);

        $pelatihan->update($request->all());

        return redirect()->route('pelatihans.index')
            ->with('success', 'Pelatihan berhasil diubah.');
    }

    public function destroy(Pelatihan $pelatihan)
    {
        $pelatihan->delete();

        return redirect()->route('pelatihans.index')
            ->with('success', 'Pelatihan berhasil dihapus.');
    }
}