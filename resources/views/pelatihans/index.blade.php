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
                    <a href="{{ route('pelatihans.create') }}"
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

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pelatihan..."
                        class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                    <select name="tahapan"
                        class="border rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:outline-none">

                        <option value="">Semua Tahapan</option>
                        <option value="Persiapan" {{ request('tahapan') == 'Persiapan' ? 'selected' : '' }}>Persiapan</option>
                        <option value="Pelaksanaan" {{ request('tahapan') == 'Pelaksanaan' ? 'selected' : '' }}>Pelaksanaan
                        </option>
                        <option value="Evaluasi" {{ request('tahapan') == 'Evaluasi' ? 'selected' : '' }}>Evaluasi</option>

                    </select>

                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-semibold transition">

                        <i class="fa-solid fa-search mr-2"></i>
                        Cari

                    </button>

                    <a href="{{ route('pelatihans.index') }}"
                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg font-semibold transition flex items-center justify-center">

                        <i class="fa-solid fa-rotate-left mr-2"></i>
                        Reset

                    </a>

                </div>

            </form>

        </div>

        <div class="overflow-x-auto">

    <div class="overflow-x-auto shadow-sm border border-slate-200 rounded-lg">
    <table class="w-full text-left text-sm text-slate-600">
        <thead class="bg-slate-50 text-slate-700 uppercase text-[11px] tracking-wide font-semibold border-b border-slate-200">
            <tr>
                <th class="px-2 py-3 text-center w-10">No</th>
                <th class="px-2 py-3 w-1/5">Nama Pelatihan</th>
                <th class="px-2 py-3 w-32">Tahapan</th>
                <th class="px-2 py-3 w-1/5">Kegiatan</th>
                <th class="px-2 py-3 w-32">Hari / Tanggal</th>
                <th class="px-2 py-3 w-28">Tempat</th>
                {{-- Beri lebar khusus pada kolom progress agar bar tidak terjepit --}}
                <th class="px-2 py-3 w-36">Progress</th>
                @auth
                    @if(auth()->user()->role == 'admin')
                        <th class="px-2 py-3 text-center w-16">Favorit</th>
                        <th class="px-2 py-3 text-center w-20">Aksi</th>
                    @endif
                @endauth
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            @forelse($pelatihans as $pelatihan)
                <tr class="hover:bg-slate-50/70 transition-colors">
                    
                    {{-- Nomor --}}
                    <td class="px-2 py-3 text-center font-medium text-slate-900 align-top">
                        {{ $loop->iteration }}
                    </td>

                    {{-- Nama Pelatihan --}}
                    <td class="px-2 py-3 align-top leading-relaxed text-base">
                        <a href="{{ route('pelatihans.show', $pelatihan) }}" class="font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                            {{ $pelatihan->nama_pelatihan }}
                        </a>
                    </td>

                    {{-- Tahapan --}}
                    <td class="px-2 py-3 align-top">
                        {{ $pelatihan->tahapan }}
                    </td>

                    {{-- Kegiatan --}}
                    <td class="px-2 py-3 align-top leading-relaxed">
                        {{ $pelatihan->kegiatan }}
                    </td>

                    {{-- Hari / Tanggal (Diizinkan wrap jika perlu) --}}
                    <td class="px-2 py-3 align-top text-slate-500">
                        <span class="block text-slate-700">{{ $pelatihan->hari }},</span>
                        {{ \Carbon\Carbon::parse($pelatihan->tanggal)->translatedFormat('d F Y') }}
                    </td>

                    {{-- Tempat --}}
                    <td class="px-2 py-3 align-top">
                        {{ $pelatihan->tempat }}
                    </td>

                    {{-- Progress Bar --}}
                    <td class="px-2 py-3 align-top">
                        <div class="flex items-center gap-2 mt-0.5">
                            {{-- Container Bar --}}
                            <div class="w-full bg-slate-200 rounded-full h-2.5 flex-1">
                                {{-- Fill Bar --}}
                                <div class="bg-indigo-600 h-2.5 rounded-full transition-all duration-500" 
                                     style="width: {{ $pelatihan->persen }}%">
                                </div>
                            </div>
                            {{-- Teks Persentase --}}
                            <span class="font-semibold text-xs text-slate-700 w-9 text-right inline-block">
                                {{ $pelatihan->persen }}%
                            </span>
                        </div>
                    </td>

                    @auth
                    @if(auth()->user()->role == 'admin')
                        {{-- FAVORIT --}}
                        <td class="px-2 py-3 align-top text-center">
                            <form action="{{ route('pelatihans.favorite', $pelatihan) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xl transition hover:scale-110 mt-0.5" title="Tandai Favorit">
                                    @if($pelatihan->favorit)
                                        <i class="fa-solid fa-star text-yellow-400"></i>
                                    @else
                                        <i class="fa-regular fa-star text-slate-300 hover:text-yellow-400"></i>
                                    @endif
                                </button>
                            </form>
                        </td>

                        {{-- AKSI --}}
                        <td class="px-2 py-3 align-top">
                            <div class="flex justify-center items-center gap-1.5 mt-0.5">
                                <a href="{{ route('pelatihans.edit', $pelatihan) }}" 
                                   class="p-1.5 text-amber-500 hover:bg-amber-50 rounded" title="Edit">
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </a>

                                <form action="{{ route('pelatihans.destroy', $pelatihan) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus pelatihan ini?')" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-red-500 hover:bg-red-50 rounded" title="Hapus">
                                        <i class="fa-solid fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    @endif
                    @endauth

                </tr>
            @empty
                <tr>
                    <td colspan="9" class="px-4 py-12 text-center bg-white">
                        <div class="inline-flex flex-col items-center justify-center">
                            <i class="fa-regular fa-folder-open text-4xl text-slate-300 mb-3"></i>
                            <p class="text-slate-500 font-medium text-sm">Belum ada data pelatihan.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>

    </div>

@endsection