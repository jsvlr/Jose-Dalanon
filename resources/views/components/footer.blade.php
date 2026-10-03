<footer class="mt-16 border-t border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-950">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">

        <div class="flex flex-col items-center gap-8 sm:flex-row sm:items-start sm:justify-between">

            {{-- Brand / About --}}
            <div class="flex flex-col items-center gap-3 text-center sm:items-start sm:text-left">
                <div class="flex items-center gap-2">
                    <img src="{{ Storage::url($brandLogo ?? '') }}" alt="{{ $brandName ?? 'Logo' }}" class="h-8 w-auto">
                    <span class="font-bold text-gray-900 dark:text-white">
                        {{ $brandName ?? ($name ?? '') }}
                    </span>
                </div>
                <p class="max-w-xs text-sm text-gray-500 dark:text-gray-400">
                    Building secure, scalable, and efficient web applications with clean code.
                </p>
            </div>

            {{-- Nav links --}}
            <div class="flex flex-col items-center gap-2 sm:items-start">
                <p class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">Navigate</p>
                @foreach ($links ?? [] as $route => $link)
                    <a href="{{ route($route) }}" wire:navigate
                        class="text-sm text-gray-500 transition-colors hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>

            {{-- Socials --}}
            <div class="flex flex-col items-center gap-2 sm:items-start">
                <p class="mb-1 text-sm font-semibold text-gray-900 dark:text-white">Connect</p>
                <div class="flex items-center gap-3">
                    @foreach ($accounts ?? [] as $account)
                        <a href="{{ $account['url'] }}" target="_blank" rel="noopener noreferrer"
                            title="{{ $account['name'] }}"
                            class="flex h-9 w-9 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition-colors hover:bg-gray-200 hover:text-gray-900 dark:bg-gray-800 dark:text-gray-300 dark:hover:bg-gray-700 dark:hover:text-white">
                            <img src="{{ Storage::url($account['icon']) }}" alt="{{ $account['name'] }}"
                                class="h-4 w-4 object-cover">
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div
            class="mt-8 flex flex-col items-center gap-2 border-t border-gray-200 pt-6 text-sm text-gray-500 dark:border-gray-800 dark:text-gray-400 sm:flex-row sm:justify-between">
            <p>&copy; {{ now()->year }} {{ $brandName ?? ($name ?? '') }}. All rights reserved.</p>
            <p class="flex items-center gap-1">
                Built with
                <i class="fa-solid fa-heart text-red-500"></i>
                using Laravel &amp; Tailwind CSS
            </p>
        </div>
    </div>
</footer>
