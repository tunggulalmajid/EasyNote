<x-app-layout>
    <x-slot:title>Jadwal Kegiatan</x-slot:title>

    {{-- CONTAINER: w-full max-w-full overflow-hidden (PENTING) --}}
    <div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8 space-y-6 w-full max-w-full overflow-hidden"
        x-data="kegiatanApp('{{ date('Y-m-d') }}')" x-init="fetchData()">

        {{-- === HEADER & FILTER === --}}
        <div class="bg-neutral-800 p-4 sm:p-5 rounded-xl shadow-lg border border-neutral-700 w-full">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">

                <h2 class="text-xl font-bold text-white flex items-center gap-2 w-full md:w-auto">
                    <i data-lucide="calendar-days" class="w-6 h-6 text-indigo-400"></i>
                    Kegiatan
                </h2>

                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">

                    {{-- Filter Tanggal --}}
                    <div class="relative w-full sm:w-auto">
                        <input type="date" x-model="filters.tanggal" @change="fetchData()"
                            class="w-full sm:w-auto pl-10 rounded-lg bg-neutral-900 border-neutral-700 text-neutral-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer shadow-sm placeholder-neutral-500"
                            style="color-scheme: dark;">
                        <i data-lucide="calendar"
                            class="w-4 h-4 text-neutral-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                    </div>

                    {{-- Filter Status --}}
                    <select x-model="filters.status_id" @change="fetchData()"
                        class="w-full sm:w-auto rounded-lg bg-neutral-900 border-neutral-700 text-neutral-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer shadow-sm">
                        <option value="">Semua Status</option>
                        @foreach ($statuses as $stat)
                            <option value="{{ $stat->id }}">{{ $stat->status }}</option>
                        @endforeach
                    </select>

                    <button x-show="filters.tanggal !== '{{ date('Y-m-d') }}' || filters.status_id !== ''"
                        @click="resetFilters()"
                        class="text-sm text-red-400 hover:text-red-300 font-medium transition text-center sm:text-left"
                        style="display: none;">
                        Reset
                    </button>

                    <a href="{{ route('kegiatan.create') }}"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg shadow-indigo-900/20 active:scale-95">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span>Tambah</span>
                    </a>
                </div>
            </div>
        </div>

        <div x-show="filters.tanggal === '{{ date('Y-m-d') }}'" style="display: none;">
            <span
                class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-900/50 text-indigo-300 border border-indigo-700/50">
                <span class="relative flex h-2 w-2">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                Menampilkan Kegiatan Hari Ini
            </span>
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
                <div class="group bg-neutral-800 rounded-xl shadow-lg border border-neutral-700 border-l-[6px] p-5 flex flex-col sm:flex-row items-start gap-4 sm:gap-6 hover:bg-neutral-750 transition-all duration-300 relative overflow-hidden w-full max-w-full"
                    :class="item.colors.border">

                    {{-- Kolom 1: Waktu & Dot --}}
                    <div
                        class="flex flex-row sm:flex-col items-center sm:items-start gap-3 w-full sm:w-auto sm:min-w-[140px] shrink-0">
                        <div class="w-3.5 h-3.5 rounded-full shadow-sm ring-2 ring-neutral-800 shrink-0"
                            :class="item.colors.dot"></div>

                        <div class="flex flex-col">
                            <span class="font-bold text-white text-base" x-text="item.tanggal_fmt"></span>
                            <span class="text-neutral-400 text-sm flex items-center gap-1.5 mt-0.5">
                                <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                <span x-text="item.waktu_fmt"></span>
                            </span>
                        </div>
                    </div>

                    {{-- Kolom 2: Konten (FIXED) --}}
                    {{-- Gunakan min-w-0 agar flex item mau mengecil --}}
                    <div
                        class="flex-1 w-full min-w-0 pt-4 sm:pt-0 sm:pl-5 border-t sm:border-t-0 sm:border-l border-neutral-700">

                        {{-- Judul: break-all (paksa potong) --}}
                        <h3 class="text-lg font-bold text-white group-hover:text-indigo-400 transition-colors line-clamp-2 sm:line-clamp-1 break-all"
                            x-text="item.kegiatan"></h3>

                        {{-- Deskripsi: break-all (paksa potong) + line-clamp --}}
                        <p class="text-sm text-neutral-400 mt-1 line-clamp-3 sm:line-clamp-2 leading-relaxed break-all"
                            x-text="item.deskripsi || 'Tidak ada deskripsi tambahan.'"></p>
                    </div>

                    {{-- Kolom 3: Status & Action --}}
                    <div
                        class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-4 mt-2 sm:mt-0 pt-3 sm:pt-0 border-t sm:border-t-0 border-neutral-700 shrink-0">

                        <span
                            class="px-3 py-1 rounded-md text-xs font-bold uppercase tracking-wider bg-neutral-900 text-neutral-400 border border-neutral-700"
                            x-text="item.status_label"></span>

                        <div class="flex items-center gap-1">
                            <a :href="item.urls.edit"
                                class="p-2 text-neutral-400 hover:text-indigo-400 hover:bg-indigo-900/30 rounded-lg transition"
                                title="Edit">
                                <i data-lucide="pencil" class="w-4 h-4"></i>
                            </a>

                            <button @click="deleteItem(item.urls.delete)"
                                class="p-2 text-neutral-400 hover:text-red-400 hover:bg-red-900/20 rounded-lg transition"
                                title="Hapus">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Empty State --}}
            <div x-show="data.length === 0"
                class="text-center py-12 bg-neutral-800 rounded-xl border border-dashed border-neutral-700 w-full">
                <div class="w-16 h-16 bg-neutral-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="calendar-off" class="w-8 h-8 text-neutral-600"></i>
                </div>
                <h3 class="text-lg font-medium text-white">Jadwal Kosong</h3>
                <p class="text-neutral-400 text-sm mt-1">Tidak ada kegiatan pada filter ini.</p>
            </div>

            {{-- Pagination --}}
            <div class="flex justify-between items-center mt-6 border-t border-neutral-700 pt-4"
                x-show="nextPageUrl || prevPageUrl">
                <button @click="fetchData(prevPageUrl)" :disabled="!prevPageUrl"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium bg-neutral-800 border border-neutral-700 text-neutral-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-neutral-700 transition">
                    <i data-lucide="chevron-left" class="w-4 h-4"></i> Sebelumnya
                </button>
                <button @click="fetchData(nextPageUrl)" :disabled="!nextPageUrl"
                    class="flex items-center gap-2 px-4 py-2 text-sm font-medium bg-neutral-800 border border-neutral-700 text-neutral-300 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed hover:bg-neutral-700 transition">
                    Selanjutnya <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        function kegiatanApp(defaultDate) {
            return {
                data: [],
                isLoading: false,
                filters: {
                    tanggal: defaultDate,
                    status_id: ''
                },
                nextPageUrl: null,
                prevPageUrl: null,

                async fetchData(url = "{{ route('kegiatan.index') }}") {
                    this.isLoading = true;
                    const params = new URL(url);

                    if (this.filters.tanggal) params.searchParams.set('tanggal', this.filters.tanggal);
                    if (this.filters.status_id) params.searchParams.set('status_id', this.filters.status_id);

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
                            if (window.lucide) {
                                window.lucide.createIcons({
                                    icons: window.lucide.icons
                                });
                            }
                        });
                    } catch (error) {
                        console.error(error);
                    } finally {
                        this.isLoading = false;
                    }
                },

                resetFilters() {
                    this.filters.tanggal = defaultDate;
                    this.filters.status_id = '';
                    this.fetchData();
                },

                deleteItem(url) {
                    if (!confirm('Hapus kegiatan ini?')) return;
                    fetch(url, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }).then(() => this.fetchData());
                }
            }
        }
    </script>
</x-app-layout>
