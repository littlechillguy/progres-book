<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Uraian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
            'tanggal' => 'required|date',
            'progres' => 'required|in:belum,on progress,selesai',
            'tanggal_selesai' => 'nullable|date',
            'pic' => 'required|string|max:255',

            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,ppt,pptx|max:10240',

            'keterangan' => 'nullable|string',
        ]);

        $urutan = Uraian::where('pelatihan_id', $pelatihan->id)
            ->max('urutan');

        $data = [

            'pelatihan_id' => $pelatihan->id,
            'urutan' => $urutan ? $urutan + 1 : 1,
            'uraian_kegiatan' => $request->uraian_kegiatan,
            'tanggal' => $request->tanggal,

            'tanggal_selesai' => $request->progres == 'selesai'
                ? $request->tanggal_selesai
                : null,

            'progres' => $request->progres,

            'pic' => $request->pic,

            'keterangan' => $request->keterangan,

        ];

        if ($request->hasFile('lampiran')) {

            $file = $request->file('lampiran');

            $data['lampiran'] = $file->store('lampiran', 'public');
            $data['lampiran_nama'] = $file->getClientOriginalName();
            $data['lampiran_tipe'] = strtolower($file->getClientOriginalExtension());

        }

        Uraian::create($data);

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
            'tanggal' => 'required|date',
            'progres' => 'required|in:belum,on progress,selesai',
            'tanggal_selesai' => 'nullable|date',
            'pic' => 'required|string|max:255',

            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx,xls,xlsx,ppt,pptx|max:10240',

            'keterangan' => 'nullable|string',
        ]);

        $data = [

            'uraian_kegiatan' => $request->uraian_kegiatan,

            'tanggal' => $request->tanggal,

            'tanggal_selesai' => $request->progres == 'selesai'
                ? $request->tanggal_selesai
                : null,

            'progres' => $request->progres,

            'pic' => $request->pic,

            'keterangan' => $request->keterangan,

        ];

        if ($request->hasFile('lampiran')) {

            if (
                $uraian->lampiran &&
                Storage::disk('public')->exists($uraian->lampiran)
            ) {
                Storage::disk('public')->delete($uraian->lampiran);
            }

            $file = $request->file('lampiran');

            $data['lampiran'] = $file->store('lampiran', 'public');
            $data['lampiran_nama'] = $file->getClientOriginalName();
            $data['lampiran_tipe'] = strtolower($file->getClientOriginalExtension());
        }

        $uraian->update($data);

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

        if (
            $uraian->lampiran &&
            Storage::disk('public')->exists($uraian->lampiran)
        ) {
            Storage::disk('public')->delete($uraian->lampiran);
        }

        $uraian->delete();

        return redirect()
            ->route('pelatihans.show', $pelatihan)
            ->with('success', 'Uraian berhasil dihapus.');
    }

    public function show(Uraian $uraian)
    {
        $uraian->load('pelatihan');

        return view('uraians.show', compact('uraian'));
    }
}