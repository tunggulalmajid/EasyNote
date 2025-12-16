<x-app-layout>
    <x-slot:title>Edit Kegiatan</x-slot:title>

    <div class="max-w-2xl mx-auto py-10 px-4">
        {{-- Card Container (Dark Mode) --}}
        <div class="bg-neutral-800 rounded-xl shadow-lg border border-neutral-700 overflow-hidden">

            {{-- Header --}}
            <div class="bg-neutral-800 px-6 py-4 border-b border-neutral-700">
                <h2 class="text-lg font-bold text-white">Edit Kegiatan</h2>
                <p class="text-sm text-neutral-400">Perbarui detail kegiatan Anda.</p>
            </div>

            <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama Kegiatan --}}
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-1">Nama Kegiatan <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="kegiatan" value="{{ old('kegiatan', $kegiatan->kegiatan) }}"
                        class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition-colors"
                        required>
                    @error('kegiatan')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Grid Tanggal & Waktu --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-1">Tanggal <span
                                class="text-red-500">*</span></label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', $kegiatan->tanggal) }}"
                            class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            style="color-scheme: dark;" required>
                        @error('tanggal')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-neutral-300 mb-1">Waktu <span
                                class="text-red-500">*</span></label>
                        <input type="time" name="waktu"
                            value="{{ old('waktu', \Carbon\Carbon::parse($kegiatan->waktu)->format('H:i')) }}"
                            class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            style="color-scheme: dark;" required>
                        @error('waktu')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Status Selection --}}
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-3">Status</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        @foreach ($statuses as $stat)
                            <label class="cursor-pointer">
                                <input type="radio" name="status_id" value="{{ $stat->id }}" class="peer sr-only"
                                    {{ old('status_id', $kegiatan->status_id) == $stat->id ? 'checked' : '' }}>

                                <div
                                    class="px-4 py-3 rounded-lg border border-neutral-700 bg-neutral-900 text-center hover:bg-neutral-700
                                            peer-checked:border-indigo-500 peer-checked:ring-1 peer-checked:ring-indigo-500 peer-checked:bg-indigo-900/30 transition-all">
                                    <div class="text-sm font-semibold text-neutral-400 peer-checked:text-indigo-400">
                                        {{ $stat->status }}
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('status_id')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block text-sm font-medium text-neutral-300 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        class="w-full rounded-lg bg-neutral-900 border-neutral-700 text-white focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                </div>

                {{-- Actions --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-neutral-700">
                    <a href="{{ route('kegiatan.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-neutral-300 bg-neutral-800 border border-neutral-600 rounded-lg hover:bg-neutral-700 transition shadow-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 transition shadow-lg shadow-indigo-900/20">
                        Perbarui Kegiatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
