<x-app-layout>
    <x-slot:title>Daftar Tugas</x-slot:title>

    {{-- CONTAINER: w-full max-w-full overflow-hidden (PENTING) --}}
    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-6 w-full max-w-full overflow-hidden"
        x-data="taskApp()" x-init="fetchData()">

        {{-- === HEADER & FILTER === --}}
        <div class="bg-neutral-800 p-4 sm:p-5 rounded-xl shadow-lg border border-neutral-700 w-full">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">

                {{-- Judul Halaman --}}
                <h2 class="text-xl font-bold text-white flex items-center gap-2 w-full md:w-auto">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-indigo-400"></i>
                    Daftar Tugas
                </h2>

                {{-- Filter & Tombol --}}
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">

                    {{-- Filter Status --}}
                    <select x-model="filters.status_id" @change="fetchData()"
                        class="w-full sm:w-auto rounded-lg bg-neutral-900 border-neutral-700 text-neutral-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer shadow-sm">
                        <option value="">Semua Status</option>
                        @foreach ($statuses as $stat)
                            <option value="{{ $stat->id }}">{{ $stat->status }}</option>
                        @endforeach
                    </select>

                    {{-- Reset Button --}}
                    <button x-show="filters.status_id !== ''" @click="resetFilters()" style="display: none;"
                        class="text-sm text-red-400 hover:text-red-300 font-medium transition text-center sm:text-left">
                        Reset
                    </button>

                    {{-- Tombol Tambah --}}
                    <a href="{{ route('task.create') }}"
                        class="ml-auto md:ml-2 inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg shadow-indigo-900/20 w-full md:w-auto active:scale-95">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Tugas Baru</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- === LOADING STATE === --}}
        <div x-show="isLoading" class="py-20 text-center">
            <div class="inline-block animate-spin text-indigo-400 mb-2">
                <i data-lucide="loader-2" class="w-8 h-8"></i>
            </div>
            <p class="text-neutral-500 text-sm">Sedang memuat data...</p>
        </div>

        {{-- === LIST DATA === --}}
        <div class="space-y-4 w-full" x-show="!isLoading" style="display: none;">

            <template x-for="item in data" :key="item.id">

                {{-- CARD WRAPPER: w-full max-w-full --}}
                <div
                    class="group bg-neutral-800 rounded-xl shadow-lg border border-neutral-700 p-5 flex flex-col sm:flex-row items-start gap-5 hover:bg-neutral-750 transition-all duration-300 relative overflow-hidden w-full max-w-full">

                    {{-- GARIS INDIKATOR STATUS (KIRI) --}}
                    <div class="absolute left-0 top-0 bottom-0 w-1.5" :class="item.colors.sidebar"></div>

                    {{-- Kolom 1: Status & Deadline --}}
                    <div
                        class="flex flex-row sm:flex-col items-center sm:items-start justify-between w-full sm:w-auto sm:min-w-[140px] gap-3 shrink-0">
                        {{-- Status Badge --}}
                        <span class="px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider border"
                            :class="item.colors.badge" x-text="item.status_label">
                        </span>

                        {{-- Deadline --}}
                        <div class="flex flex-col items-end sm:items-start">
                            <span class="text-sm font-bold text-white" x-text="item.deadline_fmt"></span>
                            {{-- Badge Sisa Waktu --}}
                            <div class="flex items-center gap-1.5 mt-1 px-2 py-0.5 rounded text-[10px] font-medium"
                                :class="item.deadline_class">
                                <i data-lucide="clock" class="w-3 h-3"></i>
                                <span x-text="item.deadline_diff"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom 2: Detail Tugas (FIXED) --}}
                    {{-- Gunakan min-w-0 agar flex item mau mengecil --}}
                    <div
                        class="flex-1 w-full min-w-0 border-t sm:border-t-0 sm:border-l border-neutral-700 pt-4 sm:pt-0 sm:pl-5">

                        {{-- Kategori Badge --}}
                        <div class="mb-2">
                            <span
                                class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded text-[10px] font-medium bg-neutral-700/50 text-neutral-300 border border-neutral-600/50">
                                <i data-lucide="tag" class="w-3 h-3 text-indigo-400"></i>
                                <span x-text="item.category"></span>
                            </span>
                        </div>

                        {{-- Judul: break-all + line-clamp --}}
                        <a :href="item.urls.show" class="block group-hover:text-indigo-400 transition-colors">
                            <h3 class="text-lg font-bold text-white line-clamp-1 break-all" x-text="item.task"></h3>
                        </a>

                        {{-- Deskripsi: break-all + line-clamp --}}
                        <p class="text-sm text-neutral-400 mt-1 line-clamp-2 leading-relaxed break-all"
                            x-text="item.deskripsi || 'Tidak ada deskripsi tambahan.'"></p>
                    </div>

                    {{-- Kolom 3: Aksi --}}
                    <div
                        class="flex items-center justify-end w-full sm:w-auto gap-2 mt-2 sm:mt-0 pt-3 sm:pt-0 border-t sm:border-t-0 border-neutral-700 shrink-0">
                        {{-- Detail --}}
                        <a :href="item.urls.show"
                            class="p-2 text-neutral-400 hover:text-teal-400 hover:bg-teal-900/20 rounded-lg transition"
                            title="Detail">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </a>

                        {{-- Edit --}}
                        <a :href="item.urls.edit"
                            class="p-2 text-neutral-400 hover:text-indigo-400 hover:bg-indigo-900/20 rounded-lg transition"
                            title="Edit">
                            <i data-lucide="pencil" class="w-5 h-5"></i>
                        </a>

                        {{-- Delete --}}
                        <button @click="deleteItem(item.urls.delete)"
                            class="p-2 text-neutral-400 hover:text-red-400 hover:bg-red-900/20 rounded-lg transition"
                            title="Hapus">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>

                </div>
            </template>

            {{-- Empty State --}}
            <div x-show="data.length === 0"
                class="text-center py-12 bg-neutral-800 rounded-xl border border-dashed border-neutral-700 w-full">
                <div class="w-16 h-16 bg-neutral-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="clipboard-list" class="w-8 h-8 text-neutral-600"></i>
                </div>
                <h3 class="text-lg font-medium text-white">Tidak ada tugas</h3>
                <p class="text-neutral-400 text-sm mt-1">Silakan buat tugas baru atau ubah filter.</p>
            </div>

            {{-- Pagination --}}
            <div class="flex justify-between items-center mt-6 pt-4 border-t border-neutral-700"
                x-show="nextPageUrl || prevPageUrl">
                <button @click="fetchData(prevPageUrl)" :disabled="!prevPageUrl"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium bg-neutral-800 border border-neutral-700 text-neutral-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-neutral-700 transition active:scale-95">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i> Prev
                </button>
                <button @click="fetchData(nextPageUrl)" :disabled="!nextPageUrl"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium bg-neutral-800 border border-neutral-700 text-neutral-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-neutral-700 transition active:scale-95">
                    Next <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT (Logic Tetap Sama) --}}
    <script>
        function taskApp() {
            return {
                data: [],
                isLoading: false,
                filters: {
                    status_id: ''
                },
                nextPageUrl: null,
                prevPageUrl: null,

                initApp() {
                    this.fetchData();
                    this.$nextTick(() => {
                        this.refreshIcons();
                    });
                },

                refreshIcons() {
                    setTimeout(() => {
                        if (window.lucide && window.lucide.createIcons && window.lucide.icons) {
                            window.lucide.createIcons({
                                icons: window.lucide.icons
                            });
                        }
                    }, 50);
                },

                async fetchData(url = "{{ route('task.index') }}") {
                    this.isLoading = true;
                    const params = new URL(url);

                    if (this.filters.status_id) params.searchParams.set('status_id', this.filters.status_id);
                    params.searchParams.set('fetch_mode', '1');

                    try {
                        const response = await fetch(params.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) throw new Error('Gagal memuat data');
                        const json = await response.json();

                        this.data = json.data;
                        this.nextPageUrl = json.next_page_url;
                        this.prevPageUrl = json.prev_page_url;

                        this.$nextTick(() => {
                            this.refreshIcons();
                        });

                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.isLoading = false;
                    }
                },

                resetFilters() {
                    this.filters.status_id = '';
                    this.fetchData();
                },

                deleteItem(url) {
                    if (!confirm('Yakin ingin menghapus tugas ini?')) return;

                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }).then(res => {
                        if (res.ok) {
                            this.fetchData();
                        } else {
                            alert('Gagal menghapus data.');
                        }
                    });
                }
            }
        }
    </script>
</x-app-layout>
