<div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" class="fixed inset-0 bg-neutral-900/80 z-40 md:hidden" x-cloak>
</div>

<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-neutral-900 text-white transition-transform duration-300 ease-in-out md:translate-x-0 border-r border-neutral-800 flex flex-col">

    {{-- Header Logo --}}
    <div class="flex items-center justify-between h-16 px-6 border-b border-neutral-800 shrink-0">
        <div class="flex items-center gap-2 font-bold text-xl tracking-tight">
            <span class="inline-flex items-center gap-x-2">
                <i data-lucide="circle-check-big" class="w-8 h-8 text-white"></i>
                <span class="font-semibold tracking-wide">EasyNote</span>
            </span>
        </div>
        <button @click="sidebarOpen = false" class="md:hidden text-neutral-400 hover:text-white">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>
    </div>

    {{-- Menu Items --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        @php
            $navItems = [['name' => 'Dashboard', 'url' => 'dashboard', 'icon' => 'layout-dashboard']];
        @endphp

        @foreach ($navItems as $item)
            <a href="{{ route($item['url']) }}"
                class="flex items-center gap-3 px-3 py-2.5 text-sm font-medium rounded-lg transition-colors group
               {{ request()->is($item['url'] . '*')
                   ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-900/20'
                   : 'text-neutral-400 hover:bg-neutral-800 hover:text-white' }}">
                <i data-lucide="{{ $item['icon'] }}"
                    class="w-5 h-5 {{ request()->is($item['url'] . '*') ? 'text-white' : 'text-neutral-400 group-hover:text-white' }}"></i>
                {{ $item['name'] }}
            </a>
        @endforeach

        <div class="pt-4 mt-4 border-t border-neutral-800">
            <p class="px-3 text-xs font-semibold text-neutral-500 uppercase tracking-wider mb-2">Projects</p>
            <a href="#"
                class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-neutral-400 hover:bg-neutral-800 hover:text-white">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                Website Redesign
            </a>
            <a href="#"
                class="flex items-center gap-3 px-3 py-2 text-sm font-medium rounded-lg text-neutral-400 hover:bg-neutral-800 hover:text-white">
                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                Marketing Campaign
            </a>
        </div>
    </nav>
</aside>
