@extends('layouts.auth.app')

@section('content')
    <section class="min-h-screen flex justify-center items-center px-4 py-24 bg-neutral-900 text-white">
        <div class="w-full max-w-md">

            {{-- Header --}}
            <div class="text-center mb-8 space-y-2">
                <div class="inline-flex items-center justify-center gap-2">
                    <i data-lucide="mail-check" class="w-10 h-10 text-indigo-400"></i>
                </div>
                <h2 class="text-2xl font-semibold tracking-wide">Verifikasi Email</h2>
                <p class="text-neutral-400 text-sm px-2">
                    Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi email Anda dengan mengklik tautan yang
                    baru saja kami kirimkan.
                </p>
            </div>

            {{-- Card --}}
            <div class="rounded-2xl border border-neutral-800 bg-neutral-900/60 backdrop-blur p-6 shadow-lg">

                {{-- Status Session (Jika User klik Resend) --}}
                @if (session('status') == 'verification-link-sent')
                    <div
                        class="mb-6 p-3 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-sm text-emerald-400 text-center flex flex-col items-center gap-1">
                        <i data-lucide="send" class="w-5 h-5 mb-1"></i>
                        <span>Link verifikasi baru telah dikirim ke alamat email Anda.</span>
                    </div>
                @endif

                <div class="space-y-4">
                    {{-- Form 1: Resend Email --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 bg-indigo-500 hover:bg-indigo-600
                                   px-5 py-2.5 rounded-lg text-sm font-medium transition-colors text-white">
                            <span>Kirim Ulang Verifikasi</span>
                            <i data-lucide="refresh-ccw" class="w-4 h-4"></i>
                        </button>
                    </form>

                    {{-- Form 2: Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 border border-neutral-700
                                   hover:bg-neutral-800 hover:text-white text-neutral-400
                                   px-5 py-2.5 rounded-lg text-sm font-medium transition-colors">
                            <span>Log Out</span>
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
