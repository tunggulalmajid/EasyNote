<x-app-layout>
    <x-slot:title>
        My Profile
    </x-slot:title>

    {{-- Container Tengah --}}
    <div class="max-w-3xl mx-auto py-8 px-4">

        {{-- Card Container (Dark Mode) --}}
        <div class="bg-neutral-800 border border-neutral-700 rounded-2xl shadow-lg overflow-hidden">

            {{-- 1. Decorative Header / Banner --}}
            <div class="h-32 bg-gradient-to-r from-neutral-900 to-neutral-800 relative">
                {{-- Hiasan pattern --}}
                <div class="absolute inset-0 opacity-10"
                    style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;">
                </div>
            </div>

            <div class="px-8 pb-8">

                {{-- 2. Foto Profil & Nama (Header Section) --}}
                <div class="flex flex-col items-center -mt-16 mb-8 text-center relative">
                    {{-- Foto Avatar --}}
                    <div class="relative">
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                            class="w-32 h-32 rounded-full border-4 border-neutral-800 shadow-xl object-cover bg-neutral-700">
                    </div>

                    {{-- Nama & Role --}}
                    <h2 class="mt-4 text-2xl font-bold text-white">{{ $user->name }}</h2>
                    <p class="text-neutral-400 text-sm">Bergabung sejak {{ $user->created_at->format('Y') }}</p>
                </div>

                {{-- Divider --}}
                <div class="border-t border-neutral-700 mb-8"></div>

                {{-- 3. Detail Informasi User (Grid Layout) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Item: Email --}}
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-neutral-900 border border-neutral-700">
                        <div class="p-2 bg-neutral-800 rounded-lg border border-neutral-700 text-indigo-400">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Email Address</p>
                            <p class="text-sm font-medium text-neutral-200 mt-1">{{ $user->email }}</p>

                            {{-- Status Verifikasi Email --}}
                            <div class="mt-2">
                                @if ($user->email_verified_at)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium bg-emerald-900/30 text-emerald-400 border border-emerald-800">
                                        <i data-lucide="check-circle-2" class="w-3 h-3"></i>
                                        Verified
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium bg-amber-900/30 text-amber-400 border border-amber-800">
                                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                        Unverified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Item: Joined Date --}}
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-neutral-900 border border-neutral-700">
                        <div class="p-2 bg-neutral-800 rounded-lg border border-neutral-700 text-indigo-400">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Bergabung Sejak
                            </p>
                            <p class="text-sm font-medium text-neutral-200 mt-1">
                                {{ $user->created_at->isoFormat('D MMMM Y') }}</p>
                            <p class="text-xs text-neutral-500 mt-1">
                                ({{ $user->created_at->diffForHumans() }})
                            </p>
                        </div>
                    </div>

                    {{-- Item: Last Update --}}
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-neutral-900 border border-neutral-700">
                        <div class="p-2 bg-neutral-800 rounded-lg border border-neutral-700 text-indigo-400">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-neutral-500 uppercase tracking-wider">Terakhir Diupdate
                            </p>
                            <p class="text-sm font-medium text-neutral-200 mt-1">
                                {{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                </div>

                {{-- 4. Tombol Aksi (Pindah ke Edit) --}}
                <div class="mt-8 pt-8 border-t border-neutral-700 flex justify-end">
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-500 focus:ring-4 focus:ring-indigo-900 transition-all shadow-lg shadow-indigo-900/20">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                        Edit Profil
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
