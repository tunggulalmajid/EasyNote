@extends('layouts.auth.app')

@section('content')
    <section class="min-h-screen flex justify-center items-center px-4 py-24 bg-neutral-900 text-white">
        <div class="w-full max-w-md">

            {{-- Header --}}
            <div class="text-center mb-8 space-y-2">
                <div class="inline-flex items-center justify-center gap-2">
                    <i data-lucide="key-round" class="w-10 h-10 text-amber-500"></i>
                </div>
                <h2 class="text-2xl font-semibold tracking-wide">Lupa Password?</h2>
                <p class="text-neutral-400 text-sm px-2">
                    Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mereset password.
                </p>
            </div>

            {{-- Card --}}
            <div class="rounded-2xl border border-neutral-800 bg-neutral-900/60 backdrop-blur p-6 shadow-lg">

                {{-- Session Status (Success Message) --}}
                @if (session('status'))
                    <div
                        class="mb-5 p-3 rounded-lg bg-emerald-500/10 border border-emerald-500/20 text-sm text-emerald-400 flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm mb-1 text-neutral-200">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                                   text-neutral-200 placeholder-neutral-500 text-sm
                                   focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="email@example.com" required autofocus>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-indigo-500 hover:bg-indigo-600
                               px-5 py-2.5 rounded-lg text-sm font-medium transition-colors text-white">
                        <span>Kirim Link Reset</span>
                        <i data-lucide="send" class="w-4 h-4"></i>
                    </button>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-sm text-neutral-400 hover:text-white transition-colors">
                            &larr; Kembali ke Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
