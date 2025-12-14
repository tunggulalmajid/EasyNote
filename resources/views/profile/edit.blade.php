<x-app-layout>
    <x-slot:title>
        Edit Profil
    </x-slot:title>

    <div class="max-w-4xl mx-auto space-y-8 py-6">

        <a href="{{ route('profile.index') }}" class="flex gap-2"> <i data-lucide="arrow-left"></i> Kembali</a>


        {{-- SECTION 1: UPDATE PROFILE INFORMATION --}}
        <section class="p-6 bg-white border border-neutral-200 rounded-xl shadow-sm">
            <header class="mb-6">
                <h2 class="text-lg font-semibold text-neutral-900">
                    Informasi Profil
                </h2>
                <p class="mt-1 text-sm text-neutral-500">
                    Update informasi profil akun, alamat email, dan foto profil kamu.
                </p>
            </header>

            {{-- Form Update Profile --}}
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('patch')

                {{-- Foto Profil (Dengan Preview AlpineJS) --}}
                <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                    <input type="file" name="foto_profil" class="hidden" x-ref="photo"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => { photoPreview = e.target.result; };
                            reader.readAsDataURL($refs.photo.files[0]);
                        " />

                    <label class="block text-sm font-medium text-neutral-700 mb-2">Foto Profil</label>

                    <div class="flex items-center gap-4">
                        <div x-show="!photoPreview">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                class="w-16 h-16 rounded-full object-cover border border-neutral-200">
                        </div>
                        <div x-show="photoPreview" style="display: none;">
                            <span class="block w-16 h-16 rounded-full bg-cover bg-center border border-neutral-200"
                                x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                            </span>
                        </div>
                        <button type="button" x-on:click.prevent="$refs.photo.click()"
                            class="px-3 py-2 bg-white border border-neutral-300 rounded-lg text-xs font-medium text-neutral-700 uppercase tracking-widest hover:bg-neutral-50 transition">
                            Pilih Foto
                        </button>
                    </div>
                    @error('foto_profil')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-neutral-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="mt-1 block w-full rounded-lg border-neutral-300 bg-neutral-50 border px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        required
                        class="mt-1 block w-full rounded-lg border-neutral-300 bg-neutral-50 border px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    {{-- Verifikasi Email Link --}}
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                        <div class="mt-2 p-3 bg-amber-50 rounded-lg border border-amber-100">
                            <p class="text-sm text-amber-800">
                                Email kamu belum diverifikasi.
                                <button form="send-verification" class="underline hover:text-amber-900 font-medium">
                                    Klik di sini untuk kirim ulang verifikasi.
                                </button>
                            </p>
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 text-sm font-medium text-emerald-600">
                                    Link verifikasi baru telah dikirim ke email kamu.
                                </p>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Simpan Profil
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-emerald-600 flex items-center gap-1">
                            <i data-lucide="check" class="w-4 h-4"></i> Tersimpan.
                        </p>
                    @endif
                </div>
            </form>
        </section>

        {{-- SECTION 2: UPDATE PASSWORD --}}
        <section class="p-6 bg-white border border-neutral-200 rounded-xl shadow-sm">
            <header class="mb-6">
                <h2 class="text-lg font-semibold text-neutral-900">
                    Update Password
                </h2>
                <p class="mt-1 text-sm text-neutral-500">
                    Pastikan akun kamu aman dengan menggunakan password yang panjang dan acak.
                </p>
            </header>

            <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                @method('put')

                <div>
                    <label for="current_password" class="block text-sm font-medium text-neutral-700">Password Saat
                        Ini</label>
                    <input type="password" name="current_password" id="current_password" autocomplete="current-password"
                        class="mt-1 block w-full rounded-lg border-neutral-300 bg-neutral-50 border px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                    @error('current_password', 'updatePassword')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-700">Password Baru</label>
                    <input type="password" name="password" id="password" autocomplete="new-password"
                        class="mt-1 block w-full rounded-lg border-neutral-300 bg-neutral-50 border px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                    @error('password', 'updatePassword')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-neutral-700">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        autocomplete="new-password"
                        class="mt-1 block w-full rounded-lg border-neutral-300 bg-neutral-50 border px-3 py-2 text-sm focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                    @error('password_confirmation', 'updatePassword')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit"
                        class="px-4 py-2 bg-neutral-800 text-white text-sm font-medium rounded-lg hover:bg-neutral-900 transition-colors">
                        Simpan Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-emerald-600 flex items-center gap-1">
                            <i data-lucide="check" class="w-4 h-4"></i> Password berhasil diupdate.
                        </p>
                    @endif
                </div>
            </form>
        </section>

        {{-- SECTION 3: DELETE ACCOUNT --}}
        <section class="p-6 bg-white border border-red-100 rounded-xl shadow-sm">
            <header class="mb-6">
                <h2 class="text-lg font-semibold text-red-600">
                    Hapus Akun
                </h2>
                <p class="mt-1 text-sm text-neutral-500">
                    Setelah akun dihapus, semua resource dan data akan hilang permanen. Silakan unduh data penting
                    sebelum menghapus.
                </p>
            </header>

            {{-- AlpineJS Modal untuk Delete --}}
            <div x-data="{
                open: false,
                init() {
                    @if ($errors->userDeletion->isNotEmpty()) this.open = true; @endif
                }
            }">

                {{-- Trigger Button --}}
                <button @click="open = true"
                    class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                    Hapus Akun
                </button>

                {{-- Modal Overlay --}}
                <div x-show="open" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-neutral-900/60 backdrop-blur-sm"
                    x-cloak>

                    {{-- Modal Content --}}
                    <div @click.outside="open = false" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                        class="bg-white rounded-xl shadow-xl max-w-md w-full p-6 overflow-hidden">

                        <h2 class="text-lg font-bold text-neutral-900">
                            Yakin ingin menghapus akun?
                        </h2>

                        <p class="mt-2 text-sm text-neutral-500">
                            Masukkan password kamu untuk mengonfirmasi bahwa kamu ingin menghapus akun ini secara
                            permanen. Tindakan ini tidak bisa dibatalkan.
                        </p>

                        <form method="post" action="{{ route('profile.destroy') }}" class="mt-6">
                            @csrf
                            @method('delete')

                            <div>
                                <label for="password_deletion" class="sr-only">Password</label>
                                <input type="password" name="password" id="password_deletion"
                                    placeholder="Password Akun"
                                    class="block w-full rounded-lg border-neutral-300 bg-neutral-50 border px-3 py-2 text-sm focus:border-red-500 focus:ring-red-500 shadow-sm">
                                @error('password', 'userDeletion')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 bg-white border border-neutral-300 text-neutral-700 text-sm font-medium rounded-lg hover:bg-neutral-50 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                                    Ya, Hapus Akun
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-app-layout>
