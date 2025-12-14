<footer class="border-t border-neutral-800 bg-neutral-900/80 backdrop-blur mt-20">
    <div class="max-w-6xl mx-auto px-4 py-12">
        <div class="flex flex-col md:flex-row justify-between gap-10">

            {{-- Brand --}}
            <div class="flex flex-col gap-3">
                <div class="flex items-center gap-2">
                    <i data-lucide="circle-check-big" class="w-7 h-7 text-white"></i>
                    <span class="text-xl font-semibold tracking-wide">EasyNote</span>
                </div>
                <p class="text-neutral-400 text-sm leading-relaxed max-w-sm">
                    Aplikasi catatan dan pengelolaan tugas harian untuk membuat hidupmu lebih teratur, produktif, dan
                    fokus.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h4 class="font-semibold text-white mb-3">Menu</h4>
                <ul class="space-y-2 text-neutral-400 text-sm">
                    <li><a href="#home" class="hover:text-white transition">Home</a></li>
                    <li><a href="#about" class="hover:text-white transition">About</a></li>
                    <li><a href="#features" class="hover:text-white transition">Features</a></li>
                </ul>
            </div>

            {{-- Social Media --}}
            <div>
                <h4 class="font-semibold text-white mb-3">Connect</h4>
                <div class="flex items-center gap-4">
                    <a href="https://github.com/tunggulalmajid" target="_blank"
                        class="text-neutral-400 hover:text-white transition">
                        <i data-lucide="github" class="w-5 h-5"></i>
                    </a>
                    <a href="#" class="text-neutral-400 hover:text-white transition">
                        <i data-lucide="twitter" class="w-5 h-5"></i>
                    </a>
                    <a href="https://instagram.com/t.abdlmajd_" target="_blank"
                        class="text-neutral-400 hover:text-white transition">
                        <i data-lucide="instagram" class="w-5 h-5"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Bottom --}}
        <div class="border-t border-neutral-800 mt-10 pt-6 text-center">
            <p class="text-neutral-500 text-xs">
                © {{ date('Y') }} EasyNote — By tunggulalmajid.
            </p>
        </div>
    </div>
</footer>
