<x-app-layout>
    <x-slot:title>Dashboard</x-slot:title>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- === 1. WELCOME SECTION === --}}
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-white">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-neutral-400 text-sm mt-1">Berikut adalah ringkasan aktivitas Anda hari ini.</p>
                </div>
                <div
                    class="text-sm text-neutral-500 bg-neutral-800 px-4 py-2 rounded-lg border border-neutral-700 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" x2="16" y1="2" y2="6" />
                        <line x1="8" x2="8" y1="2" y2="6" />
                        <line x1="3" x2="21" y1="10" y2="10" />
                    </svg>
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </div>
            </div>

            {{-- === 2. STATS CARDS === --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Card 1: Tugas Pending --}}
                <div
                    class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow-lg relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-amber-500">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                        </svg>
                    </div>
                    <p class="text-neutral-400 text-xs font-bold uppercase tracking-wider">Tugas Pending</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $stats['tugas_pending'] }}</h3>
                    <p class="text-xs text-amber-500 mt-2 font-medium">Perlu diselesaikan</p>
                </div>

                {{-- Card 2: Kegiatan Hari Ini --}}
                <div
                    class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow-lg relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-emerald-500">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <line x1="16" x2="16" y1="2" y2="6" />
                            <line x1="8" x2="8" y1="2" y2="6" />
                            <line x1="3" x2="21" y1="10" y2="10" />
                        </svg>
                    </div>
                    <p class="text-neutral-400 text-xs font-bold uppercase tracking-wider">Jadwal Hari Ini</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $stats['kegiatan_today'] }}</h3>
                    <p class="text-xs text-emerald-500 mt-2 font-medium">Agenda aktif</p>
                </div>

                {{-- Card 3: Total Catatan --}}
                <div
                    class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow-lg relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-indigo-500">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                            <line x1="16" x2="8" y1="13" y2="13" />
                            <line x1="16" x2="8" y1="17" y2="17" />
                            <polyline points="10 9 9 9 8 9" />
                        </svg>
                    </div>
                    <p class="text-neutral-400 text-xs font-bold uppercase tracking-wider">Total Catatan</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $stats['total_catatan'] }}</h3>
                    <p class="text-xs text-indigo-500 mt-2 font-medium">Ide tersimpan</p>
                </div>

                {{-- Card 4: Total Tugas --}}
                <div
                    class="bg-neutral-800 p-5 rounded-xl border border-neutral-700 shadow-lg relative overflow-hidden group">
                    <div
                        class="absolute right-0 top-0 p-4 opacity-10 group-hover:opacity-20 transition transform group-hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-blue-500">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                            <polyline points="22 4 12 14.01 9 11.01" />
                        </svg>
                    </div>
                    <p class="text-neutral-400 text-xs font-bold uppercase tracking-wider">Total Tugas</p>
                    <h3 class="text-3xl font-bold text-white mt-1">{{ $stats['total_tugas'] }}</h3>
                    <p class="text-xs text-blue-500 mt-2 font-medium">Semua riwayat</p>
                </div>
            </div>

            {{-- === 3. MAIN CONTENT GRID === --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT COLUMN (2/3 width) --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- 3a. Tugas Prioritas --}}
                    <div class="bg-neutral-800 rounded-xl border border-neutral-700 shadow-lg overflow-hidden">
                        <div
                            class="p-5 border-b border-neutral-700 flex justify-between items-center bg-neutral-800/50">
                            <h3 class="font-bold text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-red-400">
                                    <circle cx="12" cy="12" r="10" />
                                    <line x1="12" x2="12" y1="8" y2="12" />
                                    <line x1="12" x2="12.01" y1="16" y2="16" />
                                </svg>
                                Deadline Terdekat
                            </h3>
                            <a href="{{ route('task.index') }}"
                                class="text-xs text-indigo-400 hover:text-indigo-300">Lihat Semua &rarr;</a>
                        </div>
                        <div class="divide-y divide-neutral-700">
                            @forelse($prioritas_tugas as $task)
                                <div
                                    class="p-4 hover:bg-neutral-700/30 transition flex items-center justify-between group">
                                    <div class="flex items-center gap-3">
                                        {{-- Status Dot --}}
                                        <div
                                            class="w-2 h-2 rounded-full {{ $task->status_id == 1 ? 'bg-red-500' : 'bg-amber-500' }}">
                                        </div>
                                        <div>
                                            <h4
                                                class="text-sm font-semibold text-white group-hover:text-indigo-400 transition">
                                                {{ $task->task }}</h4>
                                            <div class="flex items-center gap-2 text-xs text-neutral-500 mt-1">
                                                <span
                                                    class="bg-neutral-700 px-1.5 py-0.5 rounded text-neutral-300">{{ $task->category->category ?? 'Umum' }}</span>
                                                <span>•</span>
                                                <span>{{ \Carbon\Carbon::parse($task->deadline)->format('d M H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <span
                                        class="px-2 py-1 rounded text-[10px] font-bold uppercase border {{ $task->waktu_class }}">
                                        {{ $task->waktu_text }}
                                    </span>
                                </div>
                            @empty
                                <div class="p-8 text-center text-neutral-500">
                                    <p class="text-sm">Tidak ada tugas mendesak. Kerja bagus!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- 3b. Jadwal Hari Ini --}}
                    <div class="bg-neutral-800 rounded-xl border border-neutral-700 shadow-lg overflow-hidden">
                        <div
                            class="p-5 border-b border-neutral-700 flex justify-between items-center bg-neutral-800/50">
                            <h3 class="font-bold text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-emerald-400">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg>
                                Jadwal Hari Ini
                            </h3>
                            <a href="{{ route('kegiatan.index') }}"
                                class="text-xs text-indigo-400 hover:text-indigo-300">Lihat Semua &rarr;</a>
                        </div>
                        <div class="p-4">
                            @forelse($jadwal_hari_ini as $kegiatan)
                                <div class="flex gap-4 mb-4 last:mb-0">
                                    <div class="flex flex-col items-center">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2"></div>
                                        <div class="w-0.5 h-full bg-neutral-700 mt-1"></div>
                                    </div>
                                    <div class="pb-4">
                                        <p class="text-xs font-mono text-emerald-400 mb-0.5">
                                            {{ \Carbon\Carbon::parse($kegiatan->waktu)->format('H:i') }}</p>
                                        <h4 class="text-white font-medium text-sm">{{ $kegiatan->kegiatan }}</h4>
                                        <p class="text-neutral-500 text-xs mt-1 line-clamp-1">
                                            {{ $kegiatan->deskripsi }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 border-2 border-dashed border-neutral-700 rounded-lg">
                                    <p class="text-sm text-neutral-500">Tidak ada jadwal hari ini.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- RIGHT COLUMN (1/3 width) --}}
                <div class="lg:col-span-1">

                    {{-- 3c. Catatan Terbaru --}}
                    <div class="bg-neutral-800 rounded-xl border border-neutral-700 shadow-lg overflow-hidden h-full">
                        <div
                            class="p-5 border-b border-neutral-700 flex justify-between items-center bg-neutral-800/50">
                            <h3 class="font-bold text-white flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="text-indigo-400">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                    <line x1="16" x2="8" y1="13" y2="13" />
                                    <line x1="16" x2="8" y1="17" y2="17" />
                                    <polyline points="10 9 9 9 8 9" />
                                </svg>
                                Catatan Terbaru
                            </h3>
                            <a href="{{ route('catatan.index') }}"
                                class="text-xs text-indigo-400 hover:text-indigo-300">Lihat Semua &rarr;</a>
                        </div>
                        <div class="p-4 space-y-3">
                            @forelse($catatan_terbaru as $note)
                                <a href="{{ route('catatan.show', $note->id) }}"
                                    class="block bg-neutral-900 p-4 rounded-lg border border-neutral-700 hover:border-indigo-500/50 hover:bg-neutral-750 transition group">
                                    <h4
                                        class="text-sm font-bold text-white group-hover:text-indigo-400 transition line-clamp-1">
                                        {{ $note->judul }}</h4>
                                    <p class="text-xs text-neutral-500 mt-2 flex justify-between">
                                        <span>{{ $note->created_at->diffForHumans() }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="opacity-0 group-hover:opacity-100 transition">
                                            <polyline points="9 18 15 12 9 6" />
                                        </svg>
                                    </p>
                                </a>
                            @empty
                                <div class="text-center py-10">
                                    <p class="text-sm text-neutral-500">Belum ada catatan.</p>
                                    <a href="{{ route('catatan.create') }}"
                                        class="text-xs text-indigo-400 hover:underline mt-2 inline-block">Buat baru</a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</x-app-layout>
