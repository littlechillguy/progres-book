<aside class="sticky top-0 h-screen w-64 bg-slate-900 text-slate-300 border-r border-slate-800 flex flex-col">

    {{-- Logo --}}
    <div class="h-20 flex items-center px-6 border-b border-slate-800/80 bg-slate-950/60">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-slate-900/80 p-1.5 flex items-center justify-center ring-1 ring-slate-800 shadow-inner">
                <img src="{{ asset('images/logo-ham.png') }}" alt="Logo" class="w-full h-full object-contain">
            </div>
            <div>
                <h1 class="text-white font-bold tracking-wide text-base leading-none">PRO-BOOK</h1>
                <p class="text-[9px] uppercase tracking-[0.2em] text-sky-400 font-semibold mt-1">Kementerian HAM</p>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-6 custom-scrollbar">
        <div>
            <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold px-3 mb-3">Menu Utama</p>
            <div class="space-y-1.5">
                {{-- Dashboard --}}
                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('dashboard') ? 'bg-sky-600 text-white font-semibold shadow-lg shadow-sky-600/20' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                {{-- Data Pelatihan --}}
                <a href="{{ route('pelatihans.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('pelatihans.*') ? 'bg-sky-600 text-white font-semibold shadow-lg shadow-sky-600/20' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">
                    <i class="fa-solid fa-folder-open w-5 text-center"></i>
                    <span>Data Pelatihan</span>
                </a>

                {{-- Activity Log --}}
                <a href="{{ route('activity-log.index') }}"
                    class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                    {{ request()->routeIs('activity-log.*') ? 'bg-sky-600 text-white font-semibold shadow-lg shadow-sky-600/20' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">
                    <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i>
                    <span>Activity Log</span>
                </a>

                @auth
                    @if(auth()->user()->role == 'superadmin')
                        <a href="{{ route('users.index') }}" 
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('users.*') ? 'bg-sky-600 text-white font-semibold shadow-lg shadow-sky-600/20' : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">
                            <i class="fa-solid fa-users w-5 text-center"></i>
                            <span>Kelola Akun</span>
                        </a>
                    @endif
                @endauth
            </div>
        </div>

        {{-- FAVORIT / AKSES CEPAT --}}
        @auth
            @if(isset($favoritPelatihans) && $favoritPelatihans->count())
                <div>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold px-3 mb-3">Akses Cepat</p>
                    <div class="space-y-1">
                        @foreach($favoritPelatihans as $item)
                            <a href="{{ route('pelatihans.show', $item) }}"
                                class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-medium text-slate-400 hover:bg-slate-800/70 hover:text-white transition-all duration-200">
                                <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                                <span class="truncate">{{ $item->nama_pelatihan }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endauth
    </nav>

    {{-- Footer / User Profile --}}
    <div class="border-t border-slate-800 p-4 shrink-0 bg-slate-950/30">
        @auth
            <div class="bg-slate-800/60 rounded-xl p-3.5 border border-slate-700/50">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-9 h-9 rounded-full bg-sky-600 flex items-center justify-center text-white font-bold text-sm shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-white font-semibold text-xs truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-slate-400 capitalize">
                            {{ auth()->user()->role == 'superadmin' ? 'Super Admin' : 'Administrator' }}
                        </p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-rose-600/90 hover:bg-rose-600 text-white text-xs font-semibold py-2 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        @else
            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 bg-sky-600 hover:bg-sky-500 text-white font-semibold text-sm py-2.5 rounded-xl transition-all shadow-md shadow-sky-600/20">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Login Admin</span>
            </a>
            <p class="text-center text-[10px] text-slate-500 mt-2">Login khusus administrator.</p>
        @endauth
    </div>

</aside>