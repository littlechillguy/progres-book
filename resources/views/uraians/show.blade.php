@extends('layouts.app')

@section('title','Detail Uraian')

@section('content')

<div class="max-w-5xl mx-auto">

    <a href="{{ route('pelatihans.show',$uraian->pelatihan_id) }}"
        class="text-indigo-600 hover:underline">

        ← Kembali

    </a>

    <div class="bg-white rounded-xl shadow p-8 mt-4">

        <h1 class="text-2xl font-bold mb-6">
            {{ $uraian->uraian_kegiatan }}
        </h1>

        <div class="space-y-4">

            <div>
                <b>Tanggal</b><br>
                {{ \Carbon\Carbon::parse($uraian->tanggal)->translatedFormat('d F Y') }}
            </div>

            <div>
                <b>Status</b><br>
                {{ ucfirst($uraian->progres) }}
            </div>

            <div>
                <b>PIC</b><br>
                {{ $uraian->pic }}
            </div>

            <div>
                <b>Lampiran</b><br>

                @if($uraian->link)
                    <a href="{{ $uraian->link }}"
                        target="_blank"
                        class="text-indigo-600 hover:underline">

                        Buka Lampiran

                    </a>
                @else
                    -
                @endif
            </div>

            <div>
                <b>Keterangan</b><br>
                {{ $uraian->keterangan ?: '-' }}
            </div>

        </div>

    </div>

</div>

@endsection