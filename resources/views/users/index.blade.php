@extends('layouts.app')

@section('title', 'Kelola Akun')

@section('content')

<div class="max-w-7xl mx-auto space-y-6 pb-10">

    {{-- 1. Header & Tombol Tambah --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 border-b border-slate-200 pb-5">
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">
                Kelola Akun
            </h1>
            <p class="text-slate-500 mt-1 font-medium">
                Daftar seluruh administrator PRO-BOOK.
            </p>
        </div>
        
        <a href="{{ route('users.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm hover:shadow-indigo-200 hover:-translate-y-0.5 transition-all">
            <i class="fa-solid fa-plus text-sm"></i>
            Tambah Admin
        </a>
    </div>

    {{-- 2. Card Pembungkus Tabel & Pencarian --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        
        {{-- Table Header / Toolbar --}}
        <div class="p-5 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-slate-700 hidden sm:block">Data Administrator</h2>
            
            <form method="GET" class="w-full sm:w-80 relative group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 group-hover:text-indigo-500 transition-colors"></i>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                    class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 text-sm font-medium rounded-xl shadow-sm focus:outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 transition-all group-hover:border-indigo-300">
            </form>
        </div>

        {{-- Table Content --}}
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100 text-slate-500 text-xs uppercase tracking-wider">
                        <th class="px-6 py-4 font-bold">Nama</th>
                        <th class="px-6 py-4 font-bold">Email</th>
                        <th class="px-6 py-4 font-bold text-center">Role</th>
                        <th class="px-6 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-indigo-50 border border-indigo-100 flex items-center justify-center text-indigo-600 font-bold uppercase">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-slate-800">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-500 font-medium text-sm">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($user->role == 'superadmin')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-violet-50 text-violet-700 text-xs font-bold ring-1 ring-inset ring-violet-200/50">
                                        <i class="fa-solid fa-shield-halved"></i> Super Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-sky-50 text-sky-700 text-xs font-bold ring-1 ring-inset ring-sky-200/50">
                                        <i class="fa-solid fa-user-shield"></i> Admin
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-1.5">
                                {{-- Edit Button --}}
                                <a href="{{ route('users.edit', $user) }}" title="Edit Data"
                                    class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-amber-50 text-amber-500 hover:bg-amber-500 hover:text-white transition-colors">
                                    <i class="fa-solid fa-pen text-sm"></i>
                                </a>

                                {{-- Reset Password Button --}}
                                <form action="{{ route('users.reset-password', $user) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" onclick="return confirm('Reset password menjadi admin123?')" title="Reset Password"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-50 text-blue-500 hover:bg-blue-600 hover:text-white transition-colors">
                                        <i class="fa-solid fa-key text-sm"></i>
                                    </button>
                                </form>

                                {{-- Delete Button --}}
                                @if(auth()->id() != $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?')" title="Hapus Akun"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-50 text-red-500 hover:bg-red-600 hover:text-white transition-colors">
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                @else
                                    {{-- Placeholder kosong jika itu akun sendiri agar tombol sejajar --}}
                                    <div class="inline-flex w-9 h-9"></div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        {{-- Tampilan saat data kosong / tidak ditemukan --}}
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <i class="fa-solid fa-magnifying-glass text-xl text-slate-300"></i>
                                </div>
                                <h3 class="text-slate-800 font-bold mb-1">Data tidak ditemukan</h3>
                                <p class="text-slate-500 text-sm">Belum ada akun admin atau pencarian tidak cocok.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Paginasi (opsional jika `$users` menggunakan paginate) --}}
        @if(method_exists($users, 'links') && $users->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
                {{ $users->links() }}
            </div>
        @endif

    </div>

</div>

@endsection