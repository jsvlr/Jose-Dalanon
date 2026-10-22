<div class="mx-auto max-w-6xl px-4 pb-10 sm:px-6 sm:pb-16 lg:px-8">
    <section id="introduction"
        class="relative isolate overflow-hidden rounded-3xl border border-gray-200 bg-gradient-to-br from-white via-gray-50 to-gray-100 px-6 py-10 dark:border-gray-800 dark:from-gray-950 dark:via-gray-950 dark:to-gray-900 sm:px-10 sm:py-14 lg:px-14 lg:py-16">
        <div class="pointer-events-none absolute -right-24 -top-32 -z-10 h-80 w-80 rounded-full border border-gray-200 dark:border-gray-800 sm:-right-16 sm:-top-40 sm:h-[30rem] sm:w-[30rem]"
            aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-10 -top-16 -z-10 h-56 w-56 rounded-full border border-gray-200 dark:border-gray-800 sm:right-12 sm:-top-20 sm:h-80 sm:w-80"
            aria-hidden="true"></div>

        <div class="relative grid items-center gap-10 lg:grid-cols-[minmax(0,1fr)_260px] lg:gap-16">
            <div class="order-2 text-center lg:order-1 lg:text-left">
                <p data-animate="badge"
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-xs font-semibold uppercase tracking-wider text-emerald-800 dark:border-emerald-900 dark:bg-emerald-950/60 dark:text-emerald-300">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-60"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    </span>
                    Available for work
                </p>

                <p class="mt-7 text-sm font-medium tracking-wide text-gray-500 dark:text-gray-400">Hi, I’m</p>
                <h1 data-animate="name"
                    class="mt-2 text-4xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-5xl lg:text-6xl">
                    {{ $brandName ?? config('app.name') }}
                </h1>

                <div data-animate="role" class="mt-5 flex items-center justify-center gap-3 lg:justify-start">
                    <span class="h-0.5 w-8 rounded-full bg-gray-900 dark:bg-white" aria-hidden="true"></span>
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-gray-700 dark:text-gray-300">
                        Backend Developer
                    </p>
                </div>

                @if (!empty($tagline))
                    <p data-animate="description"
                        class="mx-auto mt-5 max-w-xl text-base leading-7 text-gray-600 dark:text-gray-400 lg:mx-0 sm:text-lg">
                        {{ $tagline }}
                    </p>
                @else
                    <p data-animate="description"
                        class="mx-auto mt-5 max-w-xl text-base leading-7 text-gray-600 dark:text-gray-400 lg:mx-0 sm:text-lg">
                        I build thoughtful, dependable web applications with Laravel, Livewire, and Filament.
                    </p>
                @endif

                <div class="mt-8 flex flex-wrap justify-center gap-3 lg:justify-start">
                    <a href="{{ route('projects.index') }}" wire:navigate
                        class="inline-flex items-center gap-2 rounded-full bg-gray-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200 dark:focus:ring-offset-gray-950">
                        Explore my work
                        <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('about') }}" wire:navigate
                        class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white/70 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:text-gray-950 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:border-gray-700 dark:bg-gray-900/70 dark:text-gray-200 dark:hover:border-gray-500 dark:hover:text-white">
                        More about me
                    </a>
                </div>

                @if (!empty($accounts))
                    <nav aria-label="Social profiles" class="mt-8 flex flex-wrap justify-center gap-2 lg:justify-start">
                        @foreach ($accounts as $account)
                            <a data-animate="social" href="{{ $account['url'] }}" target="_blank"
                                rel="noopener noreferrer" aria-label="{{ $account['name'] }} (opens in a new tab)"
                                class="inline-flex items-center gap-2 rounded-full border border-gray-200 bg-white/70 px-3 py-2 text-sm font-medium text-gray-700 transition hover:border-gray-400 hover:bg-white dark:border-gray-800 dark:bg-gray-900/70 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:bg-gray-900">
                                @if (!empty($account['icon']))
                                    <img src="{{ Storage::url($account['icon']) }}" alt=""
                                        class="h-4 w-4 shrink-0 rounded-full object-contain">
                                @else
                                    <i class="fa-solid fa-arrow-up-right-from-square text-xs text-gray-400"
                                        aria-hidden="true"></i>
                                @endif
                                {{ $account['name'] }}
                            </a>
                        @endforeach
                    </nav>
                @endif
            </div>

            <div data-animate="portrait" class="order-1 mx-auto lg:order-2">
                <div class="relative">
                    <div class="absolute -inset-3 rotate-6 rounded-[2rem] border border-gray-300 dark:border-gray-700"
                        aria-hidden="true"></div>
                    <div
                        class="relative flex h-48 w-48 items-center justify-center overflow-hidden rounded-[1.75rem] bg-gray-200 shadow-xl shadow-gray-950/10 dark:bg-gray-800 sm:h-56 sm:w-56 lg:h-64 lg:w-64">
                        @if (!empty($brandLogo))
                            <img src="{{ Storage::url($brandLogo) }}" alt="{{ $brandName ?? config('app.name') }} logo"
                                class="h-full w-full object-cover">
                        @else
                            <span class="text-6xl font-bold text-gray-500 dark:text-gray-300">
                                {{ \Illuminate\Support\Str::of($brandName ?? config('app.name'))->substr(0, 1)->upper() }}
                            </span>
                        @endif
                    </div>
                    <div
                        class="absolute -bottom-4 -left-5 flex items-center gap-2 rounded-2xl border border-gray-200 bg-white px-4 py-3 shadow-lg dark:border-gray-700 dark:bg-gray-900 sm:-left-8">
                        <i class="fa-solid fa-code text-gray-700 dark:text-gray-200" aria-hidden="true"></i>
                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-200">Laravel · Livewire</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if ($this->quickStats->isNotEmpty())
        <section aria-label="At a glance" class="mt-6 grid grid-cols-2 gap-3 sm:grid-cols-4">
            @foreach ($this->quickStats as $quickStat)
                <div wire:key="quick-stat-{{ $loop->index }}"
                    class="rounded-2xl border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-950 sm:p-5">
                    <p class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">
                        {{ $quickStat->subtitle }}
                    </p>
                    <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400 sm:text-sm">
                        {{ $quickStat->title }}
                    </p>
                </div>
            @endforeach
        </section>
    @endif

    <x-sections.github-stats :stats="$this->githubStats" class="mt-14 sm:mt-20" />
    <x-sections.featured-projects :projects="$this->featuredProjects" class="mt-14 sm:mt-20" />
    <x-sections.featured-blogs :blogs="$this->featuredBlogs" :categories="$this->featuredBlogCategories" class="mt-14 sm:mt-20" />
    <x-sections.featured-certificates :certificates="$this->featuredCertificates" class="mt-14 sm:mt-20" />

    <section aria-labelledby="contact-title"
        class="relative mt-14 overflow-hidden rounded-3xl bg-gray-950 px-6 py-10 text-white dark:bg-gray-900 sm:mt-20 sm:px-10 sm:py-12">
        <div class="pointer-events-none absolute -right-12 -top-20 h-64 w-64 rounded-full border border-white/10 sm:-right-4 sm:-top-28 sm:h-80 sm:w-80"
            aria-hidden="true"></div>
        <div class="relative flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-2xl">
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-400">Get in touch</p>
                <h2 id="contact-title" class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">
                    Have a project in mind?
                </h2>
                <p class="mt-3 max-w-xl text-sm leading-6 text-gray-300 sm:text-base">
                    I’m always happy to hear about interesting ideas, collaborations, and opportunities. Reach out and
                    let’s start a conversation.
                </p>
            </div>

            <div class="flex flex-wrap gap-3">
                @if (!empty($email))
                    <a href="mailto:{{ $email }}"
                        class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-gray-950 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-950">
                        <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                        Email me
                    </a>
                @endif

                @if (!empty($phone))
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                        class="inline-flex items-center gap-2 rounded-full border border-white/20 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        Call me
                    </a>
                @endif

                @if (empty($email) && empty($phone))
                    <a href="{{ route('about') }}" wire:navigate
                        class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-semibold text-gray-950 transition hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-950">
                        <i class="fa-regular fa-user" aria-hidden="true"></i>
                        Connect with me
                    </a>
                @endif
            </div>
        </div>

        @if (!empty($email) || !empty($phone))
            <div
                class="relative mt-8 flex flex-wrap gap-x-6 gap-y-3 border-t border-white/10 pt-6 text-sm text-gray-300">
                @if (!empty($email))
                    <a href="mailto:{{ $email }}"
                        class="inline-flex items-center gap-2 transition hover:text-white">
                        <i class="fa-regular fa-envelope text-gray-400" aria-hidden="true"></i>
                        {{ $email }}
                    </a>
                @endif
                @if (!empty($phone))
                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
                        class="inline-flex items-center gap-2 transition hover:text-white">
                        <i class="fa-solid fa-phone text-gray-400" aria-hidden="true"></i>
                        {{ $phone }}
                    </a>
                @endif
            </div>
        @endif
    </section>
</div>
