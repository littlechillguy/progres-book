@extends('layouts.app')

@section('title', 'Edit Uraian')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Edit Uraian

            </h1>

            <p class="text-slate-500 mt-2">

                {{ $pelatihan->nama_pelatihan }}

            </p>

        </div>

        <a href="{{ route('pelatihans.show',$pelatihan) }}"
            class="bg-slate-200 hover:bg-slate-300 px-5 py-3 rounded-xl">

            <i class="fa-solid fa-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>

    <div class="bg-white rounded-2xl shadow p-8">

        <form action="{{ route('uraians.update', ['pelatihan' => $pelatihan,'uraian' => $uraian]) }}" method="POST">

    @csrf
    @method('PUT')

            @csrf
            @method('PUT')

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="font-semibold">

                        Urutan

                    </label>

                    <input
                        type="number"
                        name="urutan"
                        value="{{ old('urutan',$uraian->urutan) }}"
                        class="w-full mt-2 rounded-lg border-slate-300">

                </div>

                <div>

                    <label class="font-semibold">

                        PIC

                    </label>

                    <input
                        type="text"
                        name="pic"
                        value="{{ old('pic',$uraian->pic) }}"
                        class="w-full mt-2 rounded-lg border-slate-300">

                </div>

                <div class="md:col-span-2">

                    <label class="font-semibold">

                        Uraian Kegiatan

                    </label>

                    <textarea
                        name="uraian_kegiatan"
                        rows="4"
                        class="w-full mt-2 rounded-lg border-slate-300">{{ old('uraian_kegiatan',$uraian->uraian_kegiatan) }}</textarea>

                </div>

                <div>

                    <label class="font-semibold">

                        Tanggal

                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        value="{{ old('tanggal',$uraian->tanggal) }}"
                        class="w-full mt-2 rounded-lg border-slate-300">

                </div>

                <div>

                    <label class="font-semibold">

                        Progress

                    </label>

                    <select
                        name="progres"
                        class="w-full mt-2 rounded-lg border-slate-300">

                        <option value="belum" @selected($uraian->progres=='belum')>Belum</option>

                        <option value="proses" @selected($uraian->progres=='proses')>Proses</option>

                        <option value="selesai" @selected($uraian->progres=='selesai')>Selesai</option>

                    </select>

                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('pelatihans.show',$pelatihan) }}"
                    class="px-5 py-3 rounded-xl bg-slate-200">

                    Batal

                </a>

                <button
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-xl">

                    <i class="fa-solid fa-save mr-2"></i>

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

@endsection