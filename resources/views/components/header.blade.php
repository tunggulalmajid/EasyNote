@props(['title'])

<header
    class="sticky top-0 z-30 flex items-center justify-between h-16 px-6 bg-neutral-900 backdrop-blur-md border-b border-neutral-800 ">

    {{-- Left: Toggle & Title --}}
    <div class="flex items-center gap-4">
        {{-- Tombol Toggle Sidebar Mobile --}}
        <button @click="toggleSidebar()"
            class="p-2 -ml-2 rounded-lg md:hidden hover:bg-neutral-100 text-neutral-600 focus:outline-none">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>

        <h1 class="text-lg font-semibold text-white">
            {{ $title }}
        </h1>
    </div>

    {{-- Right: Actions --}}
    <div class="flex items-center gap-3 sm:gap-4">
        <div class="h-6 w-px bg-neutral-200 hidden sm:block"></div>

        {{-- Profile Dropdown --}}
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.outside="open = false"
                class="flex items-center focus:outline-none gap-2">

                <img class="w-9 h-9 rounded-full bg-neutral-200 border border-neutral-200 object-cover"
                    src="{{ Auth::user()->avatar_url }}" alt="Avatar">
                <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
            </button>

            {{-- Dropdown Menu --}}
            <div x-show="open" x-transition.origin.top.right
                class="absolute right-0 w-48 mt-2 origin-top-right bg-neutral-900 border border-neutral-100 rounded-xl shadow-sm shadow-white py-1 z-50 ring-1 ring-black ring-opacity-5"
                x-cloak>
                <div class="px-4 py-3 border-b border-neutral-100">
                    <p class="text-sm font-medium text-neutral-100">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-neutral-500 truncate">{{ Auth::user()->email }}</p>
                </div>

                <a href="{{ route('onboarding') }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm text-neutral-100 hover:bg-neutral-50/20">
                    <i data-lucide="home" class="w-4 h-4"></i> Home
                </a>

                <a href="{{ route('profile.index') }}"
                    class="flex items-center gap-2 px-4 py-2 text-sm text-neutral-100 hover:bg-neutral-50/20">
                    <i data-lucide="user" class="w-4 h-4"></i> Profile
                </a>

                <div class="border-t border-neutral-100 my-1"></div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    @method('POST')

                    <button type="submit"
                        class="flex items-center w-full gap-2 px-4 py-2 text-sm text-red-600 hover:bg-neutral-50/20">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Sign out
                    </button>
                </form>

            </div>
        </div>
    </div>
</header>
