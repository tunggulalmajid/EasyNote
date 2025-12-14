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

        {{-- HERO --}}
        <section id="home" class="min-h-screen flex flex-col items-center justify-center text-center bg-cover"
            style="background-image: url('{{ asset('images/hero.avif') }}');">

            <div class="max-w-3xl mx-auto flex flex-col gap-10 px-4">
                {{-- Animated Content Wrapper --}}
                <div x-show="heroVisible" x-transition:enter="transition ease-out duration-1000"
                    x-transition:enter-start="opacity-0 translate-y-10" x-transition:enter-end="opacity-100 translate-y-0"
                    class="flex flex-col gap-10">

                    <p class="text-sm tracking-[0.3em] uppercase text-neutral-400">
                        Simple • Fast • Organized
                    </p>

                    <h1 class="text-4xl sm:text-6xl md:text-8xl font-bold tracking-tight text-white">
                        EasyNote
                    </h1>

                    <p class="text-neutral-300 text-sm sm:text-base max-w-xl mx-auto">
                        Buat harimu lebih terarah dengan EasyNote – aplikasi todolist sederhana
                        untuk mencatat, mengatur, dan menyelesaikan semua aktivitas harianmu.
                    </p>

                    <div class="flex flex-wrap items-center justify-center gap-4 pt-2">
                        <a href="{{ route('login') }}"
                            class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg
                                  border border-white bg-white text-neutral-900
                                  hover:bg-neutral-100 hover:scale-105 transition-transform duration-200 focus:outline-hidden">
                            Get Started
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </a>

                        <a href="#features"
                            class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg
                                  border border-neutral-700 text-neutral-200
                                  hover:border-neutral-500 hover:text-white transition-colors duration-200 focus:outline-hidden">
                            Lihat Fitur
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- ABOUT: Problem & Solution --}}
        <section id="about" class="py-52 px-4 border-t border-neutral-800 bg-neutral-900">
            <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-start">
                {{-- Left: Intro --}}
                <div class="space-y-4" data-aos="fade-right">
                    <p class="text-sm font-medium text-indigo-400 uppercase tracking-[0.25em]">
                        About EasyNote
                    </p>
                    <h2 class="text-3xl sm:text-4xl font-semibold text-white">
                        Fokus ke hal penting, serahkan catatan pada EasyNote.
                    </h2>
                    <p class="text-neutral-300 text-sm sm:text-base">
                        EasyNote dibuat untuk kamu yang sering kewalahan dengan tugas, catatan,
                        dan rencana harian. Satu tempat untuk semua aktivitas – dari to-do kecil
                        sampai project besar.
                    </p>
                </div>

                {{-- Right: Problem & Solution --}}
                <div class="space-y-6" data-aos="fade-left">
                    {{-- Problem Card --}}
                    <div
                        class="rounded-2xl border border-neutral-800 bg-neutral-900/70 p-5 flex gap-4 hover:border-red-500/30 transition-colors duration-300">
                        <div
                            class="shrink-0 rounded-xl bg-red-500/10 border border-red-500/40 size-11 flex items-center justify-center">
                            <i data-lucide="alert-triangle" class="w-5 h-5 text-red-400"></i>
                        </div>
                        <div class="space-y-1">
                            <h3 class="font-semibold text-lg text-white">Problem</h3>
                            <p class="text-sm text-neutral-300 leading-relaxed">
                                Catatan tersebar di mana-mana: chat, kertas, notes HP.
                                Akhirnya banyak tugas yang lupa, deadline terlewat.
                            </p>
                        </div>
                    </div>

                    {{-- Solution Card --}}
                    <div
                        class="rounded-2xl border border-neutral-800 bg-neutral-900/70 p-5 flex gap-4 hover:border-emerald-500/30 transition-colors duration-300">
                        <div
                            class="shrink-0 rounded-xl bg-emerald-500/10 border border-emerald-500/40 size-11 flex items-center justify-center">
                            <i data-lucide="sparkles" class="w-5 h-5 text-emerald-400"></i>
                        </div>
                        <div class="space-y-1">
                            <h3 class="font-semibold text-lg text-white">Solution</h3>
                            <p class="text-sm text-neutral-300 leading-relaxed">
                                EasyNote mengumpulkan semua tugasmu di satu tempat,
                                dengan tampilan sederhana dan kategori yang jelas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FEATURES (Menggunakan x-data & Loop) --}}
        <section id="features" class="py-52 px-4 border-t border-neutral-800 bg-neutral-950" x-data="{
            features: [{
                    title: 'Smart Todo List',
                    desc: 'Tambahkan, edit, dan centang tugas dengan cepat. Kelompokkan tugas berdasarkan kategori atau prioritas.',
                    icon: 'list-todo',
                    color: 'indigo'
                },
                {
                    title: 'Progress Dashboard',
                    desc: 'Lihat statistik penyelesaian tugas harian dan mingguan dengan grafik yang jelas dan mudah dibaca.',
                    icon: 'bar-chart-3',
                    color: 'emerald'
                },
                {
                    title: 'Reminder & Deadline',
                    desc: 'Atur deadline dan pengingat sehingga kamu tidak lagi melewatkan tugas penting atau jadwal penting.',
                    icon: 'bell',
                    color: 'amber'
                }
            ],
            // Fungsi helper untuk class warna dynamic
            getBgClass(color) {
                const maps = {
                    'indigo': 'bg-indigo-500/10 border-indigo-500/40',
                    'emerald': 'bg-emerald-500/10 border-emerald-500/40',
                    'amber': 'bg-amber-500/10 border-amber-500/40'
                };
                return maps[color];
            },
            getTextClass(color) {
                const maps = {
                    'indigo': 'text-indigo-400',
                    'emerald': 'text-emerald-400',
                    'amber': 'text-amber-400'
                };
                return maps[color];
            },
            init() {
                // Re-scan icon saat komponen dimuat karena kita merender icon secara dinamis
                this.$nextTick(() => {
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons();
                    }
                });
            }
        }">

            <div class="max-w-6xl mx-auto">
                <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
                    <p class="text-sm font-medium text-indigo-400 uppercase tracking-[0.25em]">
                        Features
                    </p>
                    <h2 class="text-3xl sm:text-4xl font-semibold mt-3 text-white">
                        Fitur utama EasyNote
                    </h2>
                    <p class="text-neutral-300 text-sm sm:text-base mt-3">
                        Dibuat sederhana tapi tetap powerful, agar kamu bisa langsung produktif.
                    </p>
                </div>

                <div class="grid gap-6 md:grid-cols-3">
                    {{-- Alpine Loop untuk Features --}}
                    <template x-for="(feature, index) in features" :key="index">
                        <div class="rounded-2xl border border-neutral-800 bg-neutral-900/70 p-6 flex flex-col gap-3 hover:bg-neutral-900 transition duration-300 group"
                            data-aos="fade-up" :data-aos-delay="index * 100">

                            {{-- Dynamic Icon Container --}}
                            <div
                                :class="`rounded-xl border size-10 flex items-center justify-center ${getBgClass(feature.color)}`">
                                {{-- Render icon menggunakan i tag, Alpine akan mengisi atributnya --}}
                                <i :data-lucide="feature.icon" :class="`w-5 h-5 ${getTextClass(feature.color)}`"></i>
                            </div>

                            <h3 class="font-semibold text-lg text-white" x-text="feature.title"></h3>
                            <p class="text-sm text-neutral-300" x-text="feature.desc"></p>
                        </div>
                    </template>
                </div>
            </div>
        </section>
    </div>
@endsection
