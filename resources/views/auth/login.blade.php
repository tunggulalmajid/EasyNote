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
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-neutral-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-neutral-900 text-white">Atau masuk dengan</span>
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
