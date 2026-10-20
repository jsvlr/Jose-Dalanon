<article class="mx-auto max-w-5xl py-8 sm:py-12">
    <a href="{{ route('projects.index') }}"
        class="group inline-flex items-center gap-2 rounded-full border border-gray-200 px-4 py-2 text-sm font-medium text-gray-600 transition hover:border-gray-400 hover:text-gray-950 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:border-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-white">
        <i class="fa-solid fa-arrow-left text-xs transition-transform group-hover:-translate-x-1" aria-hidden="true"></i>
        All projects
    </a>

    <header class="mt-8 sm:mt-12">
        <div class="flex flex-wrap items-center gap-2">
            @if ($project->role)
                <span
                    class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold uppercase tracking-wider text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                    {{ $project->role->title }}
                </span>
            @endif

            @if ($project->status)
                <span
                    class="rounded-full border border-gray-200 px-3 py-1 text-xs font-medium text-gray-500 dark:border-gray-800 dark:text-gray-400">
                    {{ $project->status->getLabel() }}
                </span>
            @endif
        </div>

        <h1
            class="mt-5 max-w-4xl text-4xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-5xl lg:text-6xl">
            {{ $project->title }}
        </h1>

        @if ($project->excerpt)
            <p class="mt-5 max-w-3xl text-lg leading-8 text-gray-600 dark:text-gray-400 sm:text-xl">
                {{ $project->excerpt }}
            </p>
        @endif

        <div class="mt-7 flex flex-wrap gap-3">
            @if ($project->live_url)
                <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 rounded-full bg-gray-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200 dark:focus:ring-offset-black">
                    View live project
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs" aria-hidden="true"></i>
                </a>
            @endif

            @if ($project->github_url)
                <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                    class="inline-flex items-center gap-2 rounded-full border border-gray-200 px-5 py-3 text-sm font-semibold text-gray-700 transition hover:border-gray-400 hover:text-gray-950 focus:outline-none focus:ring-2 focus:ring-gray-400 dark:border-gray-800 dark:text-gray-200 dark:hover:border-gray-600 dark:hover:text-white">
                    <i class="fa-brands fa-github text-base" aria-hidden="true"></i>
                    Source code
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs" aria-hidden="true"></i>
                </a>
            @endif
        </div>
    </header>

    <figure
        class="relative mt-10 aspect-[16/9] overflow-hidden rounded-2xl bg-gradient-to-br from-gray-800 via-gray-900 to-black sm:mt-14 sm:rounded-3xl">
        @if ($project->featured_image)
            <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }} project preview"
                class="absolute inset-0 h-full w-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-black/10" aria-hidden="true">
            </div>
        @else
            <div
                class="absolute inset-0 flex items-center justify-center bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-gray-700 via-gray-900 to-black">
                <i class="fa-solid fa-layer-group text-6xl text-white/20 sm:text-8xl" aria-hidden="true"></i>
            </div>
        @endif

        @if ($project->project_logo)
            <div
                class="absolute bottom-5 left-5 flex h-16 w-16 items-center justify-center overflow-hidden rounded-2xl bg-white p-2 shadow-xl sm:bottom-8 sm:left-8 sm:h-20 sm:w-20">
                <img src="{{ Storage::url($project->project_logo) }}" alt="{{ $project->title }} logo"
                    class="max-h-full max-w-full object-contain">
            </div>
        @endif
    </figure>

    <div class="mt-12 grid gap-10 lg:mt-16 lg:grid-cols-[minmax(0,1fr)_280px] lg:gap-14">
        <section aria-labelledby="project-overview-title" class="min-w-0">
            <h2 id="project-overview-title" class="text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
                Project overview
            </h2>

            <div
                class="prose prose-gray mt-6 max-w-none leading-7 dark:prose-invert prose-headings:font-semibold prose-a:font-medium prose-a:text-gray-900 prose-a:underline-offset-4 dark:prose-a:text-white">
                {!! $this->content !!}
            </div>
        </section>

        <aside class="h-fit space-y-6 lg:sticky lg:top-8">
            <section class="rounded-2xl border border-gray-200 p-5 dark:border-gray-800 sm:p-6">
                <h2 class="text-sm font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">
                    Project details
                </h2>

                <dl class="mt-5 space-y-5">
                    @if ($project->role)
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">My
                                role</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-800 dark:text-gray-200">
                                {{ $project->role->title }}</dd>
                        </div>
                    @endif

                    @if ($project->start_date || $project->end_date)
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">
                                Timeline</dt>
                            <dd class="mt-1 text-sm font-medium text-gray-800 dark:text-gray-200">
                                @if ($project->start_date)
                                    {{ $project->start_date->format('M Y') }}
                                @else
                                    In progress
                                @endif
                                <span class="px-1 text-gray-400">—</span>
                                {{ $project->end_date?->format('M Y') ?? 'Present' }}
                            </dd>
                        </div>
                    @endif

                    @if ($project->skills->isNotEmpty())
                        <div>
                            <dt class="text-xs font-medium uppercase tracking-wide text-gray-400 dark:text-gray-500">
                                Built with</dt>
                            <dd>
                                <ul class="mt-3 flex flex-wrap gap-2">
                                    @foreach ($project->skills as $skill)
                                        <li wire:key="project-{{ $project->id }}-skill-{{ $skill->id }}"
                                            class="rounded-full bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-700 dark:bg-gray-900 dark:text-gray-300">
                                            {{ $skill->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </dd>
                        </div>
                    @endif
                </dl>
            </section>

            <a href="{{ route('projects.index') }}"
                class="group flex items-center justify-between rounded-2xl border border-gray-200 p-5 text-sm font-medium text-gray-700 transition hover:border-gray-400 hover:text-gray-950 dark:border-gray-800 dark:text-gray-300 dark:hover:border-gray-600 dark:hover:text-white">
                <span>Explore more projects</span>
                <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-1"
                    aria-hidden="true"></i>
            </a>
        </aside>
    </div>
</article>
