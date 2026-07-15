<aside class="w-64 bg-slate-900 text-slate-300 flex flex-col shrink-0 border-r border-slate-800">
    <div class="h-20 flex items-center px-6 border-b border-slate-800 bg-slate-950/40">
        <div class="flex items-center space-x-3">
            <div class="p-2 bg-indigo-600 rounded-xl text-white shadow-md shadow-indigo-600/30">
                <i class="fa-solid fa-graduation-cap text-lg"></i>
            </div>
            <div>
                <span class="text-base font-bold text-white block tracking-wide">PRO-BOOK</span>
                <span class="text-[10px] text-slate-500 font-semibold uppercase tracking-widest block -mt-0.5">Kementerian HAM</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1.5">
        <a href="/" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all font-medium text-sm {{ Request::is('/') ? 'bg-indigo-600 text-white shadow-xs' : 'hover:bg-slate-800/60 hover:text-white' }}">
            <i class="fa-solid fa-chart-pie text-base w-5"></i>
            <span>Dashboard Utama</span>
        </a>

        <div class="pt-4 pb-2 px-4">
            <p class="text-[10px] font-bold text-slate-600 uppercase tracking-widest">Master Data</p>
        </div>

        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all font-medium text-sm hover:bg-slate-800/60 hover:text-white">
            <i class="fa-solid fa-folder-open text-base w-5"></i>
            <span>Program Pelatihan</span>
        </a>
        
        <a href="#" class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all font-medium text-sm hover:bg-slate-800/60 hover:text-white">
            <i class="fa-solid fa-list-check text-base w-5"></i>
            <span>Uraian Kegiatan</span>
        </a>
    </nav>

    <div class="p-4 border-t border-slate-800 bg-slate-950/20">
        <div class="flex items-center space-x-3 p-2 rounded-xl bg-slate-800/30 border border-slate-800/50">
            <div class="w-9 h-9 bg-indigo-500 rounded-lg flex items-center justify-center font-bold text-sm text-white">
                AD
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-xs font-semibold text-white truncate">Administrator</p>
                <p class="text-[10px] text-slate-500 truncate">Collab Mode Active</p>
            </div>
        </div>
    </div>
</aside>