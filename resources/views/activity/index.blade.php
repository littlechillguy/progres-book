@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')

<div class="space-y-6 pb-12">

    {{-- 1. Header Card --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-200/60 shadow-sm relative overflow-hidden">
        {{-- Accent Background Gradient Blur --}}
        <div class="absolute -right-10 -top-10 w-48 h-48 bg-indigo-500/5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="relative z-10 space-y-1">
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 bg-indigo-50 text-indigo-700 border border-indigo-100 font-bold rounded-lg text-[10px] tracking-wide inline-block">
                    System Audit
                </span>
            </div>
            <h1 class="text-2xl font-black text-slate-800 tracking-tight">
                Activity <span class="text-indigo-600">Log</span>
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Riwayat dan jejak seluruh aktivitas administrator dalam sistem.
            </p>
        </div>
    </div>

    {{-- 2. Card Tabel Activity Log --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6 min-w-[180px]">Admin</th>
                        <th class="py-3.5 px-6 min-w-[280px]">Aktivitas</th>
                        <th class="py-3.5 px-6 whitespace-nowrap min-w-[160px]">Waktu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                    @forelse($activities as $activity)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            
                            {{-- Admin Info --}}
                            <td class="py-4 px-6 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 font-black text-xs flex items-center justify-center uppercase shrink-0 shadow-2xs">
                                        {{ substr($activity->user->name ?? 'A', 0, 1) }}
                                    </div>
                                    <span class="font-bold text-slate-800 text-xs">
                                        {{ $activity->user->name ?? 'System / Anonymous' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Deskripsi Aktivitas --}}
                            <td class="py-4 px-6 align-middle leading-relaxed text-slate-700">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-circle-dot text-[8px] text-indigo-500 shrink-0"></i>
                                    <span class="font-semibold">{{ $activity->deskripsi }}</span>
                                </div>
                            </td>

                            {{-- Waktu --}}
                            <td class="py-4 px-6 whitespace-nowrap align-middle">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-700">
                                        {{ $activity->created_at->format('d M Y, H:i') }}
                                    </span>
                                    <span class="text-[10px] text-slate-400 font-medium">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="py-12 text-center bg-white">
                                <div class="max-w-xs mx-auto text-center space-y-2">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-lg shadow-inner">
                                        <i class="fa-solid fa-clock-rotate-left"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Belum Ada Aktivitas</p>
                                    <p class="text-[11px] text-slate-400">Sistem belum mencatat log aktivitas apa pun saat ini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($activities, 'links') && $activities->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $activities->links() }}
            </div>
        @endif
    </div>

</div>

<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 5px;
        width: 5px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .custom-scrollbar:hover::-webkit-scrollbar-thumb {
        background: #cbd5e1;
    }
</style>

@endsection