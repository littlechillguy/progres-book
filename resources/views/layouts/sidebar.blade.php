<aside class="w-64 bg-slate-900 text-slate-300 flex flex-col shrink-0 border-r border-slate-800">

    {{-- Logo --}}
    <div class="h-20 flex items-center px-6 border-b border-slate-800 bg-slate-950/40">

        <div class="flex items-center gap-3">

            <div class="w-11 h-11 rounded-xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-600/30">

                <i class="fa-solid fa-graduation-cap text-white text-lg"></i>

            </div>

            <div>

                <h1 class="text-white font-bold tracking-wide">
                    PRO-BOOK
                </h1>

                <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-semibold">
                    Kementerian HAM
                </p>

            </div>

        </div>

    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-4 py-6">

        <p class="text-[10px] uppercase tracking-[0.2em] text-slate-500 font-bold px-4 mb-3">
            Menu Utama
        </p>

        <div class="space-y-2">

            {{-- Dashboard --}}
            <a href="{{ route('dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-indigo-600 text-white shadow'
                    : 'hover:bg-slate-800 hover:text-white' }}">

                <i class="fa-solid fa-chart-pie w-5"></i>

                <span class="font-medium">
                    Dashboard
                </span>

            </a>

            {{-- Data Pelatihan --}}
            @auth

                @if(auth()->user()->role == 'admin')

                    <a href="{{ route('admin.pelatihans.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('admin.pelatihans.*')
                            ? 'bg-indigo-600 text-white shadow'
                            : 'hover:bg-slate-800 hover:text-white' }}">

                @else

                    <a href="{{ route('pelatihans.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('pelatihans.*')
                            ? 'bg-indigo-600 text-white shadow'
                            : 'hover:bg-slate-800 hover:text-white' }}">

                @endif

            @else

                <a href="{{ route('pelatihans.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                    {{ request()->routeIs('pelatihans.*')
                        ? 'bg-indigo-600 text-white shadow'
                        : 'hover:bg-slate-800 hover:text-white' }}">

            @endauth

                <i class="fa-solid fa-folder-open w-5"></i>

                <span class="font-medium">
                    Data Pelatihan
                </span>

            </a>

        </div>

    </nav>

    {{-- Footer --}}
    <div class="border-t border-slate-800 p-4">

        @auth

            <div class="bg-slate-800 rounded-xl p-4">

                <div class="flex items-center gap-3 mb-4">

                    <div class="w-10 h-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold">

                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                    </div>

                    <div>

                        <p class="text-white font-semibold text-sm">

                            {{ auth()->user()->name }}

                        </p>

                        <p class="text-xs text-slate-400">

                            Administrator

                        </p>

                    </div>

                </div>

                <form action="{{ route('logout') }}" method="POST">

                    @csrf

                    <button
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg transition">

                        <i class="fa-solid fa-right-from-bracket mr-2"></i>

                        Logout

                    </button>

                </form>

            </div>

        @else

            <a href="{{ route('login') }}"
                class="block bg-indigo-600 hover:bg-indigo-700 text-center text-white py-3 rounded-xl transition">

                <i class="fa-solid fa-right-to-bracket mr-2"></i>

                Login Admin

            </a>

            <p class="text-center text-xs text-slate-500 mt-3">

                Login hanya untuk administrator.

            </p>

        @endauth

    </div>

</aside>