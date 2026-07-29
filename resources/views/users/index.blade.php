@extends('layouts.app')

@section('title', 'Kelola Akun')

@section('content')
<div class="p-6 space-y-6 max-w-7xl mx-auto pb-12">

    {{-- 1. Header & Quick Action --}}
    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm relative overflow-hidden">
        {{-- Accent Background Blur --}}
        <div class="absolute -right-10 -top-10 w-48 h-48 bg-indigo-500/5 rounded-full blur-2xl pointer-events-none"></div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 relative z-10">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-2.5 h-2.5 rounded-full bg-indigo-600 inline-block"></span>
                    <span class="px-2.5 py-0.5 bg-indigo-50 text-indigo-700 border border-indigo-100 font-bold rounded-md text-[10px] uppercase tracking-wider">
                        User Management
                    </span>
                </div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
                    Kelola <span class="text-indigo-600">Akun Admin</span>
                </h1>
                <p class="text-xs text-slate-400 font-medium mt-1">
                    Daftar seluruh administrator dan hak akses pengguna sistem SIMPRO
                </p>
            </div>

            <a href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-200 active:scale-95 shrink-0">
                <i class="fa-solid fa-plus text-xs"></i>
                <span>Tambah Admin</span>
            </a>
        </div>
    </div>

    {{-- 2. Toolbar Pencarian & Filter --}}
    <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
        <form method="GET" action="{{ route('users.index') }}">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="w-full sm:w-80 relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 text-xs">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
                        class="w-full pl-9 pr-4 py-2.5 bg-slate-50 border border-slate-200 text-slate-800 text-xs font-medium rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-600 transition-all placeholder:text-slate-400">
                </div>

                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <button type="submit"
                        class="flex-1 sm:flex-none px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold rounded-xl shadow-sm transition-all duration-200 flex items-center justify-center gap-2 active:scale-95">
                        <i class="fa-solid fa-filter text-xs"></i>
                        <span>Cari</span>
                    </button>

                    @if(request('search'))
                        <a href="{{ route('users.index') }}" 
                            class="px-3.5 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold rounded-xl transition-all duration-200 flex items-center justify-center border border-slate-200 active:scale-95"
                            title="Reset Pencarian">
                            <i class="fa-solid fa-rotate-left text-xs"></i>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- 3. Tabel Administrator --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto custom-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/80 border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="py-3.5 px-6 min-w-[200px]">Pengguna</th>
                        <th class="py-3.5 px-6 min-w-[200px]">Email</th>
                        <th class="py-3.5 px-6 text-center whitespace-nowrap w-36">Role</th>
                        <th class="py-3.5 px-6 text-center whitespace-nowrap w-36">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-xs font-medium text-slate-700">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition-colors group">
                            
                            {{-- Nama & Avatar Initial --}}
                            <td class="py-4 px-6 align-middle">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-indigo-50 border border-indigo-100 text-indigo-600 font-bold text-xs flex items-center justify-center uppercase shrink-0 shadow-2xs">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="font-bold text-slate-800 text-xs leading-snug">
                                            {{ $user->name }}
                                        </span>
                                        @if(auth()->id() == $user->id)
                                            <span class="text-[10px] text-indigo-600 font-bold mt-0.5">(Akun Anda)</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Email --}}
                            <td class="py-4 px-6 text-slate-500 font-medium align-middle">
                                {{ $user->email }}
                            </td>

                            {{-- Role Badge --}}
                            <td class="py-4 px-6 text-center whitespace-nowrap align-middle">
                                @if($user->role == 'superadmin')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-purple-50 text-purple-700 border border-purple-100">
                                        <i class="fa-solid fa-shield-halved text-[9px]"></i>
                                        <span>Super Admin</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-[10px] font-bold bg-sky-50 text-sky-700 border border-sky-100">
                                        <i class="fa-solid fa-user-shield text-[9px]"></i>
                                        <span>Admin</span>
                                    </span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="py-4 px-6 text-center whitespace-nowrap align-middle">
                                <div class="flex items-center justify-center gap-1.5">
                                    {{-- Edit --}}
                                    <a href="{{ route('users.edit', $user) }}" 
                                       class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-500 hover:text-white flex items-center justify-center transition-all duration-200 shadow-2xs" 
                                       title="Edit Data">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    {{-- Reset Password --}}
                                    <form id="reset-form-{{ $user->id }}" action="{{ route('users.reset-password', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="button" 
                                                onclick="confirmReset('reset-form-{{ $user->id }}', '{{ $user->name }}')" 
                                                class="w-8 h-8 rounded-lg bg-sky-50 text-sky-600 hover:bg-sky-500 hover:text-white flex items-center justify-center transition-all duration-200 shadow-2xs" 
                                                title="Reset Password">
                                            <i class="fa-solid fa-key text-xs"></i>
                                        </button>
                                    </form>

                                    {{-- Delete --}}
                                    @if(auth()->id() != $user->id)
                                        <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" 
                                                    onclick="confirmDelete('delete-form-{{ $user->id }}', '{{ $user->name }}')" 
                                                    class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-500 hover:text-white flex items-center justify-center transition-all duration-200 shadow-2xs" 
                                                    title="Hapus Akun">
                                                <i class="fa-solid fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    @else
                                        <div class="w-8 h-8"></div>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 text-center bg-white">
                                <div class="max-w-xs mx-auto text-center space-y-2">
                                    <div class="w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center mx-auto text-lg shadow-inner">
                                        <i class="fa-solid fa-user-slash"></i>
                                    </div>
                                    <p class="text-xs font-bold text-slate-700">Data tidak ditemukan</p>
                                    <p class="text-[11px] text-slate-400">Belum ada akun admin atau kata kunci pencarian Anda tidak cocok.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if(method_exists($users, 'links') && $users->hasPages())
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $users->withQueryString()->links() }}
            </div>
        @endif
    </div>

