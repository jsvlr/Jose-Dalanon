{{-- resources/views/components/navbar.blade.php --}}
<nav id="navbar" class="sticky top-0 z-50 lg:px-3 bg-white dark:bg-black shadow-2xs">
    <div class="max-w-full mx-auto flex flex-wrap items-center justify-between gap-4">

        {{-- Left: Logo, Chat, Watching --}}
        <div class="flex flex-1 items-center gap-3 min-w-0">
            <img src="{{ Storage::url(setting('general.brandLogo')) }}" alt="logo" class="h-10 w-auto shrink-0">

            <button type="button"
                class="flex items-center gap-2 cursor-pointer rounded-2xl px-3 py-2.5 text-gray-700 transition-colors hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-800">
                <i class="fa-regular fa-comments"></i>
                <small class="hidden sm:inline">Chat</small>
            </button>

            <div class="hidden md:block whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                <span>30+ watching</span> {{-- This should not be hard coded, will change soon.. :) --}}
            </div>
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
            <div x-data="{ dark: localStorage.theme === 'dark' }">
                <button type="button"
                    @click="
                        dark = !dark;
                        localStorage.theme = dark ? 'dark' : 'light';
                        document.documentElement.classList.toggle('dark', dark);
                    "
                    class="cursor-pointer rounded-full bg-gray-200 p-2.5 text-gray-900 transition-colors hover:bg-gray-300 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700"
                    aria-label="Toggle dark mode">
                    <span x-show="!dark"><i class="fa-regular fa-moon"></i></span>
                    <span x-show="dark" x-cloak><i class="fa-regular fa-sun"></i></span>
                </button>
            </div>

            <a class="flex items-center gap-1.5 rounded-lg bg-gray-100 px-3 py-2 text-gray-800 transition-colors hover:bg-gray-200 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700"
                href="https://drive.google.com/file/d/1-jQgmg8yi3hWQbVAYwSDRliNIAFCGJc9/view?usp=sharing"
                target="_blank" rel="noopener noreferrer" download>
                <i class="fa-regular fa-file"></i>
                <small class="font-bold hidden sm:inline">Download CV</small>
            </a>
        </div>
    </div>
</nav>
