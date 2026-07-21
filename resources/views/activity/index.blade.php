@extends('layouts.app')

@section('title','Activity Log')

@section('content')

<div class="space-y-6">

    <div>
        <h1 class="text-3xl font-bold">
            Activity Log
        </h1>

        <p class="text-slate-500">
            Riwayat seluruh aktivitas administrator.
        </p>
    </div>

    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">
                        Admin
                    </th>

                    <th class="px-6 py-4 text-left">
                        Aktivitas
                    </th>

                    <th class="px-6 py-4 text-left">
                        Waktu
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($activities as $activity)

                <tr class="border-b">

                    <td class="px-6 py-4">

                        {{ $activity->user->name ?? '-' }}

                    </td>

                    <td class="px-6 py-4">

                        {{ $activity->deskripsi }}

                    </td>

                    <td class="px-6 py-4 text-slate-500">

                        {{ $activity->created_at->format('d M Y H:i') }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3" class="text-center py-10">

                        Belum ada aktivitas.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div>

        {{ $activities->links() }}

    </div>

</div>

@endsection