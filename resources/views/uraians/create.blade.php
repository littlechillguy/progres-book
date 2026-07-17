@extends('layouts.app')

@section('title', 'Tambah Uraian')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Tambah Uraian

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

        <form action="{{ route('uraians.store',$pelatihan) }}" method="POST">

            @csrf

            <div class="grid md:grid-cols-2 gap-6">

                <div>

                    <label class="font-semibold">

                        PIC

                    </label>

                    <input
                        type="text"
                        name="pic"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>

                </div>

                <div class="md:col-span-2">

                    <label class="font-semibold">

                        Uraian Kegiatan

                    </label>

                    <textarea
                        name="uraian_kegiatan"
                        rows="4"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required></textarea>

                </div>

                <div>

                    <label class="font-semibold">

                        Tanggal

                    </label>

                    <input
                        type="date"
                        name="tanggal"
                        class="w-full mt-2 rounded-lg border-slate-300"
                        required>

                </div>

                <div>

                    <label class="font-semibold">

                        Progress

                    </label>

                    <select
                        name="progres"
                        class="w-full mt-2 rounded-lg border-slate-300">

                        <option value="belum">Belum</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>

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

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

@endsection