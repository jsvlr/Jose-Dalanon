<article class="mx-auto max-w-6xl px-4 py-10 sm:px-6 sm:py-16 lg:px-8">
    <section aria-labelledby="about-title"
        class="grid items-center gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(280px,0.8fr)] lg:gap-20">
        <div>
            <p
                class="inline-flex items-center gap-2 rounded-full border border-gray-200 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:border-gray-800 dark:text-gray-400">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                A little about me
            </p>

            <h1 id="about-title"
                class="mt-6 text-4xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-5xl lg:text-6xl">
                Hey, I’m <span
                    class="decoration-gray-300 underline decoration-4 underline-offset-8 dark:decoration-gray-700">{{ $brandName ?? config('app.name') }}</span>.
            </h1>

            <p class="mt-6 text-xl font-medium leading-8 text-gray-700 dark:text-gray-300">
                A backend developer focused on building useful, dependable web experiences.
            </p>

            @if (!empty($tagline))
                <p class="mt-4 max-w-2xl text-base leading-7 text-gray-600 dark:text-gray-400">
                    {{ $tagline }}
                </p>
            @endif

            <p class="mt-4 max-w-2xl text-base leading-7 text-gray-600 dark:text-gray-400">
                I enjoy turning ideas into thoughtful products—from the structure behind the scenes to the details
                people interact with every day. My work is centered around Laravel, Livewire, and Filament.
            </p>

            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ route('projects.index') }}" wire:navigate
                    class="inline-flex items-center gap-2 rounded-full bg-gray-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200 dark:focus:ring-offset-black">
                    Explore my work
                    <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                </a>
                <a href="{{ route('stack.index') }}" wire:navigate
                    class="inline-flex items-center gap-2 rounded-full border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:text-gray-950 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:border-gray-800 dark:text-gray-200 dark:hover:border-gray-600 dark:hover:text-white">
                    My toolkit
                    <i class="fa-solid fa-layer-group text-xs" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <div class="relative mx-auto w-full max-w-md">
            <div class="absolute -inset-4 rotate-3 rounded-[2rem] border border-gray-200 dark:border-gray-800"
                aria-hidden="true"></div>
            <div class="relative overflow-hidden rounded-[1.75rem] bg-gray-100 dark:bg-gray-900">
                @if (!empty($brandLogo))
                    <img src="{{ Storage::url($brandLogo) }}" alt="{{ $brandName ?? config('app.name') }} brand mark"
                        class="aspect-[4/5] w-full object-cover">
                @else
                    <div
                        class="flex aspect-[4/5] flex-col items-center justify-center gap-5 bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300 p-8 text-center dark:from-gray-800 dark:via-gray-900 dark:to-black">
                        <span
                            class="flex h-24 w-24 items-center justify-center rounded-3xl bg-white text-3xl font-bold text-gray-900 shadow-lg dark:bg-gray-800 dark:text-white">
                            {{ \Illuminate\Support\Str::of($brandName ?? config('app.name'))->substr(0, 1)->upper() }}
                        </span>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ $brandName ?? config('app.name') }}</p>
                    </div>
                @endif
                <div
                    class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-black/70 to-transparent p-6 pt-20 sm:p-8 sm:pt-24">
                    <p class="text-sm font-medium text-white/75">Thoughtful code. Useful products.</p>
                    <p class="mt-1 text-xl font-semibold text-white">{{ $brandName ?? config('app.name') }}</p>
                </div>
            </div>
            <div
                class="absolute -bottom-30 -left-3 flex items-center gap-3 rounded-2xl border border-gray-200 bg-white p-3 shadow-lg dark:border-gray-800 dark:bg-gray-950 sm:-left-8 sm:p-4">
                <span
                    class="flex h-10 w-10 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-100">
                    <i class="fa-solid fa-code" aria-hidden="true"></i>
                </span>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">Main focus</p>
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Backend development</p>
                </div>
            </div>
        </div>
    </section>

    <section aria-labelledby="approach-title" class="mt-24 sm:mt-32">
        <div class="max-w-2xl">
            <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">How I work</p>
            <h2 id="approach-title"
                class="mt-3 text-3xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-4xl">
                Good software is more than code.
            </h2>
            <p class="mt-4 leading-7 text-gray-600 dark:text-gray-400">
                I care about building things that are clear to use, dependable in practice, and easier to improve over
                time.
            </p>
        </div>

        <div class="mt-8 grid gap-4 md:grid-cols-3">
            <div class="rounded-2xl border border-gray-200 p-6 dark:border-gray-800 sm:p-7">
                <span
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                    <i class="fa-solid fa-compass" aria-hidden="true"></i>
                </span>
                <h3 class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">Start with the problem</h3>
                <p class="mt-2 text-sm leading-6 text-gray-600 dark:text-gray-400">
                    Understand what people need before deciding how the solution should work.
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 p-6 dark:border-gray-800 sm:p-7">
                <span
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                    <i class="fa-solid fa-cubes-stacked" aria-hidden="true"></i>
                </span>
                <h3 class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">Build with intention</h3>
                <p class="mt-2 text-sm leading-6 text-gray-600 dark:text-gray-400">
                    Choose practical patterns that keep applications organized and maintainable.
                </p>
            </div>

            <div class="rounded-2xl border border-gray-200 p-6 dark:border-gray-800 sm:p-7">
                <span
                    class="flex h-11 w-11 items-center justify-center rounded-xl bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
                    <i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>
                </span>
                <h3 class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">Sweat the details</h3>
                <p class="mt-2 text-sm leading-6 text-gray-600 dark:text-gray-400">
                    Give the experience the same care as the systems that power it.
                </p>
            </div>
        </div>
    </section>

    <section aria-labelledby="connect-title"
        class="mt-16 overflow-hidden rounded-3xl bg-gray-950 px-6 py-10 text-white dark:bg-gray-900 sm:mt-20 sm:px-10 sm:py-12">
        <div class="flex flex-col gap-8 sm:flex-row sm:items-center sm:justify-between">
            <div class="max-w-xl">
                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-gray-400">Let’s connect</p>
                <h2 id="connect-title" class="mt-3 text-2xl font-bold tracking-tight sm:text-3xl">Have an idea or just
                    want to say hello?</h2>
                <p class="mt-3 text-sm leading-6 text-gray-300">
                    Find me on one of the platforms below, or take a look at what I’ve been building.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                @foreach ($accounts ?? [] as $account)
                    <a href="{{ $account['url'] }}" target="_blank" rel="noopener noreferrer"
                        aria-label="Connect with me on {{ $account['name'] }}"
                        class="flex h-12 w-12 items-center justify-center rounded-full border border-white/15 bg-white/10 transition hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white">
                        <img src="{{ Storage::url($account['icon']) }}" alt="" class="h-5 w-5 object-contain">
                    </a>
                @endforeach

                <a href="{{ route('projects.index') }}" wire:navigate
                    class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-gray-950 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-950">
                    View projects
                    <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
</article>
