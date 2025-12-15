@extends('layouts.auth.app')

@section('content')
    <section class="min-h-screen flex justify-center items-center px-4 py-24 bg-neutral-900 text-white">
        <div class="w-full max-w-md">

            {{-- Header --}}
            <div class="text-center mb-8 space-y-2">
                <div class="inline-flex items-center justify-center gap-2">
                    <i data-lucide="shield-alert" class="w-10 h-10 text-indigo-500"></i>
                </div>
                <h2 class="text-2xl font-semibold tracking-wide">Konfirmasi Akses</h2>
                <p class="text-neutral-400 text-sm">
                    Ini adalah area aman. Harap masukkan password Anda untuk melanjutkan.
                </p>
            </div>

            {{-- Card --}}
            <div class="rounded-2xl border border-neutral-800 bg-neutral-900/60 backdrop-blur p-6 shadow-lg">

                <form method="POST" action="{{ route('password.confirm') }}" class="space-y-5">
                    @csrf

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm mb-1 text-neutral-200">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                                   text-neutral-200 placeholder-neutral-500 text-sm
                                   focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="••••••••" required autocomplete="current-password" autofocus>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-indigo-500 hover:bg-indigo-600
                               px-5 py-2.5 rounded-lg text-sm font-medium transition-colors text-white">
                        <span>Konfirmasi</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </form>

            </div>
        </div>
    </section>
@endsection
