@extends('layouts.auth.app')

@section('content')
    <section class="min-h-screen flex justify-center items-center px-4 py-24 bg-neutral-900 text-white">
        <div class="w-full max-w-md">

            {{-- Header --}}
            <div class="text-center mb-8 space-y-2">
                <div class="inline-flex items-center justify-center gap-2">
                    <i data-lucide="refresh-cw" class="w-10 h-10 text-emerald-500"></i>
                </div>
                <h2 class="text-2xl font-semibold tracking-wide">Reset Password</h2>
                <p class="text-neutral-400 text-sm">
                    Silakan buat password baru untuk akun Anda.
                </p>
            </div>

            {{-- Card --}}
            <div class="rounded-2xl border border-neutral-800 bg-neutral-900/60 backdrop-blur p-6 shadow-lg">

                <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    {{-- Email (Readonly) --}}
                    <div>
                        <label for="email" class="block text-sm mb-1 text-neutral-200">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                                   text-neutral-400 placeholder-neutral-500 text-sm cursor-not-allowed opacity-75"
                            required >
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Baru --}}
                    <div>
                        <label for="password" class="block text-sm mb-1 text-neutral-200">Password Baru</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                                   text-neutral-200 placeholder-neutral-500 text-sm
                                   focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="••••••••" required autocomplete="new-password" autofocus>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm mb-1 text-neutral-200">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                                   text-neutral-200 placeholder-neutral-500 text-sm
                                   focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="••••••••" required autocomplete="new-password">
                        @error('password_confirmation')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-indigo-500 hover:bg-indigo-600
                               px-5 py-2.5 rounded-lg text-sm font-medium transition-colors text-white">
                        <span>Reset Password</span>
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
