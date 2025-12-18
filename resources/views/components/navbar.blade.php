<header class="sticky top-0 z-40 bg-neutral-900/90 backdrop-blur border-b border-neutral-800" x-data="{ isOpen: false }">

    <nav class="max-w-6xl mx-auto flex items-center justify-between px-4 py-8">
        {{-- Brand --}}
        <a href="#home" class="flex items-center gap-x-2 text-xl font-semibold focus:outline-hidden focus:opacity-80">
            <span class="inline-flex items-center gap-x-2">
                {{-- Pastikan ikon Lucide sudah terload, atau gunakan SVG manual jika perlu --}}
                <i data-lucide="circle-check-big" class="w-8 h-8 text-white"></i>
                <span class="font-semibold tracking-wide text-white">EasyNote</span>
            </span>
        </a>

        {{-- Right side --}}
        <div class="flex items-center gap-x-6">
            {{-- Menu desktop --}}
            <div class="hidden sm:flex items-center gap-x-6 text-sm font-medium">
                <a href="#home" class="text-white hover:text-neutral-300 focus:outline-hidden">Home</a>
                <a href="#about" class="text-white hover:text-neutral-300 focus:outline-hidden">About</a>
                <a href="#features" class="text-white hover:text-neutral-300 focus:outline-hidden">Features</a>

                @auth
                    <a href="{{ route('dashboard') }}"
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-neutral-700 bg-neutral-800 text-white shadow-sm hover:bg-neutral-700 focus:outline-hidden">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-neutral-700 bg-neutral-800 text-white shadow-sm hover:bg-neutral-700 focus:outline-hidden">
                        Get Started
                    </a>
                @endauth
            </div>

            {{-- Mobile Burger Button --}}
            <button type="button" @click="isOpen = !isOpen"
                class="sm:hidden relative size-9 flex justify-center items-center rounded-lg border border-neutral-700 bg-neutral-900 text-white hover:bg-neutral-800 focus:outline-hidden"
                aria-label="Toggle navigation">

                {{-- Icon Hamburger (Muncul saat isOpen false) --}}
                <svg x-show="!isOpen" class="size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                {{-- Icon Close (Muncul saat isOpen true) --}}
                <svg x-show="isOpen" style="display: none;" class="size-5" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </nav>

    {{-- Menu Mobile --}}
    {{-- Menggunakan x-show dan x-transition untuk animasi --}}
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2" @click.away="isOpen = false" style="display: none;"
        class="sm:hidden border-t border-neutral-800 bg-neutral-900 shadow-lg">

        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-3 text-sm font-medium">
            {{-- Tambahkan @click="isOpen = false" agar menu menutup saat link diklik --}}
            <a href="#home" @click="isOpen = false" class="text-white hover:text-neutral-300 block py-2">Home</a>
            <a href="#about" @click="isOpen = false" class="text-white hover:text-neutral-300 block py-2">About</a>
            <a href="#features" @click="isOpen = false"
                class="text-white hover:text-neutral-300 block py-2">Features</a>

            @auth
                <a href="{{ route('dashboard') }}"
                    class="py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-neutral-700 bg-neutral-800 text-white shadow-sm hover:bg-neutral-700 focus:outline-hidden">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-neutral-700 bg-neutral-800 text-white shadow-sm hover:bg-neutral-700 focus:outline-hidden">
                    Get Started
                </a>
            @endauth
        </div>
    </div>
</header>
