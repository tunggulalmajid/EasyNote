<x-app-layout>
    <x-slot:title>
        My Profile
    </x-slot:title>

    {{-- Container Tengah --}}
    <div class="max-w-3xl mx-auto py-8">

        <div class="bg-white border border-neutral-200 rounded-2xl shadow-sm overflow-hidden">

            {{-- 1. Decorative Header / Banner --}}
            <div class="h-32 bg-gradient-to-r from-neutral-800 to-neutral-700 relative">
                {{-- Hiasan pattern (optional) --}}
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
                            class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover bg-white">
                    </div>

                    {{-- Nama & Role --}}
                    <h2 class="mt-4 text-2xl font-bold text-neutral-900">{{ $user->name }}</h2>
                    <p class="text-neutral-500 text-sm">Bergabung sejak {{ $user->created_at->format('Y') }}</p>
                </div>

                {{-- Divider --}}
                <div class="border-t border-neutral-100 mb-8"></div>

                {{-- 3. Detail Informasi User (Grid Layout) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Item: Email --}}
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-neutral-50 border border-neutral-100">
                        <div class="p-2 bg-white rounded-lg border border-neutral-200 text-indigo-600">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Email Address</p>
                            <p class="text-sm font-medium text-neutral-800 mt-1">{{ $user->email }}</p>

                            {{-- Status Verifikasi Email --}}
                            <div class="mt-2">
                                @if ($user->email_verified_at)
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        <i data-lucide="check-circle-2" class="w-3 h-3"></i>
                                        Verified
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2 py-1 rounded-md text-xs font-medium bg-amber-100 text-amber-700 border border-amber-200">
                                        <i data-lucide="alert-circle" class="w-3 h-3"></i>
                                        Unverified
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Item: Joined Date --}}
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-neutral-50 border border-neutral-100">
                        <div class="p-2 bg-white rounded-lg border border-neutral-200 text-indigo-600">
                            <i data-lucide="calendar" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Bergabung Sejak
                            </p>
                            <p class="text-sm font-medium text-neutral-800 mt-1">
                                {{ $user->created_at->isoFormat('D MMMM Y') }}</p>
                            <p class="text-xs text-neutral-400 mt-1">
                                ({{ $user->created_at->diffForHumans() }})
                            </p>
                        </div>
                    </div>

                    {{-- Item: Last Update (Optional, ambil dari updated_at) --}}
                    <div class="flex items-start gap-4 p-4 rounded-xl bg-neutral-50 border border-neutral-100">
                        <div class="p-2 bg-white rounded-lg border border-neutral-200 text-indigo-600">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-neutral-400 uppercase tracking-wider">Terakhir Diupdate
                            </p>
                            <p class="text-sm font-medium text-neutral-800 mt-1">
                                {{ $user->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>

                </div>

                {{-- 4. Tombol Aksi (Pindah ke Edit) --}}
                <div class="mt-8 pt-8 border-t border-neutral-100 flex justify-end">
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-100 transition-all shadow-sm hover:shadow-md">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                        Edit Profil
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
