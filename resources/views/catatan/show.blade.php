<x-app-layout>
    <x-slot:title>{{ $catatan->judul }}</x-slot:title>

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

        {{-- Tombol Kembali --}}
        <a href="{{ route('catatan.index') }}"
            class="inline-flex items-center gap-2 text-neutral-400 hover:text-white mb-6 transition">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 18-6-6 6-6" />
            </svg>
            Kembali ke Daftar
        </a>

        <div class="bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg overflow-hidden">

            {{-- Header --}}
            <div class="p-6 sm:p-8 border-b border-neutral-700 bg-neutral-800/50">
                <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3">{{ $catatan->judul }}</h1>

                <div class="flex items-center gap-4 text-sm text-neutral-400">
                    <span class="flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <line x1="16" x2="16" y1="2" y2="6" />
                            <line x1="8" x2="8" y1="2" y2="6" />
                            <line x1="3" x2="21" y1="10" y2="10" />
                        </svg>
                        {{ \Carbon\Carbon::parse($catatan->created_at)->format('d F Y') }}
                    </span>
                    <span class="w-1 h-1 rounded-full bg-neutral-600"></span>
                    <span>{{ \Carbon\Carbon::parse($catatan->created_at)->diffForHumans() }}</span>
                </div>
            </div>

            {{-- Isi Konten --}}
            <div class="p-6 sm:p-8">
                {{-- Class 'prose prose-invert' dari Tailwind Typography plugin sangat penting disini untuk styling HTML hasil editor --}}
                <div class="prose prose-invert prose-lg max-w-none text-neutral-300 leading-relaxed">
                    {!! $catatan->konten !!}
                </div>
            </div>

            {{-- Footer Action --}}
            <div class="bg-neutral-900/50 px-6 py-4 border-t border-neutral-700 flex justify-end gap-3">
                <a href="{{ route('catatan.edit', $catatan->id) }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-lg transition shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                        <path d="m15 5 4 4" />
                    </svg>
                    Edit Catatan
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
