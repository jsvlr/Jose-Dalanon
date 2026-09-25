{{-- resources/views/livewire/homepage.blade.php --}}
<section id="homepage" class="px-4 sm:px-6 lg:px-8 ">
    <div id="introduction"
        class="mx-auto flex max-w-6xl flex-col-reverse items-center gap-10 lg:flex-row lg:justify-between">
        {{-- Left: Text content --}}
        <div class="w-full text-center lg:w-auto lg:text-left">
            <div class="mb-4 flex justify-center lg:justify-start">
                <p data-animate="badge"
                    class="inline-block rounded-full bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow ring-1 ring-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:ring-gray-700">
                    🟢 Available for work
                </p>
            </div>

            <p class="text-gray-500 dark:text-gray-400">
                Hi, I'm
            </p>

            <h1 data-animate="name"
                class="text-5xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-6xl lg:text-7xl">
                {{ $name ?? '' }}
            </h1>

            <div data-animate="role" class="mt-3 flex items-center justify-center gap-3 lg:justify-start">
                <span class="h-2 w-8 rounded-full bg-black dark:bg-white"></span>
                <p class="font-semibold text-gray-800 dark:text-gray-200">
                    Backend Developer
                </p>
            </div>

            <p data-animate="description" class="mx-auto mt-4 max-w-md text-gray-600 dark:text-gray-400 lg:mx-0">
                {{ $tagline }}
            </p>

            <div class="mt-2 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
                @foreach ($accounts as $account)
                    <a data-animate="social" href="{{ $account['url'] }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-2 rounded-lg px-3 py-2.5 transition-colors hover:bg-gray-100 dark:hover:bg-gray-800">
                        <img src="{{ Storage::url($account['icon']) }}" alt="{{ $account['name'] }}"
                            class="h-6 w-6 shrink-0 rounded-full object-cover">
                        <span class="font-semibold text-gray-800 dark:text-gray-200">
                            {{ $account['name'] }}
                        </span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs text-gray-400"></i>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Right: Brand image --}}
        <div data-animate="portrait" class="shrink-0">
            <div class="overflow-hidden rounded-2xl border-0 ">
                <img src="{{ Storage::url($brandLogo) }}" alt="{{ $name ?? 'Brand' }} logo"
                    class="h-40 w-40 object-cover sm:h-48 sm:w-48 lg:h-52 lg:w-52">
            </div>
        </div>
    </div>

    <div id="quick-stats" class="rounded-2xl w-auto mt-5">
        <div class="flex justify-around items-center gap-4">
            @foreach ($this->quickStats() as $quickStat)
                <div class="text-center p-3">
                    <h1 class=" font-bold text-2xl">{{ $quickStat->subtitle }}</h1>
                    <p class="text-gray-300">{{ $quickStat->title }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <x-sections.github-stats :stats="$this->githubStats()" />
    <x-sections.featured-blogs :blogs="$this->featuredBlogs()" :categories="$this->usedBlogCategory()" class="mt-10" />
    <x-sections.featured-projects :projects="$this->featuredProjects()" class="mt-10" />
    <x-sections.featured-certificates :certificates="$this->featuredCertificates()" class="mt-10" />

</section>
