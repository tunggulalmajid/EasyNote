<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'EasyNote' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Memuat Asset via Vite (NPM) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-neutral-50 text-neutral-900 font-sans antialiased" x-data="{
    sidebarOpen: false,
    toggleSidebar() { this.sidebarOpen = !this.sidebarOpen }
}" {{-- Re-scan icons saat komponen dimuat --}}
    x-init="lucide.createIcons()">

    <div class="min-h-screen flex bg-neutral-50">

        {{-- Sidebar Component --}}
        <x-sidebar />

        {{-- Main Content Wrapper --}}
        <div class="flex-1 flex flex-col min-h-screen transition-all duration-300 md:ml-64">

            {{-- Navbar Component --}}
            <x-header :title="$title ?? 'Dashboard'" />

            {{-- Content --}}
            <main class="flex-1 p-4 sm:p-6 overflow-y-auto bg-neutral-900">
                {{ $slot }}
            </main>

        </div>
    </div>

    @stack('scripts')

</body>

</html>
