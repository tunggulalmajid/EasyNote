<header class="sticky top-0 z-40 bg-neutral-900/90 backdrop-blur border-b border-neutral-800">
    <nav class="max-w-6xl mx-auto flex items-center justify-between px-4 py-8">
        {{-- Brand --}}
        <a href="#home" class="flex items-center gap-x-2 text-xl font-semibold focus:outline-hidden focus:opacity-80">
            <span class="inline-flex items-center gap-x-2">
                <i data-lucide="circle-check-big" class="w-8 h-8 text-white"></i>
                <span class="font-semibold tracking-wide">EasyNote</span>
            </span>
        </a>

        {{-- Right side --}}
        <div class="flex items-center gap-x-6">
            {{-- Menu desktop --}}
            <div class="hidden sm:flex items-center gap-x-6 text-sm font-medium">
                <a href="#home" class="text-white hover:text-neutral-300 focus:outline-hidden">
                    Home
                </a>
                <a href="#about" class="text-white hover:text-neutral-300 focus:outline-hidden">
                    About
                </a>
                <a href="#features" class="text-white hover:text-neutral-300 focus:outline-hidden">
                    Features
                </a>
                @auth
                    <a href="{{ route('login') }}"
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

            {{-- CTA --}}


            {{-- Burger (kalau mau nanti di-aktifkan Preline collapse) --}}
            <button type="button"
                class="sm:hidden hs-collapse-toggle relative size-9 flex justify-center items-center rounded-lg border border-neutral-700 bg-neutral-900 text-white hover:bg-neutral-800 focus:outline-hidden"
                id="hs-navbar-alignment-collapse" aria-expanded="false" aria-controls="hs-navbar-alignment"
                aria-label="Toggle navigation" data-hs-collapse="#hs-navbar-alignment">
                <svg class="hs-collapse-open:hidden size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg class="hs-collapse-open:block hidden size-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span class="sr-only">Toggle navigation</span>
            </button>
        </div>
    </nav>

    {{-- Menu mobile --}}
    <div id="hs-navbar-alignment" class="hs-collapse hidden sm:hidden border-t border-neutral-800">
        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-3 text-sm font-medium">
            <a href="#home" class="text-white hover:text-neutral-300">Home</a>
            <a href="#about" class="text-white hover:text-neutral-300">About</a>
            <a href="#features" class="text-white hover:text-neutral-300">Features</a>
            <a href="{{ route('login') }}"
                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-neutral-700 bg-neutral-800 text-white shadow-sm hover:bg-neutral-700 focus:outline-hidden">
                Get Started
            </a>
        </div>
    </div>
</header>