</div>

{{-- Library SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 1. Toast Notification untuk Flash Message (Sukses)
    @if(session('success'))
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            },
            customClass: {
                popup: 'rounded-2xl shadow-xl border border-slate-100 bg-white p-4 font-sans',
                title: 'text-xs font-bold text-slate-800'
            }
        });

        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}",
            iconColor: '#10b981'
        });
    @endif

    // 2. SweetAlert Modal Konfirmasi Reset Password
    function confirmReset(formId, name) {
        Swal.fire({
            title: 'Reset Password?',
            text: `Password untuk "${name}" akan diubah kembali menjadi default: admin123`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5', // Indigo-600
            cancelButtonColor: '#94a3b8',  // Slate-400
            confirmButtonText: '<i class="fa-solid fa-key text-xs mr-1"></i> Ya, Reset Password',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl p-6 font-sans',
                title: 'text-lg font-bold text-slate-800',
                htmlContainer: 'text-xs text-slate-500 mt-2',
                confirmButton: 'px-4 py-2.5 text-xs font-semibold rounded-xl shadow-sm',
                cancelButton: 'px-4 py-2.5 text-xs font-semibold rounded-xl'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }

    // 3. SweetAlert Modal Konfirmasi Hapus Akun
    function confirmDelete(formId, name) {
        Swal.fire({
            title: 'Hapus Akun Admin?',
            text: `Akun "${name}" akan dihapus permanen dari sistem SIMPRO.`,
            icon: 'error',
            showCancelButton: true,
            confirmButtonColor: '#e11d48', // Rose-600
            cancelButtonColor: '#94a3b8',  // Slate-400
            confirmButtonText: '<i class="fa-solid fa-trash text-xs mr-1"></i> Ya, Hapus Akun',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'rounded-2xl p-6 font-sans',
                title: 'text-lg font-bold text-slate-800',
                htmlContainer: 'text-xs text-slate-500 mt-2',
                confirmButton: 'px-4 py-2.5 text-xs font-semibold rounded-xl shadow-sm',
                cancelButton: 'px-4 py-2.5 text-xs font-semibold rounded-xl'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        });
    }
</script>

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