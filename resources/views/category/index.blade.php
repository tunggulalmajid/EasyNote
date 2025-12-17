<x-app-layout>
    <x-slot:title>Kelola Kategori</x-slot:title>

    {{-- ROOT ALPINE JS --}}
    <div class="max-w-5xl mx-auto py-8 px-4 sm:px-6 lg:px-8 space-y-6" x-data="categoryApp()" x-init="initApp()">

        {{-- === HEADER (Sesuai Referensi) === --}}
        <div
            class="flex flex-col md:flex-row justify-between items-center gap-4 bg-neutral-800 p-4 rounded-xl shadow-lg border border-neutral-700">
            <h2 class="text-xl font-bold text-white flex items-center gap-2 w-full sm:w-auto">
                <i data-lucide="layers" class="w-6 h-6 text-indigo-400"></i>
                Daftar Kategori
            </h2>

            {{-- Tombol Tambah --}}
            <button @click="openModal()"
                class="w-full md:w-auto ml-auto md:ml-2 inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg shadow-indigo-900/20 active:scale-95">
                <i data-lucide="plus" class="w-4 h-4"></i>
                <span class="hidden sm:inline">Tambah</span>
                <span class="sm:hidden">Tambah Kategori</span>
            </button>
        </div>

        {{-- === LOADING STATE === --}}
        <div x-show="isLoading" class="py-20 text-center">
            <div class="inline-block animate-spin text-indigo-400 mb-2">
                <i data-lucide="loader-2" class="w-8 h-8"></i>
            </div>
            <p class="text-neutral-500 text-sm">Sedang memuat data...</p>
        </div>

        {{-- === LIST DATA (CARD STYLE) === --}}
        {{-- Menggunakan style flex-col (HP) -> flex-row (Desktop) agar responsive otomatis --}}
        <div class="space-y-4" x-show="!isLoading" style="display: none;">

            <template x-for="(item, index) in data" :key="item.id">
                <div
                    class="group bg-neutral-800 rounded-xl shadow-lg border border-neutral-700 p-5 flex flex-col sm:flex-row items-start sm:items-center gap-5 hover:bg-neutral-750 transition-all duration-300">

                    {{-- Kolom 1: Icon Folder & Jumlah Task --}}
                    <div class="flex items-center gap-4 min-w-[120px]">
                        {{-- Icon Box --}}
                        <div
                            class="w-12 h-12 rounded-lg bg-neutral-700/50 border border-neutral-600 flex items-center justify-center shadow-sm group-hover:border-indigo-500/50 transition">
                            <i data-lucide="folder" class="w-6 h-6 text-indigo-400"></i>
                        </div>

                        {{-- Counter --}}
                        <div class="flex flex-col">
                            <span class="font-bold text-white text-xl" x-text="item.tasks_count"></span>
                            <span class="text-neutral-500 text-xs uppercase tracking-wider font-medium">Tasks</span>
                        </div>
                    </div>

                    {{-- Kolom 2: Info Kategori --}}
                    <div
                        class="flex-1 w-full border-t sm:border-t-0 sm:border-l border-neutral-700 pt-4 sm:pt-0 sm:pl-5">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs font-mono text-neutral-500 bg-neutral-900 px-1.5 py-0.5 rounded"
                                x-text="'#' + (from + index)"></span>
                            <h3 class="text-lg font-bold text-white group-hover:text-indigo-300 transition-colors line-clamp-1"
                                x-text="item.category"></h3>
                        </div>

                        <div class="flex items-center gap-2 text-sm text-neutral-400">
                            <i data-lucide="user" class="w-3.5 h-3.5"></i>
                            <span x-text="item.pemilik"></span>
                        </div>
                    </div>

                    {{-- Kolom 3: Aksi --}}
                    <div class="flex items-center justify-end w-full sm:w-auto gap-2 mt-2 sm:mt-0">
                        {{-- Edit --}}
                        <button @click="editData(item)"
                            class="p-2.5 text-neutral-400 hover:text-indigo-400 hover:bg-indigo-900/20 rounded-lg transition border border-transparent hover:border-indigo-500/30"
                            title="Edit">
                            <i data-lucide="pencil" class="w-5 h-5"></i>
                        </button>

                        {{-- Delete (Disabled logic) --}}
                        <button @click="item.tasks_count === 0 ? deleteItem(item.id) : null"
                            :disabled="item.tasks_count > 0"
                            :class="item.tasks_count > 0 ? 'opacity-30 cursor-not-allowed text-neutral-600' :
                                'text-neutral-400 hover:text-red-400 hover:bg-red-900/20 hover:border-red-500/30'"
                            class="p-2.5 rounded-lg transition border border-transparent" title="Hapus">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </div>

                </div>
            </template>

            {{-- Empty State --}}
            <div x-show="data.length === 0"
                class="text-center py-12 bg-neutral-800 rounded-xl border border-dashed border-neutral-700">
                <div class="w-16 h-16 bg-neutral-900 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="folder-open" class="w-8 h-8 text-neutral-600"></i>
                </div>
                <h3 class="text-lg font-medium text-white">Belum ada Kategori</h3>
                <p class="text-neutral-400 text-sm mt-1">Silakan tambahkan kategori baru.</p>
            </div>

            {{-- Pagination --}}
            <div class="flex justify-between items-center mt-6 pt-4 border-t border-neutral-700"
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

        {{-- === MODAL FORM === --}}
        <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <div class="fixed inset-0 bg-black/80 backdrop-blur-sm" @click="closeModal()"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <form @submit.prevent="saveData()"
                    class="relative w-full max-w-lg bg-neutral-800 rounded-2xl shadow-2xl border border-neutral-700 p-6 transform transition-all">

                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-white" x-text="isEdit ? 'Edit Kategori' : 'Tambah Kategori'">
                        </h3>
                        <button type="button" @click="closeModal()"
                            class="text-neutral-400 hover:text-white bg-neutral-700/50 hover:bg-neutral-600 rounded-full p-1.5 transition">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-medium text-neutral-400 mb-2">Nama Kategori</label>
                            <input type="text" x-model="form.category"
                                class="w-full rounded-xl bg-neutral-900 border-neutral-700 text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 py-2.5 px-4 shadow-sm placeholder-neutral-600 transition"
                                placeholder="Contoh: Pekerjaan, Pribadi...">
                            <span x-show="errors.category" x-text="errors.category"
                                class="text-red-400 text-xs mt-1.5 block font-medium"></span>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col-reverse sm:flex-row justify-end gap-3">
                        <button type="button" @click="closeModal()"
                            class="w-full sm:w-auto px-4 py-2.5 text-sm font-medium text-neutral-300 bg-neutral-700 rounded-lg hover:bg-neutral-600 transition text-center active:scale-95">
                            Batal
                        </button>
                        <button type="submit" :disabled="isProcessing"
                            class="w-full sm:w-auto px-4 py-2.5 text-sm font-bold text-white bg-indigo-600 rounded-lg hover:bg-indigo-500 transition shadow-lg shadow-indigo-900/30 flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed active:scale-95">
                            <span x-show="isProcessing" class="animate-spin"><i data-lucide="loader-2"
                                    class="w-4 h-4"></i></span>
                            <span x-text="isEdit ? 'Simpan Perubahan' : 'Simpan Kategori'"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    {{-- SCRIPT --}}
    <script>
        function categoryApp() {
            return {
                data: [],
                isLoading: false,
                isProcessing: false,
                showModal: false,
                isEdit: false,
                from: 1,
                nextPageUrl: null,
                prevPageUrl: null,
                form: {
                    id: null,
                    category: ''
                },
                errors: {},

                initApp() {
                    this.fetchData();
                    this.$nextTick(() => {
                        this.refreshIcons();
                    });
                },

                refreshIcons() {
                    setTimeout(() => {
                        // Support untuk window.lucide atau global lucide
                        if (window.lucide && window.lucide.createIcons && window.lucide.icons) {
                            window.lucide.createIcons({
                                icons: window.lucide.icons
                            });
                        }
                    }, 50);
                },

                getCsrfToken() {
                    const token = document.querySelector('meta[name="csrf-token"]');
                    if (!token) {
                        alert('ERROR SISTEM: Meta CSRF Token tidak ditemukan di layout.');
                        return '';
                    }
                    return token.getAttribute('content');
                },

                async fetchData(url = "{{ route('category.index') }}") {
                    this.isLoading = true;
                    try {
                        const params = new URL(url);
                        params.searchParams.set('fetch_mode', '1');

                        const response = await fetch(params.toString(), {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        });

                        const contentType = response.headers.get("content-type");
                        if (!contentType || !contentType.includes("application/json")) {
                            throw new Error("Server Error: Bukan JSON");
                        }

                        const json = await response.json();
                        this.data = json.data;
                        this.from = json.from ?? 1;
                        this.nextPageUrl = json.next_page_url;
                        this.prevPageUrl = json.prev_page_url;

                        this.$nextTick(() => {
                            this.refreshIcons();
                        });
                    } catch (e) {
                        console.error(e);
                    } finally {
                        this.isLoading = false;
                    }
                },

                openModal() {
                    this.resetForm();
                    this.showModal = true;
                    this.isEdit = false;
                    this.$nextTick(() => {
                        this.refreshIcons();
                    });
                },

                closeModal() {
                    this.showModal = false;
                    this.resetForm();
                },

                resetForm() {
                    this.form = {
                        id: null,
                        category: ''
                    };
                    this.errors = {};
                    this.isProcessing = false;
                },

                editData(item) {
                    this.form.id = item.id;
                    this.form.category = item.category;
                    this.isEdit = true;
                    this.showModal = true;
                    this.$nextTick(() => {
                        this.refreshIcons();
                    });
                },

                async saveData() {
                    this.isProcessing = true;
                    this.errors = {};

                    const url = this.isEdit ? `/category/${this.form.id}` : "{{ route('category.store') }}";
                    const method = this.isEdit ? 'PUT' : 'POST';

                    try {
                        const csrfToken = this.getCsrfToken();
                        if (!csrfToken) return;

                        const response = await fetch(url, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                category: this.form.category
                            })
                        });

                        const contentType = response.headers.get("content-type");
                        if (!contentType || !contentType.includes("application/json")) {
                            throw new Error('Server Error');
                        }

                        const data = await response.json();

                        if (!response.ok) {
                            if (response.status === 422) {
                                this.errors = data.errors;
                            } else {
                                alert(data.message || 'Terjadi kesalahan sistem.');
                            }
                            return;
                        }

                        this.closeModal();
                        this.fetchData();

                    } catch (error) {
                        console.error("Save Error:", error);
                        if (!this.errors.category) {
                            alert('Gagal menyimpan data.');
                        }
                    } finally {
                        this.isProcessing = false;
                    }
                },

                async deleteItem(id) {
                    if (!confirm('Hapus kategori ini?')) return;

                    try {
                        const csrfToken = this.getCsrfToken();
                        if (!csrfToken) return;

                        const response = await fetch(`/category/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        const data = await response.json();

                        if (response.ok) {
                            this.fetchData();
                        } else {
                            alert(data.message || 'Gagal menghapus data.');
                        }
                    } catch (error) {
                        console.error("Delete Error:", error);
                        alert('Terjadi kesalahan sistem saat menghapus.');
                    }
                }
            }
        }
    </script>
</x-app-layout>
