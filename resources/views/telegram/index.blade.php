<x-app-layout>
    <x-slot:title>Hubungkan Telegram</x-slot:title>

    {{-- ROOT ALPINE JS --}}
    {{-- Kita inisialisasi data 'chatId' dengan nilai dari database controller --}}
    <div class="max-w-2xl mx-auto py-10 px-4 sm:px-6 lg:px-8" x-data="telegramApp('{{ $telegram ?? '' }}')">

        <div class="bg-neutral-800 border border-neutral-700 rounded-xl shadow-lg overflow-hidden">

            {{-- Header Card --}}
            <div class="p-6 border-b border-neutral-700 bg-neutral-800/50">
                <div class="flex items-center gap-3 mb-2">
                    <div class="p-2 rounded-lg bg-blue-500/10 border border-blue-500/20 text-blue-400">
                        {{-- Icon Telegram Plane --}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="22" x2="11" y1="2" y2="13" />
                            <polygon points="22 2 15 22 11 13 2 9 22 2" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-white">Notifikasi Telegram</h2>
                </div>
                <p class="text-neutral-400 text-sm">
                    Dapatkan ringkasan jadwal dan tugas harian langsung di aplikasi Telegram Anda setiap pagi (07:00
                    WIB).
                </p>
            </div>

            <div class="p-6 space-y-8">

                {{-- Tutorial Section --}}
                <div class="bg-neutral-900/50 rounded-xl p-5 border border-neutral-700/50 text-sm text-neutral-300">
                    <h3 class="font-semibold text-white mb-3 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="text-amber-400">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 16v-4" />
                            <path d="M12 8h.01" />
                        </svg>
                        Cara mendapatkan ID Chat:
                    </h3>
                    <ol class="list-decimal list-inside space-y-2 text-neutral-400 ml-1">
                        <li>Buka aplikasi Telegram.</li>
                        <li>Cari bot kami: <a href="https://t.me/OnEasyNoteBot"
                                class="text-blue-400 font-medium cursor-pointer hover:underline">@EasyNote</a></li>
                        <li>Klik tombol <strong>Start</strong> atau ketik pesan apa saja.</li>
                        <li>Bot akan membalas dengan <strong>Chat ID</strong> Anda.</li>
                        <li>Salin angka tersebut dan tempel di form di bawah ini.</li>
                    </ol>
                </div>

                {{-- Form Input Section --}}
                <div class="space-y-4">
                    <div>
                        <label for="telegram" class="block text-sm font-medium text-neutral-300 mb-1">Telegram Chat
                            ID</label>
                        <div class="flex gap-2">
                            {{-- Input Field --}}
                            <input type="text" x-model="chatId" id="telegram" placeholder="Contoh: 123456789"
                                class="flex-1 rounded-lg bg-neutral-900 border-neutral-700 text-white placeholder-neutral-600 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition disabled:opacity-50"
                                :disabled="isLoading">

                            {{-- Tombol Simpan --}}
                            <button @click="saveId()"
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-500 text-white rounded-lg font-medium transition flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed shadow-lg shadow-blue-900/20"
                                :disabled="isLoading">

                                {{-- Loading Spinner --}}
                                <svg x-show="isLoading" class="animate-spin w-4 h-4" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>

                                {{-- Text Button --}}
                                <span
                                    x-text="isLoading ? 'Menyimpan...' : (isConnected ? 'Update ID' : 'Simpan ID')"></span>
                            </button>
                        </div>
                        <p class="text-xs text-neutral-500 mt-2">Pastikan ID benar agar notifikasi sampai.</p>
                    </div>

                    {{-- Status Indicator (Hanya muncul jika sudah terhubung) --}}
                    <div x-show="isConnected" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="flex items-center justify-between p-4 rounded-lg bg-emerald-500/10 border border-emerald-500/20 mt-4">

                        <div class="flex items-center gap-3">
                            <div class="p-1.5 rounded-full bg-emerald-500/20 text-emerald-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 6 9 17l-5-5" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-emerald-400">Terhubung</p>
                                <p class="text-xs text-emerald-500/80">Notifikasi aktif.</p>
                            </div>
                        </div>

                        {{-- Tombol Putus Koneksi --}}
                        <button @click="disconnect()"
                            class="text-sm text-red-400 hover:text-red-300 hover:underline decoration-red-400/30 transition flex items-center gap-1"
                            :disabled="isLoading">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                            </svg>
                            Putus Koneksi
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Script AlpineJS --}}
    <script>
        function telegramApp(initialId) {
            return {
                chatId: initialId, // Mengambil data awal dari Controller
                isLoading: false,

                // Computed property sederhana
                get isConnected() {
                    return this.chatId && this.chatId.length > 5; // Validasi sederhana
                },

                async saveId() {
                    if (!this.chatId) {
                        alert('Silakan isi Chat ID terlebih dahulu.');
                        return;
                    }

                    this.isLoading = true;

                    try {
                        const response = await fetch("{{ route('telegram.update') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                telegram: this.chatId
                            })
                        });

                        const data = await response.json();

                        if (response.ok) {
                            // Opsional: Tampilkan notifikasi toast/alert sukses
                            alert('Berhasil! ' + (data.message || 'Telegram ID tersimpan.'));
                        } else {
                            alert('Gagal: ' + (data.message || 'Terjadi kesalahan validasi.'));
                        }
                    } catch (e) {
                        console.error(e);
                        alert('Terjadi kesalahan koneksi. Cek internet Anda.');
                    } finally {
                        this.isLoading = false;
                    }
                },

                async disconnect() {
                    if (!confirm('Yakin ingin memutus koneksi? Anda tidak akan menerima notifikasi pagi lagi.')) return;

                    this.isLoading = true;

                    try {
                        const response = await fetch("{{ route('telegram.destroy') }}", {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        });

                        if (response.ok) {
                            this.chatId = ''; // Kosongkan input
                        } else {
                            alert('Gagal memutus koneksi.');
                        }
                    } catch (e) {
                        console.error(e);
                        alert('Terjadi kesalahan koneksi.');
                    } finally {
                        this.isLoading = false;
                    }
                }
            }
        }
    </script>
</x-app-layout>
