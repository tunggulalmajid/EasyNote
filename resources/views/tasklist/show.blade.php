<x-app-layout>
    <x-slot:title>Detail Tugas</x-slot:title>

    <div class="max-w-3xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        <a href="{{ route('task.index') }}"
            class="inline-flex items-center gap-2 text-neutral-400 hover:text-white mb-6 transition">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Daftar
        </a>

        <div class="bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg overflow-hidden">

            {{-- Header Card --}}
            <div class="p-6 sm:p-8 border-b border-neutral-700 bg-neutral-800/50">
                <div class="flex justify-between items-start gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span
                                class="px-2.5 py-0.5 rounded-md text-xs font-mono uppercase bg-neutral-700 text-neutral-300 border border-neutral-600">
                                {{ $task->category->category ?? 'Umum' }}
                            </span>
                            {{-- Badge Status --}}
                            @php
                                $statusColors = match ($task->status_id) {
                                    1 => 'bg-red-900/30 text-red-400 border-red-800', // Pending/To Do
                                    2 => 'bg-amber-900/30 text-amber-400 border-amber-800', // In Progress
                                    3 => 'bg-emerald-900/30 text-emerald-400 border-emerald-800', // Completed
                                    default => 'bg-neutral-700 text-neutral-400 border-neutral-600',
                                };
                            @endphp
                            <span
                                class="px-2.5 py-0.5 rounded-full text-xs font-bold uppercase border {{ $statusColors }}">
                                {{ $task->status->status ?? '-' }}
                            </span>
                        </div>
                        <h1 class="text-3xl font-bold text-white">{{ $task->task }}</h1>
                    </div>

                    {{-- Tombol Edit Floating --}}
                    <a href="{{ route('task.edit', $task->id) }}"
                        class="p-2 bg-neutral-700 hover:bg-indigo-600 text-white rounded-lg transition shadow-lg">
                        <i data-lucide="pencil" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>

            {{-- Body Card --}}
            <div class="p-6 sm:p-8 space-y-8">

                {{-- Deadline Info --}}
                <div class="flex items-center gap-4 bg-neutral-900/50 p-4 rounded-lg border border-neutral-700/50">
                    <div class="p-3 bg-neutral-800 rounded-full border border-neutral-700">
                        <i data-lucide="calendar-clock" class="w-6 h-6 text-indigo-400"></i>
                    </div>
                    <div>
                        <p class="text-xs text-neutral-400 uppercase tracking-wide">Deadline</p>
                        <p class="text-white font-medium text-lg">
                            {{ \Carbon\Carbon::parse($task->deadline)->format('l, d F Y - H:i') }}
                        </p>
                        {{-- Sisa Waktu Badge --}}
                        <span
                            class="inline-flex items-center gap-1.5 mt-1 px-2.5 py-0.5 rounded text-xs font-bold uppercase border {{ $task->badge_class }}">
                            <i data-lucide="clock" class="w-3 h-3"></i>
                            {{ $task->sisa_waktu }}
                        </span>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div>
                    <h3 class="text-sm font-bold text-neutral-400 uppercase tracking-wider mb-2">Deskripsi Tugas</h3>
                    <div
                        class="prose prose-invert max-w-none text-neutral-300 leading-relaxed bg-neutral-900/30 p-4 rounded-lg border border-neutral-700/30">
                        @if ($task->deskripsi)
                            {!! nl2br(e($task->deskripsi)) !!}
                        @else
                            <span class="italic text-neutral-500">Tidak ada deskripsi tambahan.</span>
                        @endif
                    </div>
                </div>

                {{-- Meta Info --}}
                <div class="flex items-center gap-6 pt-6 border-t border-neutral-700 text-sm text-neutral-500">
                    <div class="flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4"></i>
                        <span>Dibuat oleh Anda</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4"></i>
                        <span>Dibuat: {{ $task->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk render icon jika buka halaman show langsung --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (window.lucide) window.lucide.createIcons();
        });
    </script>
</x-app-layout>
