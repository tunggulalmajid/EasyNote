<x-app-layout>
    <x-slot:title>Catatan Saya</x-slot:title>

    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6" x-data="catatanApp()" x-init="fetchData()">

        {{-- === HEADER === --}}
        <div
            class="flex flex-col md:flex-row justify-between items-center gap-4 bg-neutral-800 p-4 rounded-xl shadow-lg border border-neutral-700">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                {{-- Icon Book/Note --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-6 h-6 text-indigo-400">
                    <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
                </svg>
                Catatan Saya
            </h2>

            <div class="flex items-center gap-3">
                {{-- Tombol Tambah --}}
                <a href="{{ route('catatan.create') }}"
                    class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg shadow-indigo-900/20">
                    {{-- Icon Plus --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-4 h-4">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    <span>Buat Catatan</span>
                </a>
            </div>
        </div>

        {{-- === LOADING STATE === --}}
        <div x-show="isLoading" class="py-20 text-center">
            <div class="inline-block animate-spin text-indigo-400 mb-2">
                <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                    </path>
                </svg>
            </div>
            <p class="text-neutral-500 text-sm">Memuat catatan...</p>
        </div>

        {{-- === LIST DATA === --}}
        <div class="space-y-4" x-show="!isLoading" style="display: none;">
            <template x-for="item in data" :key="item.id">

                {{-- CARD DESIGN (Mirip Kegiatan) --}}
                <div
                    class="group bg-neutral-800 rounded-xl shadow-lg border border-neutral-700 border-l-[6px] border-l-indigo-500 p-5 flex flex-col sm:flex-row items-start sm:items-center gap-5 hover:bg-neutral-750 transition-all duration-300 relative overflow-hidden">

                    {{-- Bagian Kiri: Tanggal & Icon --}}
                    <div class="flex items-center gap-4 min-w-[140px]">
                        <div
                            class="w-10 h-10 rounded-full bg-indigo-900/50 flex items-center justify-center border border-indigo-500/30 text-indigo-400">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                                <rect x="8" y="2" width="8" height="4" rx="1" ry="1" />
                            </svg>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-bold text-white text-sm" x-text="item.tanggaldibuat"></span>
                            <span class="text-neutral-500 text-xs mt-0.5" x-text="item.tanggaldibuat_diff"></span>
                        </div>
                    </div>

                    {{-- Bagian Tengah: Judul & Cuplikan --}}
                    <div class="flex-1 w-full border-l border-neutral-700 pl-5">
                        <a :href="item.urls.show"
                            class="text-lg font-bold text-white group-hover:text-indigo-400 transition-colors line-clamp-1 cursor-pointer"
                            x-text="item.judul"></a>

                        {{-- Menggunakan konten_cuplikan dari controller --}}
                        <div class="text-sm text-neutral-400 mt-2 line-clamp-2 leading-relaxed prose prose-invert prose-sm max-w-none"
                            x-html="item.konten_cuplikan"></div>
                    </div>

                    {{-- Bagian Kanan: Aksi --}}
                    <div
                        class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-2 mt-3 sm:mt-0 pt-3 sm:pt-0 border-t sm:border-t-0 border-neutral-700">

                        {{-- Show --}}
                        <a :href="item.urls.show"
                            class="p-2 text-neutral-400 hover:text-teal-400 hover:bg-teal-900/20 rounded-lg transition"
                            title="Baca">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                        </a>

                        {{-- Edit --}}
                        <a :href="item.urls.edit"
                            class="p-2 text-neutral-400 hover:text-indigo-400 hover:bg-indigo-900/20 rounded-lg transition"
                            title="Edit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                                <path d="m15 5 4 4" />
                            </svg>
                        </a>

                        {{-- Delete --}}
                        <button @click="deleteItem(item.urls.delete)"
                            class="p-2 text-neutral-400 hover:text-red-400 hover:bg-red-900/20 rounded-lg transition"
                            title="Hapus">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                <line x1="10" x2="10" y1="11" y2="17" />
                                <line x1="14" x2="14" y1="11" y2="17" />
                            </svg>
                        </button>
                    </div>
                </div>
            </template>

            {{-- Empty State --}}
            <div x-show="data.length === 0"
                class="text-center py-12 bg-neutral-800 rounded-xl border border-dashed border-neutral-700">
                <div class="w-16 h-16 bg-neutral-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="text-neutral-600">
                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                        <polyline points="14 2 14 8 20 8" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-white">Belum ada catatan</h3>
                <p class="text-neutral-400 text-sm mt-1">Mulai tulis ide atau hal penting Anda sekarang.</p>
            </div>

            {{-- Pagination --}}
            <div class="flex justify-between items-center mt-6 border-t border-neutral-700 pt-4"
                x-show="nextPageUrl || prevPageUrl">
                <button @click="fetchData(prevPageUrl)" :disabled="!prevPageUrl"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium bg-neutral-800 border border-neutral-700 text-neutral-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-neutral-700 transition">
                    Prev
                </button>
                <button @click="fetchData(nextPageUrl)" :disabled="!nextPageUrl"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium bg-neutral-800 border border-neutral-700 text-neutral-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-neutral-700 transition">
                    Next
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT --}}
    <script>
        function catatanApp() {
            return {
                data: [],
                isLoading: false,
                nextPageUrl: null,
                prevPageUrl: null,

                async fetchData(url = "{{ route('catatan.index') }}") {
                    this.isLoading = true;
                    const params = new URL(url);
                    // Parameter wajib untuk bypass cache back button & deteksi AJAX
                    params.searchParams.set('fetch_mode', '1');

                    try {
                        const response = await fetch(params.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });
                        if (!response.ok) throw new Error('Gagal');
                        const json = await response.json();
                        this.data = json.data;
                        this.nextPageUrl = json.next_page_url;
                        this.prevPageUrl = json.prev_page_url;
                    } catch (e) {
                        console.error(e);
                    } finally {
                        this.isLoading = false;
                    }
                },
                deleteItem(url) {
                    if (!confirm('Hapus catatan ini?')) return;
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }).then(res => {
                        if (res.ok) this.fetchData();
                        else alert('Gagal');
                    });
                }
            }
        }
    </script>
</x-app-layout>
