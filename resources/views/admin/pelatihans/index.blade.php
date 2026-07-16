@extends('layouts.app')

@section('title', 'Admin - Data Pelatihan')

@section('content')

<div class="flex items-center justify-between mb-8">

    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Data Pelatihan
        </h1>

        <p class="text-slate-500 mt-1">
            Kelola seluruh data pelatihan yang tersedia pada sistem PRO-BOOK.
        </p>
    </div>

    <a href="{{ route('admin.pelatihans.create') }}"
        class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-3 rounded-xl font-semibold shadow transition">

        <i class="fa-solid fa-plus"></i>

        Tambah Pelatihan

    </a>

</div>

<div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr class="text-slate-700">

                    <th class="px-5 py-4 text-left w-16">
                        No
                    </th>

                    <th class="px-5 py-4 text-left">
                        Nama Pelatihan
                    </th>

                    <th class="px-5 py-4 text-left">
                        Tahapan
                    </th>

                    <th class="px-5 py-4 text-left">
                        Tanggal
                    </th>

                    <th class="px-5 py-4 text-left">
                        Tempat
                    </th>

                    <th class="px-5 py-4 text-left w-56">
                        Progress
                    </th>

                    <th class="px-5 py-4 text-center w-40">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($pelatihans as $pelatihan)

                    <tr class="border-t hover:bg-slate-50 transition">

                        <td class="px-5 py-4">

                            {{ $loop->iteration }}

                        </td>

                        <td class="px-5 py-4">

                            <p class="font-semibold text-slate-800">

                                {{ $pelatihan->nama_pelatihan }}

                            </p>

                            <p class="text-xs text-slate-500">

                                {{ $pelatihan->kegiatan }}

                            </p>

                        </td>

                        <td class="px-5 py-4">

                            <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-xs font-semibold">

                                {{ $pelatihan->tahapan }}

                            </span>

                        </td>

                        <td class="px-5 py-4">

                            {{ \Carbon\Carbon::parse($pelatihan->tanggal)->format('d M Y') }}

                        </td>

                        <td class="px-5 py-4">

                            {{ $pelatihan->tempat }}

                        </td>

                        <td class="px-5 py-4">

                            <div class="flex items-center gap-3">

                                <div class="w-full bg-slate-200 rounded-full h-2">

                                    <div
                                        class="bg-indigo-600 h-2 rounded-full"
                                        style="width: {{ $pelatihan->persen }}%">
                                    </div>

                                </div>

                                <span class="text-sm font-semibold text-slate-700">

                                    {{ $pelatihan->persen }}%

                                </span>

                            </div>

                        </td>

                        <td class="px-5 py-4">

                            <div class="flex items-center justify-center gap-4">

                                {{-- Detail --}}
                                <a href="{{ route('pelatihans.show', $pelatihan) }}"
                                    class="text-sky-600 hover:text-sky-800 transition"
                                    title="Lihat Detail">

                                    <i class="fa-solid fa-eye"></i>

                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('admin.pelatihans.edit', $pelatihan) }}"
                                    class="text-amber-500 hover:text-amber-700 transition"
                                    title="Edit">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.pelatihans.destroy', $pelatihan) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus pelatihan ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="text-red-600 hover:text-red-800 transition"
                                        title="Hapus">

                                        <i class="fa-solid fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center py-10 text-slate-500">

                            <i class="fa-solid fa-folder-open text-4xl mb-3 block text-slate-300"></i>

                            Belum ada data pelatihan.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection