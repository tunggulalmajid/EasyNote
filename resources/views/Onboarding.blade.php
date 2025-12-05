@extends('layouts.landing')

@section('content')
    {{-- HERO --}}
    <section id="home" class="min-h-screen flex flex-col items-center justify-center text-center" data-aos="fade-up">
        <div class="max-w-3xl mx-auto flex flex-col gap-10">
            <p class="text-sm tracking-[0.3em] uppercase text-neutral-400">
                Simple • Fast • Organized
            </p>

            <h1 class="text-4xl sm:text-6xl md:text-8xl font-bold tracking-tight">
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
                          hover:bg-neutral-100 focus:outline-hidden">
                    Get Started
                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>

                <a href="#features"
                    class="py-3 px-6 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg
                          border border-neutral-700 text-neutral-200
                          hover:border-neutral-500 hover:text-white focus:outline-hidden">
                    Lihat Fitur
                </a>
            </div>
        </div>
    </section>

    {{-- ABOUT: Problem & Solution --}}
    <section id="about" class="py-52 px-4 border-t border-neutral-800 bg-neutral-900" data-aos="fade-up">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-start">
            {{-- Left: Intro --}}
            <div class="space-y-4">
                <p class="text-sm font-medium text-indigo-400 uppercase tracking-[0.25em]">
                    About EasyNote
                </p>
                <h2 class="text-3xl sm:text-4xl font-semibold">
                    Fokus ke hal penting, serahkan catatan pada EasyNote.
                </h2>
                <p class="text-neutral-300 text-sm sm:text-base">
                    EasyNote dibuat untuk kamu yang sering kewalahan dengan tugas, catatan,
                    dan rencana harian. Satu tempat untuk semua aktivitas – dari to-do kecil
                    sampai project besar.
                </p>
            </div>

            {{-- Right: Problem & Solution --}}
            <div class="space-y-6">
                {{-- Problem --}}
                <div class="rounded-2xl border border-neutral-800 bg-neutral-900/70 p-5 flex gap-4">
                    <div
                        class="shrink-0 rounded-xl bg-red-500/10 border border-red-500/40 size-11 flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-5 h-5 text-red-400"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-semibold text-lg">Problem</h3>
                        <p class="text-sm text-neutral-300 leading-relaxed">
                            Catatan tersebar di mana-mana: chat, kertas, notes HP.
                            Akhirnya banyak tugas yang lupa, deadline terlewat,
                            dan susah melihat prioritas harian.
                        </p>
                    </div>
                </div>

                {{-- Solution --}}
                <div class="rounded-2xl border border-neutral-800 bg-neutral-900/70 p-5 flex gap-4">
                    <div
                        class="shrink-0 rounded-xl bg-emerald-500/10 border border-emerald-500/40 size-11 flex items-center justify-center">
                        <i data-lucide="sparkles" class="w-5 h-5 text-emerald-400"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 class="font-semibold text-lg">Solution</h3>
                        <p class="text-sm text-neutral-300 leading-relaxed">
                            EasyNote mengumpulkan semua tugasmu di satu tempat,
                            dengan tampilan sederhana, kategori yang jelas,
                            dan indikator progress yang membantu kamu tetap on-track setiap hari.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FEATURES --}}
    <section id="features" class="py-52 px-4 border-t border-neutral-800 bg-neutral-950" data-aos="fade-up">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <p class="text-sm font-medium text-indigo-400 uppercase tracking-[0.25em]">
                    Features
                </p>
                <h2 class="text-3xl sm:text-4xl font-semibold mt-3">
                    Fitur utama EasyNote
                </h2>
                <p class="text-neutral-300 text-sm sm:text-base mt-3">
                    Dibuat sederhana tapi tetap powerful, agar kamu bisa langsung produktif tanpa pusing belajar tool baru.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                {{-- Feature 1 --}}
                <div class="rounded-2xl border border-neutral-800 bg-neutral-900/70 p-6 flex flex-col gap-3">
                    <div
                        class="rounded-xl bg-indigo-500/10 border border-indigo-500/40 size-10 flex items-center justify-center">
                        <i data-lucide="list-todo" class="w-5 h-5 text-indigo-400"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Smart Todo List</h3>
                    <p class="text-sm text-neutral-300">
                        Tambahkan, edit, dan centang tugas dengan cepat. Kelompokkan tugas berdasarkan kategori atau
                        prioritas.
                    </p>
                </div>

                {{-- Feature 2 --}}
                <div class="rounded-2xl border border-neutral-800 bg-neutral-900/70 p-6 flex flex-col gap-3">
                    <div
                        class="rounded-xl bg-emerald-500/10 border border-emerald-500/40 size-10 flex items-center justify-center">
                        <i data-lucide="bar-chart-3" class="w-5 h-5 text-emerald-400"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Progress Dashboard</h3>
                    <p class="text-sm text-neutral-300">
                        Lihat statistik penyelesaian tugas harian dan mingguan dengan grafik yang jelas dan mudah dibaca.
                    </p>
                </div>

                {{-- Feature 3 --}}
                <div class="rounded-2xl border border-neutral-800 bg-neutral-900/70 p-6 flex flex-col gap-3">
                    <div
                        class="rounded-xl bg-amber-500/10 border border-amber-500/40 size-10 flex items-center justify-center">
                        <i data-lucide="bell" class="w-5 h-5 text-amber-400"></i>
                    </div>
                    <h3 class="font-semibold text-lg">Reminder & Deadline</h3>
                    <p class="text-sm text-neutral-300">
                        Atur deadline dan pengingat sehingga kamu tidak lagi melewatkan tugas penting atau jadwal penting.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
