@extends('layouts.auth.app')

@section('content')
    <section class="min-h-screen flex justify-center items-center px-4 py-24 bg-neutral-900 text-white">
        <div class="w-full max-w-md">

            {{-- Logo + Title --}}
            <div class="text-center mb-8 space-y-2">
                <div class="inline-flex items-center justify-center gap-2">
                    <i data-lucide="circle-check-big" class="w-10 h-10 text-white"></i>
                    <span class="text-3xl font-semibold tracking-wide">EasyNote</span>
                </div>
                <p class="text-neutral-400 text-sm">
                    Selamat datang kembali! Silakan login untuk melanjutkan.
                </p>
            </div>

            {{-- Card --}}
            <div class="rounded-2xl border border-neutral-800 bg-neutral-900/60 backdrop-blur p-6 shadow-lg">

                {{-- Jika ada error session --}}
                @if (session('status'))
                    <div class="mb-4 text-sm text-emerald-400">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm mb-1 text-neutral-200">
                            Email
                        </label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                                  text-neutral-200 placeholder-neutral-500 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="email@example.com" required autofocus>
                        @error('email')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm mb-1 text-neutral-200">
                            Password
                        </label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2 rounded-lg bg-neutral-800 border border-neutral-700
                                  text-neutral-200 placeholder-neutral-500 text-sm
                                  focus:border-indigo-500 focus:ring-indigo-500 focus:outline-none"
                            placeholder="••••••••" required>
                        @error('password')
                            <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember"
                            class="rounded border-neutral-700 bg-neutral-900 text-indigo-500
                                  focus:ring-indigo-500 focus:ring-offset-0">
                        <label for="remember" class="text-sm text-neutral-300">
                            Remember me
                        </label>
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-between">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}"
                                class="text-xs text-neutral-400 hover:text-neutral-200 underline underline-offset-4">
                                Forgot your password?
                            </a>
                        @endif

                        <button type="submit"
                            class="inline-flex items-center gap-2 bg-indigo-500 hover:bg-indigo-600
                                   px-5 py-2.5 rounded-lg text-sm font-medium">
                            <span>Log in</span>
                            <i data-lucide="log-in" class="w-4 h-4"></i>
                        </button>
                    </div>

                </form>
            </div>

            {{-- Register Link --}}
            <p class="text-center text-neutral-400 text-sm mt-6">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-neutral-200 hover:text-white underline underline-offset-4">
                    Daftar sekarang
                </a>
            </p>

        </div>
    </section>
@endsection
