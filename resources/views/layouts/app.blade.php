<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-800">
    <x-banner />

    {{-- ✅ TOAST de sesión con error --}}
    @if (session('error'))
        <div id="toast" class="fixed top-5 right-5 bg-red-600 text-white px-4 py-2 rounded shadow z-50 transition-opacity duration-500 opacity-100">
            {{ session('error') }}
        </div>

        <script>
            // Añadir retraso para ocultar el toast después de 4 segundos
            setTimeout(() => {
                const toast = document.getElementById('toast');
                if (toast) {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }
            }, 4000);
        </script>
    @endif

    {{-- ✅ TOAST de sesión con éxito --}}
    @if (session('success'))
        <div id="toast-success" class="fixed top-5 right-5 bg-green-600 text-white px-4 py-2 rounded shadow z-50 transition-opacity duration-500 opacity-100">
            {{ session('success') }}
        </div>

        <script>
            // Añadir retraso para ocultar el toast de éxito después de 4 segundos
            setTimeout(() => {
                const toastSuccess = document.getElementById('toast-success');
                if (toastSuccess) {
                    toastSuccess.style.opacity = '0';
                    setTimeout(() => toastSuccess.remove(), 500);
                }
            }, 4000);
        </script>
    @endif

    <div class="min-h-screen">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    <!-- Scripts -->
    @livewireScripts
</body>
</html>
