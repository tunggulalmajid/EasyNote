<x-app-layout>
    <x-slot:title>Edit Catatan</x-slot:title>

    {{-- Container: w-full, max-w-full, overflow-hidden --}}
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8 sm:py-10 w-full max-w-full overflow-hidden">

        <div class="bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg p-5 sm:p-8">

            <div class="mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="text-amber-400 w-6 h-6 sm:w-7 sm:h-7">
                        <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                        <path d="m15 5 4 4" />
                    </svg>
                    Edit Catatan
                </h2>
            </div>

            <form action="{{ route('catatan.update', $catatan->id) }}" method="POST" class="space-y-5 sm:space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="judul" class="block text-sm font-medium text-neutral-300 mb-1">Judul Catatan</label>
                    <input type="text" name="judul" id="judul" value="{{ old('judul', $catatan->judul) }}"
                        required
                        class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white placeholder-neutral-500 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm p-3 text-base sm:text-lg font-semibold transition">
                </div>

                <div>
                    <label for="konten" class="block text-sm font-medium text-neutral-300 mb-1">Isi Catatan</label>
                    {{-- Wrapper Editor --}}
                    <div class="text-black prose-editor-wrapper w-full max-w-full overflow-hidden rounded-lg">
                        <textarea name="konten" id="editor">{{ old('konten', $catatan->konten) }}</textarea>
                    </div>
                </div>

                <div
                    class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-5 border-t border-neutral-700">
                    <a href="{{ route('catatan.index') }}"
                        class="w-full sm:w-auto text-center px-4 py-2.5 text-sm font-medium text-neutral-300 bg-neutral-700/50 border border-neutral-600 rounded-lg hover:bg-neutral-700 transition active:scale-95">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto justify-center px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 shadow-lg shadow-indigo-900/20 transition flex items-center gap-2 active:scale-95">
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
            document.addEventListener("DOMContentLoaded", function() {
                ClassicEditor
                    .create(document.querySelector('#editor'), {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'link', '|',
                                'bulletedList', 'numberedList', '|',
                                'outdent', 'indent', '|',
                                'blockQuote', 'undo', 'redo'
                            ],
                            shouldNotGroupWhenFull: true
                        }
                    })
                    .then(editor => {
                        editor.keystrokes.set('Tab', (data, cancel) => {
                            const command = editor.commands.get('indent');
                            if (command.isEnabled) {
                                command.execute();
                                cancel();
                            }
                        });
                        editor.keystrokes.set('Shift+Tab', (data, cancel) => {
                            const command = editor.commands.get('outdent');
                            if (command.isEnabled) {
                                command.execute();
                                cancel();
                            }
                        });
                    })
                    .catch(error => {
                        console.error('CKEditor Gagal Load:', error);
                    });
            });
        </script>
    @endpush

    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
            max-height: 600px;
            background-color: #171717 !important;
            color: #e5e5e5 !important;
            border-color: #404040 !important;
            padding: 0 15px !important;

            /* FIX RESPONSIVE: Memaksa teks panjang turun ke bawah */
            white-space: pre-wrap !important;
            overflow-wrap: break-word !important;
            word-wrap: break-word !important;
            word-break: break-all !important;
            /* INI KUNCINYA */
            max-width: 100% !important;
        }

        .ck.ck-toolbar {
            background-color: #262626 !important;
            border-color: #404040 !important;
            flex-wrap: wrap !important;
        }

        .ck.ck-button {
            color: #d4d4d4 !important;
        }

        .ck.ck-button:hover,
        .ck.ck-button.ck-on {
            background-color: #404040 !important;
            color: #fff !important;
        }

        .ck-editor__editable ::selection {
            background-color: rgba(99, 102, 241, 0.5) !important;
            color: #ffffff !important;
        }

        .ck-content ul {
            list-style-type: disc !important;
            padding-left: 1.5rem !important;
            margin-bottom: 1rem;
        }

        .ck-content ol {
            list-style-type: decimal !important;
            padding-left: 1.5rem !important;
            margin-bottom: 1rem;
        }

        .ck-content blockquote {
            border-left: 4px solid #6366f1;
            padding-left: 1em;
            color: #a3a3a3;
            font-style: italic;
            margin-left: 0;
        }

        .ck-content a {
            color: #818cf8;
            text-decoration: underline;
        }

        .ck.ck-editor__editable>.ck-placeholder::before {
            color: #737373 !important;
        }
    </style>
</x-app-layout>
