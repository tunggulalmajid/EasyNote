<x-app-layout>
    <x-slot:title>Tambah Tugas Baru</x-slot:title>

    <div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg p-6 sm:p-8">

            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white flex items-center gap-2">
                    <i data-lucide="plus-circle" class="w-6 h-6 text-indigo-400"></i>
                    Tambah Tugas Baru
                </h2>
                <p class="text-neutral-400 text-sm mt-1">Isi detail tugas yang akan Anda kerjakan.</p>
            </div>

            <form action="{{ route('task.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Input Judul Tugas --}}
                <div>
                    <label for="task" class="block text-sm font-medium text-neutral-300 mb-1">Judul Tugas</label>
                    <input type="text" name="task" id="task" value="{{ old('task') }}" required
                        class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white placeholder-neutral-500 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        placeholder="Contoh: Menyelesaikan Laporan Bulanan">
                    @error('task')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Input Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-neutral-300 mb-1">Deskripsi
                        (Opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                        class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white placeholder-neutral-500 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                        placeholder="Tambahkan detail tugas...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    {{-- Input Kategori --}}
                    <div>
                        <label for="category_id"
                            class="block text-sm font-medium text-neutral-300 mb-1">Kategori</label>
                        <select name="category_id" id="category_id" required
                            class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                            <option value="" disabled selected>Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Input Status --}}
                    <div>
                        <label for="status_id" class="block text-sm font-medium text-neutral-300 mb-1">Status
                            Awal</label>
                        <select name="status_id" id="status_id" required
                            class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
                            @foreach ($statuses as $status)
                                <option value="{{ $status->id }}"
                                    {{ old('status_id') == $status->id ? 'selected' : '' }}>
                                    {{ $status->status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Input Deadline --}}
                <div>
                    <label for="deadline" class="block text-sm font-medium text-neutral-300 mb-1">Deadline</label>
                    <input type="datetime-local" name="deadline" id="deadline" value="{{ old('deadline') }}" required
                        class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white placeholder-neutral-500 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm [color-scheme:dark]">
                    @error('deadline')
                        <span class="text-red-400 text-xs mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-neutral-700">
                    <a href="{{ route('task.index') }}"
                        class="px-4 py-2 text-sm font-medium text-neutral-300 bg-neutral-800 border border-neutral-600 rounded-lg hover:bg-neutral-700 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 shadow-lg shadow-indigo-900/20 transition flex items-center gap-2">
                        <i data-lucide="save" class="w-4 h-4"></i>
                        Simpan Tugas
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
