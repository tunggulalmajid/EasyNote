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

                </form>
            </div>

            <p class="text-center text-neutral-500 text-xs mt-6">
                Dengan mendaftar, kamu menyetujui <span class="text-neutral-300">Terms & Privacy</span>.
            </p>

        </div>
    </section>
@endsection
