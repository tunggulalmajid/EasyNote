@extends('layouts.auth.app')

@section('content')
    <section class="min-h-screen flex justify-center items-center px-4 py-24 bg-neutral-900 text-white">
        <div class="w-full max-w-md">

            {{-- Header --}}
            <div class="text-center mb-8 space-y-2">
                <div class="inline-flex items-center gap-2">
                    <i data-lucide="circle-check-big" class="w-10 h-10 text-white"></i>
                    <span class="text-3xl font-semibold tracking-wide">EasyNote</span>
                </div>
                <p class="text-neutral-400 text-sm">
                    Daftar dan mulai buat hidupmu lebih teratur.
                </p>
            </div>

            {{-- Card --}}
            <div class="rounded-2xl border border-neutral-800 bg-neutral-900/60 backdrop-blur p-6 shadow-lg">

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm mb-1 text-neutral-200">Nama Lengkap</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                               text-neutral-200 placeholder-neutral-500 text-sm
                               focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="Nama kamu" required autofocus>

                        @error('name')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm mb-1 text-neutral-200">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                               text-neutral-200 placeholder-neutral-500 text-sm
                               focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="email@example.com" required>

                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm mb-1 text-neutral-200">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                               text-neutral-200 placeholder-neutral-500 text-sm
                               focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="••••••••" required>

                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm mb-1 text-neutral-200">Konfirmasi
                            Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                               text-neutral-200 placeholder-neutral-500 text-sm
                               focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="••••••••" required>

                        @error('password_confirmation')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CTA --}}
                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('login') }}"
                            class="text-xs text-neutral-400 hover:text-neutral-200 underline underline-offset-4">
                            Sudah punya akun?
                        </a>

                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600
                               px-5 py-2.5 rounded-lg text-sm font-medium">
                            <span>Register</span>
                            <i data-lucide="user-plus" class="w-4 h-4"></i>
                        </button>

                    </div>
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-neutral-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-neutral-900 text-white">Atau lanjutkan dengan</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('auth.google') }}"
                                class="flex w-full items-center justify-center gap-3 rounded-lg border border-neutral-300 bg-white px-4 py-2.5 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition-colors">
                                {{-- Logo Google SVG --}}
                                <svg class="h-5 w-5" viewBox="0 0 24 24">
                                    <path
                                        d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                        fill="#4285F4" />
                                    <path
                                        d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                        fill="#34A853" />
                                    <path
                                        d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                        fill="#FBBC05" />
                                    <path
                                        d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                        fill="#EA4335" />
                                </svg>
                                Lanjutkan dengan Google
                            </a>
                        </div>
                    </div>




                </form>

            </div>

            <p class="text-center text-neutral-500 text-xs mt-6">
                Dengan mendaftar, kamu menyetujui <span class="text-neutral-300">Terms & Privacy</span>.
            </p>

        </div>
    </section>
@endsection
