<x-app-layout>
    <x-slot:title>Detail Catatan</x-slot:title>

    {{-- Container: w-full, max-w-full, overflow-hidden (PENTING AGAR TIDAK MELUBER) --}}
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8 sm:py-10 w-full max-w-full overflow-hidden">

        <div class="bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg overflow-hidden">

            {{-- === HEADER === --}}
            <div class="p-5 sm:p-8 border-b border-neutral-700 bg-neutral-800/50">
                <div class="flex flex-col gap-2">
                    {{-- Meta Tanggal --}}
                    <div class="flex items-center gap-2 text-sm text-neutral-400">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-indigo-400">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($catatan->created_at)->translatedFormat('l, d F Y • H:i') }}</span>
                    </div>

                    {{-- Judul (Dengan break-words agar aman) --}}
                    <h1 class="text-2xl sm:text-3xl font-bold text-white break-words leading-tight">
                        {{ $catatan->judul }}
                    </h1>
                </div>
            </div>

            {{-- === KONTEN CATATAN === --}}
            <div class="p-5 sm:p-8">
                {{--
                    Class 'prose prose-invert': Styling bawaan Tailwind untuk HTML
                    Class 'note-content': Custom class kita untuk indentasi & list
                    Class 'break-all': PENTING untuk memotong teks panjang tanpa spasi
                --}}
                <div class="prose prose-invert prose-lg max-w-none w-full break-all note-content text-neutral-300">
                    {!! $catatan->konten !!}
                </div>
            </div>

            {{-- === FOOTER (TOMBOL AKSI) === --}}
            <div class="p-5 sm:p-8 border-t border-neutral-700 bg-neutral-900/30">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">

                    {{-- Tombol Kembali --}}
                    <a href="{{ route('catatan.index') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-4 py-2.5 text-sm font-medium text-neutral-400 bg-neutral-800 border border-neutral-600 rounded-lg hover:text-white hover:bg-neutral-700 transition active:scale-95">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                        Kembali
                    </a>

                    {{-- Group Tombol Edit & Hapus --}}
                    <div class="flex flex-col sm:flex-row w-full sm:w-auto gap-3">

                        {{-- Tombol Edit --}}
                        <a href="{{ route('catatan.edit', $catatan->id) }}"
                            class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-5 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 shadow-lg shadow-indigo-900/20 transition active:scale-95">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                                <path d="m15 5 4 4" />
                            </svg>
                            Edit
                        </a>

                        {{-- Tombol Hapus (Form) --}}
                        <form action="{{ route('catatan.destroy', $catatan->id) }}" method="POST"
                            class="w-full sm:w-auto"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-5 py-2.5 text-sm font-bold text-red-200 bg-red-900/30 border border-red-800/50 rounded-lg hover:bg-red-900/50 hover:text-white transition active:scale-95">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 6h18" />
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- STYLE CSS KHUSUS UNTUK MENAMPILKAN KONTEN CKEDITOR --}}
    <style>
        /* Pastikan List Bullet & Angka Muncul */
        .note-content ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
            margin-bottom: 1rem;
        }

        .note-content ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
            margin-bottom: 1rem;
        }

        /* Pastikan Indentasi Berjalan (Class dari CKEditor) */
        .note-content .ck-indent-1 {
            margin-left: 2em !important;
        }

        .note-content .ck-indent-2 {
            margin-left: 4em !important;
        }

        .note-content .ck-indent-3 {
            margin-left: 6em !important;
        }

        .note-content .ck-indent-4 {
            margin-left: 8em !important;
        }

        /* Styling Blockquote agar estetik */
        .note-content blockquote {
            border-left: 4px solid #6366f1;
            /* Indigo */
            padding-left: 1em;
            color: #a3a3a3;
            /* Abu terang */
            font-style: italic;
            background-color: rgba(99, 102, 241, 0.1);
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
            border-radius: 0 0.5rem 0.5rem 0;
        }

        /* Styling Link */
        .note-content a {
            color: #818cf8;
            text-decoration: underline;
            font-weight: 500;
        }

        /* Memperbaiki jarak antar paragraf */
        .note-content p {
            margin-bottom: 1em;
            line-height: 1.7;
        }

        /* Memastikan heading jelas */
        .note-content h1,
        .note-content h2,
        .note-content h3 {
            color: white;
            margin-top: 1.5em;
            margin-bottom: 0.5em;
            font-weight: 700;
        }
    </style>
</x-app-layout>
