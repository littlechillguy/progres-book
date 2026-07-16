@extends('layouts.app')

@section('title', 'Data Pelatihan')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Data Pelatihan
        </h1>

        <p class="text-sm text-slate-500 mt-1">
            Daftar seluruh pelatihan yang sedang berlangsung.
        </p>
    </div>

    <div class="flex gap-3">

        <a href="{{ route('dashboard') }}"
            class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-5 py-2 rounded-lg font-semibold transition">
            <i class="fa-solid fa-arrow-left mr-2"></i>
            Dashboard
        </a>

        @auth
            @if(auth()->user()->role == 'admin')
                <a href="{{ route('admin.pelatihans.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg font-semibold transition">
                    <i class="fa-solid fa-plus mr-2"></i>
                    Tambah Pelatihan
                </a>
            @endif
        @endauth

    </div>

</div>

@if(session('success'))
<div class="mb-5 bg-emerald-100 border border-emerald-300 text-emerald-700 px-4 py-3 rounded-lg">
    {{ session('success') }}
</div>
@endif

<div class="bg-white rounded-2xl shadow border border-slate-100 overflow-hidden">

    <div class="p-5 border-b">

        <form method="GET" action="{{ route('pelatihans.index') }}">

    <div class="grid md:grid-cols-4 gap-4">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama pelatihan..."
            class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

        <select
            name="tahapan"
            class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

            <option value="">Semua Tahapan</option>
            <option value="Persiapan" {{ request('tahapan') == 'Persiapan' ? 'selected' : '' }}>Persiapan</option>
            <option value="Pelaksanaan" {{ request('tahapan') == 'Pelaksanaan' ? 'selected' : '' }}>Pelaksanaan</option>
            <option value="Evaluasi" {{ request('tahapan') == 'Evaluasi' ? 'selected' : '' }}>Evaluasi</option>

        </select>

        <button
            type="submit"
            class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition">

            <i class="fa-solid fa-search mr-2"></i>
            Cari

        </button>

        <a
            href="{{ route('pelatihans.index') }}"
            class="bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg font-semibold transition flex items-center justify-center">

            <i class="fa-solid fa-rotate-left mr-2"></i>
            Reset

        </a>

    </div>

</form>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50">

            <tr class="text-xs uppercase text-slate-500">

                <th class="py-4 px-4 text-center">No</th>
                <th class="py-4 px-4">Nama Pelatihan</th>
                <th class="py-4 px-4">Tahapan</th>
                <th class="py-4 px-4">Kegiatan</th>
                <th class="py-4 px-4">Hari / Tanggal</th>
                <th class="py-4 px-4">Tempat</th>
                <th class="py-4 px-4">Progress</th>

                @auth
                    @if(auth()->user()->role == 'admin')
                        <th class="py-4 px-4 text-center">Aksi</th>
                    @endif
                @endauth

            </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

            @forelse($pelatihans as $pelatihan)

            <tr class="hover:bg-slate-50 transition">

                <td class="text-center py-4">
                    {{ $loop->iteration }}
                </td>

                <td class="px-4">

                    <a href="{{ route('pelatihans.show', $pelatihan->id) }}"
                        class="font-semibold text-indigo-600 hover:underline">

                        {{ $pelatihan->nama_pelatihan }}

                    </a>

                </td>

                <td class="px-4">
                    {{ $pelatihan->tahapan }}
                </td>

                <td class="px-4">
                    {{ $pelatihan->kegiatan }}
                </td>

                <td class="px-4 whitespace-nowrap">
                    {{ $pelatihan->hari }},
                    {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }}
                </td>

                <td class="px-4">
                    {{ $pelatihan->tempat }}
                </td>

                <td class="px-4">

                    <div class="flex items-center gap-3">

                        <div class="flex-1 bg-slate-200 rounded-full h-2">

                            <div
                                class="bg-indigo-600 h-2 rounded-full"
                                style="width: {{ $pelatihan->persen }}%">
                            </div>

                        </div>

                        <span class="font-semibold text-sm w-10 text-right">
                            {{ $pelatihan->persen }}%
                        </span>

                    </div>

                </td>

               @auth
    @if(auth()->user()->role == 'admin')

    <td class="text-center">

        <div class="flex justify-center gap-3">

            <a href="{{ route('admin.pelatihans.edit', $pelatihan->id) }}"
                class="text-amber-500 hover:text-amber-700"
                title="Edit">

                <i class="fa-solid fa-pen-to-square"></i>

            </a>

            <form
                action="{{ route('admin.pelatihans.destroy', $pelatihan->id) }}"
                method="POST"
                onsubmit="return confirm('Yakin ingin menghapus pelatihan ini?')">

                @csrf
                @method('DELETE')

                <button
                    class="text-red-600 hover:text-red-800"
                    title="Hapus">

                    <i class="fa-solid fa-trash"></i>

                </button>

            </form>

        </div>

    </td>

    @endif
@endauth

            </tr>

            @empty

            <tr>

                <td colspan="8" class="text-center py-10 text-slate-500">

                    Belum ada data pelatihan.

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection