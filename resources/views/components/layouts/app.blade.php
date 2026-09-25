<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="{{ asset('js/theme.js') }}"></script>
    <link rel="shortcut icon" href="{{ Storage::url(setting('general.favicon')) }}" type="image/x-icon">
    {{-- Fontawesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">

    <title>{{ setting('general.brandName') }} | {{ $title ?? '' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="dark:text-white dark:bg-black transition-colors duration-300 ease-in-out">

    <x-navbar />

    <main class="flex-1 max-w-5xl mx-auto w-full p-6">
        {{ $slot }}
    </main>

    <x-footer />
    @livewireScripts

    @stack('scripts')
</body>

</html>
