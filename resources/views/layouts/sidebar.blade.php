    <aside class="sticky top-0 h-screen w-64 bg-slate-900 text-slate-300 border-r border-slate-800 flex flex-col">

        {{-- Logo --}}
        <div class="h-20 flex items-center px-6 border-b border-slate-800/80 bg-slate-950/60">
            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-xl bg-slate-900/80 p-1.5 flex items-center justify-center ring-1 ring-slate-800 shadow-inner">
                    <img src="{{ asset('images/logo-ham.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>

                <div>
                    <h1 class="text-white font-bold tracking-wide text-base leading-none">
                        SIMPRO
                    </h1>

                    <p class="text-[9px] uppercase tracking-[0.2em] text-sky-400 font-semibold mt-1">
                        Kementerian HAM
                    </p>
                </div>

            </div>
        </div>

        {{-- MENU --}}
        <nav class="flex-1 overflow-y-auto px-4 py-6 space-y-6 custom-scrollbar">

            <div>

                <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold px-3 mb-3">
                    Menu Utama
                </p>

                <div class="space-y-1.5">

                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('dashboard')
                            ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/20'
                            : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">

                        <i class="fa-solid fa-chart-pie w-5 text-center"></i>

                        <span>Dashboard</span>

                    </a>
                

                    {{-- Data Pelatihan --}}
                    <a href="{{ route('pelatihans.index') }}"
                        class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                        {{ request()->routeIs('pelatihans.*')
                            ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/20'
                            : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">

                        <i class="fa-solid fa-folder-open w-5 text-center"></i>

                        <span>Data Pelatihan</span>

                    </a>

                    {{-- MENU LOGIN --}}
                    @auth

                        {{-- Activity Log --}}
                        <a href="{{ route('activity-log.index') }}"
                            class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                            {{ request()->routeIs('activity-log.*')
                                ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/20'
                                : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">

                            <i class="fa-solid fa-clock-rotate-left w-5 text-center"></i>

                            <span>Activity Log</span>

                        </a>

                   

                        {{-- Kelola Akun --}}
                        @if(auth()->user()->role === 'superadmin')

                            <a href="{{ route('users.index') }}"
                                class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-medium transition-all duration-200
                                {{ request()->routeIs('users.*')
                                    ? 'bg-sky-600 text-white shadow-lg shadow-sky-600/20'
                                    : 'text-slate-400 hover:bg-slate-800/70 hover:text-white' }}">

                                <i class="fa-solid fa-users w-5 text-center"></i>

                                <span>Kelola Akun</span>

                            </a>

                        @endif

                    @endauth

                </div>

            </div>

            {{-- FAVORIT --}}
            @auth

                @if(isset($favoritPelatihans) && $favoritPelatihans->count())

                    <div>

                        <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold px-3 mb-3">
                            Akses Cepat
                        </p>

                        <div class="space-y-1">

                            @foreach($favoritPelatihans as $item)

                                <a href="{{ route('pelatihans.show',$item) }}"
                                    class="flex items-center gap-3 px-3.5 py-2 rounded-xl text-xs font-medium text-slate-400 hover:bg-slate-800/70 hover:text-white transition-all">

                                    <i class="fa-solid fa-star text-yellow-400"></i>

                                    <span class="truncate">
                                        {{ $item->nama_pelatihan }}
                                    </span>

                                </a>

                            @endforeach

                        </div>

                    </div>

                @endif

            @endauth

        </nav>

       {{-- FOOTER --}}
<div class="border-t border-slate-800 p-4 shrink-0 bg-slate-950/30">

    @auth

    <div x-data="{ open:false }" class="relative">

        <button
            @click="open=!open"
            class="w-full bg-slate-800/60 rounded-xl p-3.5 border border-slate-700/50 hover:border-sky-500 transition flex items-center justify-between">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-full bg-sky-600 flex items-center justify-center text-white font-bold">

                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                </div>

                <div class="text-left">

                    <p class="text-white text-sm font-semibold">

                        {{ auth()->user()->name }}

                    </p>

                    <p class="text-xs text-slate-400">

                        {{ auth()->user()->role == 'superadmin'
                            ? 'Super Admin'
                            : 'Administrator' }}

                    </p>

                </div>

            </div>

            <i class="fa-solid fa-chevron-up text-slate-400"></i>

        </button>

        <div
            x-show="open"
            @click.outside="open=false"
            x-transition
            class="absolute bottom-full left-0 mb-3 w-full bg-slate-800 rounded-xl border border-slate-700 shadow-2xl overflow-hidden z-50">

            <a href="{{ route('profile') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-300 hover:bg-slate-700">

                <i class="fa-solid fa-user w-5"></i>

                Profil Saya

            </a>

            <div class="border-t border-slate-700"></div>

            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    class="w-full text-left flex items-center gap-3 px-4 py-3 text-sm text-red-400 hover:bg-red-600 hover:text-white">

                    <i class="fa-solid fa-right-from-bracket w-5"></i>

                    Logout

                </button>

            </form>

        </div>

    </div>

    @else

    <a href="{{ route('login') }}"
        class="flex items-center justify-center gap-2 bg-sky-600 hover:bg-sky-500 text-white font-semibold text-sm py-2.5 rounded-xl transition">

        <i class="fa-solid fa-right-to-bracket"></i>

        Login Admin

    </a>

    @endauth

</div>

    </aside>