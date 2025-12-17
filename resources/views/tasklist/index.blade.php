<x-app-layout>
    <x-slot:title>Daftar Tugas</x-slot:title>

    {{-- ROOT ALPINE JS --}}
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6" x-data="taskApp()" x-init="fetchData()">

        {{-- === HEADER & FILTER === --}}
        <div
            class="flex flex-col md:flex-row justify-between items-center gap-4 bg-neutral-800 p-4 rounded-xl shadow-lg border border-neutral-700">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                {{-- Icon Layout List --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-6 h-6 text-indigo-400">
                    <rect width="18" height="18" x="3" y="3" rx="2" ry="2" />
                    <line x1="3" x2="21" y1="9" y2="9" />
                    <line x1="9" x2="9" y1="21" y2="9" />
                </svg>
                Daftar Tugas
            </h2>

            <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">

                {{-- Filter Status --}}
                <select x-model="filters.status_id" @change="fetchData()"
                    class="w-full md:w-auto rounded-lg bg-neutral-900 border-neutral-700 text-neutral-200 text-sm focus:ring-indigo-500 focus:border-indigo-500 cursor-pointer shadow-sm placeholder-neutral-500">
                    <option value="">Semua Status</option>
                    @foreach ($statuses as $stat)
                        <option value="{{ $stat->id }}">{{ $stat->status }}</option>
                    @endforeach
                </select>

                {{-- Reset Button --}}
                <button x-show="filters.status_id !== ''" @click="resetFilters()"
                    class="text-sm text-red-400 hover:text-red-300 font-medium transition" style="display: none;">
                    Reset
                </button>

                {{-- Tombol Tambah --}}
                <a href="{{ route('task.create') }}"
                    class="ml-auto md:ml-2 inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg shadow-indigo-900/20">
                    {{-- Plus Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-4 h-4">
                        <path d="M5 12h14" />
                        <path d="M12 5v14" />
                    </svg>
                    <span class="hidden sm:inline">Tugas Baru</span>
                </a>
            </div>
        </div>

        {{-- === TABEL DATA === --}}
        <div class="bg-neutral-800 overflow-hidden shadow-sm sm:rounded-xl border border-neutral-700">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-neutral-700">
                    <thead class="bg-neutral-750/50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-neutral-400 uppercase tracking-wider">
                                Tugas & Deskripsi
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-neutral-400 uppercase tracking-wider">
                                Kategori
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-neutral-400 uppercase tracking-wider">
                                Deadline
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-medium text-neutral-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-4 text-center text-xs font-medium text-neutral-400 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-neutral-700 bg-neutral-800">

                        {{-- Loading State --}}
                        <tr x-show="isLoading">
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center gap-2 text-indigo-400">
                                    {{-- Loader SVG --}}
                                    <svg class="animate-spin w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10"
                                            stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    <span class="text-neutral-400 text-sm">Memuat data...</span>
                                </div>
                            </td>
                        </tr>

                        {{-- Data Loop --}}
                        <template x-for="item in data" :key="item.id">
                            <tr class="hover:bg-neutral-700/30 transition-colors duration-150 group">

                                {{-- Kolom 1: Tugas --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-3">
                                        <div class="mt-1.5 w-2.5 h-2.5 rounded-full shrink-0" :class="item.colors.dot">
                                        </div>
                                        <div>
                                            {{-- Link Judul ke Show --}}
                                            <a :href="item.urls.show"
                                                class="text-sm font-bold text-white hover:text-indigo-400 transition"
                                                x-text="item.task"></a>
                                            <div class="text-sm text-neutral-500 mt-0.5 line-clamp-1 w-48 sm:w-64"
                                                :title="item.deskripsi" x-text="item.deskripsi || '-'"></div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom 2: Kategori --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium bg-neutral-700 text-neutral-300 border border-neutral-600">
                                        <span x-text="item.category"></span>
                                    </span>
                                </td>

                                {{-- Kolom 3: Deadline --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col items-start gap-1">
                                        <div class="text-sm text-neutral-300 font-medium" x-text="item.deadline_fmt">
                                        </div>
                                        <span
                                            class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold tracking-wide uppercase"
                                            :class="item.deadline_class">
                                            {{-- Clock Icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="w-3 h-3 mr-1">
                                                <circle cx="12" cy="12" r="10" />
                                                <polyline points="12 6 12 12 16 14" />
                                            </svg>
                                            <span x-text="item.deadline_diff"></span>
                                        </span>
                                    </div>
                                </td>

                                {{-- Kolom 4: Status --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-neutral-400" x-text="item.status_label"></span>
                                </td>

                                {{-- Kolom 5: Aksi --}}
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    <div class="flex items-center justify-center gap-2">

                                        {{-- 1. Tombol Detail/Show --}}
                                        <a :href="item.urls.show"
                                            class="p-1.5 text-neutral-400 hover:text-teal-400 hover:bg-teal-900/20 rounded-lg transition"
                                            title="Detail">
                                            {{-- Eye Icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="w-4 h-4">
                                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                                <circle cx="12" cy="12" r="3" />
                                            </svg>
                                        </a>

                                        {{-- 2. Tombol Edit --}}
                                        <a :href="item.urls.edit"
                                            class="p-1.5 text-neutral-400 hover:text-indigo-400 hover:bg-indigo-900/20 rounded-lg transition"
                                            title="Edit">
                                            {{-- Pencil Icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="w-4 h-4">
                                                <path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z" />
                                                <path d="m15 5 4 4" />
                                            </svg>
                                        </a>

                                        {{-- 3. Tombol Hapus --}}
                                        <button @click="deleteItem(item.urls.delete)"
                                            class="p-1.5 text-neutral-400 hover:text-red-400 hover:bg-red-900/20 rounded-lg transition"
                                            title="Hapus">
                                            {{-- Trash Icon --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="w-4 h-4">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                <line x1="10" x2="10" y1="11" y2="17" />
                                                <line x1="14" x2="14" y1="11" y2="17" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        {{-- Empty State --}}
                        <tr x-show="!isLoading && data.length === 0" style="display: none;">
                            <td colspan="5" class="px-6 py-12 text-center text-neutral-500">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    {{-- Inbox Icon --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="w-8 h-8 text-neutral-600">
                                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12" />
                                        <path
                                            d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z" />
                                    </svg>
                                    <p>Tidak ada tugas yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            {{-- Pagination Footer --}}
            <div class="bg-neutral-800 px-4 py-3 border-t border-neutral-700 sm:px-6 flex items-center justify-between"
                x-show="nextPageUrl || prevPageUrl">
                <button @click="fetchData(prevPageUrl)" :disabled="!prevPageUrl"
                    class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-neutral-750 border border-neutral-600 text-neutral-300 rounded hover:bg-neutral-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                    {{-- Chevron Left --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-3 h-3">
                        <path d="m15 18-6-6 6-6" />
                    </svg>
                    Prev
                </button>
                <button @click="fetchData(nextPageUrl)" :disabled="!nextPageUrl"
                    class="flex items-center gap-1 px-3 py-1.5 text-xs font-medium bg-neutral-750 border border-neutral-600 text-neutral-300 rounded hover:bg-neutral-700 disabled:opacity-50 disabled:cursor-not-allowed transition">
                    Next
                    {{-- Chevron Right --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="w-3 h-3">
                        <path d="m9 18 6-6-6-6" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- SCRIPT ALPINE JS --}}
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

                async fetchData(url = "{{ route('task.index') }}") {
                    this.isLoading = true;

                    // Membuat objek URL agar mudah dimanipulasi
                    const params = new URL(url);

                    // Filter Status
                    if (this.filters.status_id) {
                        params.searchParams.set('status_id', this.filters.status_id);
                    }

                    // === SOLUSI UNTUK TOMBOL BACK (BROWSER CACHE) ===
                    // Kita tambahkan parameter 'fetch_mode=1'
                    // Ini membuat URL fetch berbeda dengan URL halaman (misal: /task?fetch_mode=1 vs /task)
                    // Sehingga saat tombol BACK ditekan, browser tidak akan mengambil cache JSON
                    params.searchParams.set('fetch_mode', '1');

                    try {
                        const response = await fetch(params.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest', // Wajib agar Controller return JSON
                                'Accept': 'application/json'
                            }
                        });

                        if (!response.ok) throw new Error('Gagal memuat data');

                        const json = await response.json();

                        this.data = json.data;
                        this.nextPageUrl = json.next_page_url;
                        this.prevPageUrl = json.prev_page_url;

                    } catch (error) {
                        console.error("Error fetching tasks:", error);
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
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    }).then(res => {
                        if (res.ok) {
                            this.fetchData(); // Reload tabel otomatis
                        } else {
                            alert('Gagal menghapus data.');
                        }
                    });
                }
            }
        }
    </script>
</x-app-layout> 
