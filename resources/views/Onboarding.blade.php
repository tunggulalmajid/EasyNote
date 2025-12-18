@extends('layouts.landing')

@section('content')
    {{-- Main Container dengan Alpine Data --}}
    <div x-data="{
        heroVisible: false,
        init() {
            // Efek animasi fade-in saat load
            setTimeout(() => this.heroVisible = true, 100);
        }
    }">

        {{-- HERO SECTION --}}
        <section id="home"
            class="relative min-h-screen flex flex-col items-center justify-center text-center overflow-hidden">

            {{-- Background Image dengan Overlay Gradient --}}
            <div class="absolute inset-0 z-0">
                {{-- Pastikan gambar hero.avif ada di folder public/images/ --}}
                <img src="{{ asset('images/hero.avif') }}" alt="Background" class="w-full h-full object-cover opacity-40">
                <div class="absolute inset-0 bg-gradient-to-b from-neutral-900/80 via-neutral-900/50 to-neutral-900"></div>
            </div>

            <div class="relative z-10 max-w-4xl mx-auto px-6 flex flex-col gap-8">
                {{-- Animated Content Wrapper --}}
                <div x-show="heroVisible" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 translate-y-10 scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 scale-100" class="flex flex-col items-center gap-6">

                    {{-- Badge Pill --}}
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-medium tracking-wide uppercase backdrop-blur-sm">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        New: Rich Text Editor & Dashboard
                    </div>

                    <h1 class="text-5xl sm:text-7xl md:text-8xl font-bold tracking-tight text-white leading-tight">
                        Catat Ide. <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">
                            Atur Hidup.
                        </span>
                    </h1>

                    <p class="text-neutral-300 text-lg sm:text-xl max-w-2xl mx-auto leading-relaxed">
                        EasyNote bukan sekadar to-do list. Ini adalah ruang kerjamu untuk mengatur tugas,
                        menulis ide cemerlang, dan memantau produktivitas harian dalam satu tempat.
                    </p>

                    <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                        <a href="{{ route('login') }}"
                            class="group relative py-3.5 px-8 inline-flex items-center gap-x-2 text-base font-bold rounded-full bg-white text-neutral-900 hover:bg-neutral-100 hover:scale-105 transition-all duration-300 focus:outline-none shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)]">
                            Mulai Sekarang
                            <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                        </a>

                        <a href="#features"
                            class="py-3.5 px-8 inline-flex items-center gap-x-2 text-base font-medium rounded-full border border-neutral-700 bg-neutral-800/50 text-neutral-200 hover:bg-neutral-800 hover:text-white backdrop-blur-md transition-all duration-300 focus:outline-none">
                            Pelajari Fitur
                        </a>
                    </div>
                </div>
            </div>

            {{-- Scroll Down Indicator --}}
            <div class="absolute bottom-10 animate-bounce text-neutral-500">
                <i data-lucide="chevrons-down" class="w-6 h-6"></i>
            </div>
        </section>

        {{-- ABOUT: Problem & Solution (Modern Cards) --}}
        <section id="about" class="py-32 px-4 bg-neutral-900 relative">
            <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-neutral-700 to-transparent">
            </div>

            <div class="max-w-6xl mx-auto grid lg:grid-cols-2 gap-16 items-center">
                {{-- Left: Intro --}}
                <div class="space-y-6" data-aos="fade-right">
                    <div class="inline-block p-3 rounded-2xl bg-indigo-500/10 border border-indigo-500/20">
                        <i data-lucide="layers" class="w-8 h-8 text-indigo-400"></i>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-bold text-white leading-tight">
                        Lupakan catatan yang <br>
                        <span class="text-neutral-500">berantakan.</span>
                    </h2>
                    <p class="text-neutral-400 text-lg leading-relaxed">
                        Sering lupa deadline? Ide hilang karena tidak dicatat? Atau merasa kewalahan dengan tumpukan tugas?
                        <br><br>
                        EasyNote hadir untuk menyederhanakan itu semua. Kami menggabungkan manajemen tugas dan catatan dalam
                        antarmuka yang bersih dan fokus.
                    </p>

                    {{-- Stats Mini --}}
                    <div class="grid grid-cols-2 gap-6 pt-4">
                        <div>
                            <h4 class="text-3xl font-bold text-white">100%</h4>
                            <p class="text-sm text-neutral-500">Gratis Digunakan</p>
                        </div>
                        <div>
                            <h4 class="text-3xl font-bold text-white">24/7</h4>
                            <p class="text-sm text-neutral-500">Akses Kapan Saja</p>
                        </div>
                    </div>
                </div>

                {{-- Right: Problem & Solution Cards --}}
                <div class="grid gap-6" data-aos="fade-left">
                    {{-- Problem Card --}}
                    <div
                        class="group p-6 rounded-3xl bg-neutral-800/50 border border-neutral-800 hover:border-red-500/30 hover:bg-neutral-800 transition-all duration-300">
                        <div class="flex items-start gap-4">
                            <div
                                class="shrink-0 p-3 rounded-2xl bg-red-500/10 text-red-400 group-hover:scale-110 transition-transform duration-300">
                                <i data-lucide="x-circle" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2">Masalah Lama</h3>
                                <p class="text-neutral-400">
                                    Menggunakan banyak aplikasi: satu untuk to-do list, satu untuk catatan, satu untuk
                                    kalender. Ribet dan bikin pusing.
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Solution Card --}}
                    <div
                        class="group p-6 rounded-3xl bg-gradient-to-br from-neutral-800/80 to-neutral-800/40 border border-neutral-700 hover:border-emerald-500/50 transition-all duration-300 relative overflow-hidden">
                        <div
                            class="absolute inset-0 bg-emerald-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>
                        <div class="flex items-start gap-4 relative z-10">
                            <div
                                class="shrink-0 p-3 rounded-2xl bg-emerald-500/10 text-emerald-400 group-hover:scale-110 transition-transform duration-300">
                                <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-white mb-2">Solusi EasyNote</h3>
                                <p class="text-neutral-300">
                                    All-in-one productivity. Buat tugas dengan deadline, tulis catatan panjang dengan editor
                                    teks lengkap, dan pantau progres di dashboard.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FEATURES SECTION (Alpine Data) --}}
        <section id="features" class="py-32 px-4 bg-neutral-950 relative overflow-hidden" x-data="{
            features: [{
                    title: 'Manajemen Tugas Cerdas',
                    desc: 'Buat tugas, atur deadline, dan beri kategori prioritas. Tandai selesai dengan sekali klik.',
                    icon: 'check-square',
                    color: 'indigo'
                },
                {
                    title: 'Rich Text Editor',
                    desc: 'Tulis catatan harian, ide blog, atau jurnal dengan editor teks lengkap (Bold, Italic, List, dll).',
                    icon: 'pen-tool',
                    color: 'pink'
                },
                {
                    title: 'Dashboard Statistik',
                    desc: 'Pantau produktivitasmu dengan ringkasan visual: jumlah tugas pending, selesai, dan total catatan.',
                    icon: 'bar-chart-2',
                    color: 'emerald'
                },
                {
                    title: 'Kategori & Filter',
                    desc: 'Kelompokkan tugas dan catatanmu agar lebih rapi dan mudah ditemukan saat dibutuhkan.',
                    icon: 'tags',
                    color: 'amber'
                },
                {
                    title: 'Mode Gelap (Dark Mode)',
                    desc: 'Antarmuka gelap yang nyaman di mata, cocok untuk fokus bekerja di malam hari.',
                    icon: 'moon',
                    color: 'violet'
                },
                {
                    title: 'Respon Cepat (AJAX)',
                    desc: 'Pengalaman pengguna yang mulus tanpa reload halaman saat menambah atau menghapus data.',
                    icon: 'zap',
                    color: 'cyan'
                }
            ],
            getColorClasses(color) {
                const maps = {
                    'indigo': { bg: 'bg-indigo-500/10', text: 'text-indigo-400', border: 'border-indigo-500/20' },
                    'pink': { bg: 'bg-pink-500/10', text: 'text-pink-400', border: 'border-pink-500/20' },
                    'emerald': { bg: 'bg-emerald-500/10', text: 'text-emerald-400', border: 'border-emerald-500/20' },
                    'amber': { bg: 'bg-amber-500/10', text: 'text-amber-400', border: 'border-amber-500/20' },
                    'violet': { bg: 'bg-violet-500/10', text: 'text-violet-400', border: 'border-violet-500/20' },
                    'cyan': { bg: 'bg-cyan-500/10', text: 'text-cyan-400', border: 'border-cyan-500/20' },
                };
                return maps[color];
            },
            init() {
                // Re-scan icons after Alpine renders the loop
                this.$nextTick(() => {
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                });
            }
        }">
            {{-- Background Glow --}}
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-[128px] pointer-events-none">
            </div>
            <div
                class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-cyan-600/10 rounded-full blur-[128px] pointer-events-none">
            </div>

            <div class="max-w-7xl mx-auto relative z-10">
                {{-- Header --}}
                <div class="text-center max-w-3xl mx-auto mb-20" data-aos="fade-up">
                    <span
                        class="px-4 py-1.5 rounded-full border border-neutral-800 bg-neutral-900 text-sm font-medium text-neutral-400 mb-6 inline-block">
                        Mengapa EasyNote?
                    </span>
                    <h2 class="text-4xl sm:text-5xl font-bold text-white mb-6">
                        Semua alat produktivitas <br>
                        dalam <span class="text-indigo-400">satu aplikasi.</span>
                    </h2>
                    <p class="text-neutral-400 text-lg">
                        Kami merancang setiap fitur agar intuitif dan tidak membingungkan.
                        Fokus pada apa yang harus kamu kerjakan, bukan cara menggunakan aplikasinya.
                    </p>
                </div>

                {{-- Grid Features --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <template x-for="(feature, index) in features" :key="index">
                        <div class="group p-8 rounded-3xl bg-neutral-900 border border-neutral-800 hover:border-neutral-700 hover:bg-neutral-800/80 transition-all duration-300"
                            data-aos="fade-up" :data-aos-delay="index * 100">

                            {{-- Icon Box --}}
                            <div
                                :class="`w-14 h-14 rounded-2xl flex items-center justify-center mb-6 transition-transform duration-300 group-hover:scale-110 border ${getColorClasses(feature.color).bg} ${getColorClasses(feature.color).border}`">
                                <i :data-lucide="feature.icon"
                                    :class="`w-7 h-7 ${getColorClasses(feature.color).text}`"></i>
                            </div>

                            <h3 class="text-xl font-bold text-white mb-3" x-text="feature.title"></h3>
                            <p class="text-neutral-400 leading-relaxed" x-text="feature.desc"></p>
                        </div>
                    </template>
                </div>
            </div>
        </section>

        {{-- CTA SECTION --}}
        <section class="py-32 px-4 bg-neutral-900 text-center relative overflow-hidden">
            <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>

            <div class="max-w-4xl mx-auto relative z-10" data-aos="zoom-in">
                <h2 class="text-4xl sm:text-6xl font-bold text-white mb-8 tracking-tight">
                    Siap mengatur hidupmu?
                </h2>
                <p class="text-xl text-neutral-400 mb-10 max-w-2xl mx-auto">
                    Bergabung sekarang dan rasakan kemudahan mengelola tugas dan catatan harianmu. Gratis selamanya.
                </p>

                <a href="{{ route('register') }}"
                    class="inline-flex items-center gap-2 py-4 px-10 rounded-full bg-white text-neutral-900 font-bold text-lg hover:scale-105 hover:shadow-[0_0_40px_rgba(255,255,255,0.3)] transition-all duration-300">
                    Daftar Gratis
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </section>

    </div>
@endsection
