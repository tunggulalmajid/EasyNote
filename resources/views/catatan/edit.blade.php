<x-app-layout>
    <x-slot:title>Edit Catatan</x-slot:title>

    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg p-6 sm:p-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-amber-400">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                        <path d="m15 5 4 4" />
                    </svg>
                    Edit Catatan
                </h2>
            </div>

            <form action="{{ route('catatan.update', $catatan->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div>
                    <label for="judul" class="block text-sm font-medium text-neutral-300 mb-1">Judul Catatan</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $catatan->judul) }}"
                        required
                        class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white placeholder-neutral-500 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm p-3 text-lg font-semibold">
                </div>

                {{-- Konten Editor --}}
                <div>
                    <label for="konten" class="block text-sm font-medium text-neutral-300 mb-1">Isi Catatan</label>
                    <div class="prose-editor-wrapper">
                        {{-- Isi textarea dengan konten lama --}}
                        <textarea name="konten" id="editor">{{ old('konten', $catatan->konten) }}</textarea>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-700">
                    <a href="{{ route('catatan.index') }}"
                        class="px-4 py-2 text-sm font-medium text-neutral-300 bg-neutral-700/50 border border-neutral-600 rounded-lg hover:bg-neutral-700 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 shadow-lg shadow-indigo-900/20 transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor'), {
                    toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote',
                        'undo', 'redo'
                    ]
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush

    {{-- Style CSS yang SAMA dengan Create --}}
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
            background-color: #171717 !important;
            color: #e5e5e5 !important;
            border-color: #404040 !important;
        }

        .ck.ck-toolbar {
            background-color: #262626 !important;
            border-color: #404040 !important;
        }

        .ck.ck-button {
            color: #d4d4d4 !important;
        }

        .ck.ck-button:hover,
        .ck.ck-button.ck-on {
            background-color: #404040 !important;
            color: #fff !important;
        }

        .ck-content blockquote {
            border-left: 5px solid #6366f1;
            padding-left: 1em;
            color: #a3a3a3;
            font-style: italic;
        }

        .ck-content a {
            color: #818cf8;
            text-decoration: underline;
        }
    </style>
</x-app-layout>
