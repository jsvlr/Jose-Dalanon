<nav id="navbar" class="sticky top-0 z-50 lg:px-3 bg-white dark:bg-black shadow-2xs">
    <div class="max-w-full mx-auto flex flex-wrap items-center justify-between gap-4">

        {{-- Left: Logo, Chat, Watching --}}
        <div class="flex flex-1 items-center gap-3 min-w-0">
            <img src="{{ Storage::url($brandLogo ?? '') }}" alt="logo" class="h-10 w-auto shrink-0">
        </div>

        {{-- Center: Nav links --}}
        <div class="flex items-center justify-between gap-2 lg:gap-12 sm:gap-3 sm:px-5 ">
            @foreach ($links as $route => $link)
                <a href="{{ route($route) }}" wire:navigate
                    class="{{ request()->routeIs($route) ? 'font-bold text-gray-900 dark:text-white border-b-4 border-black dark:border-white' : 'font-light text-gray-600 dark:text-gray-300' }} flex items-center gap-1.5 px-2 py-5 text-sm transition-colors hover:text-gray-900 dark:hover:text-white sm:px-3">
                    <i class="{{ $link['icon'] }}"></i>
                    <span class="hidden sm:inline">{{ $link['label'] }}</span>
                </a>
            @endforeach
        </div>

        {{-- Right: Dark mode toggle + CV --}}
        <div class="flex flex-1 items-center justify-end gap-3">
            <a class="flex items-center gap-1.5 rounded-lg bg-gray-100 px-3 py-2 text-gray-800 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700"
                href="{{ Storage::url(setting('general.cv')) }}" target="_blank" rel="noopener"
                download="{{ setting('general.brandName', config('app.name')) }}-CV.pdf">
                <i class="fa-regular fa-file"></i>
                <small class="font-bold hidden sm:inline">Download CV</small>
            </a>
        </div>
    </div>
</nav>