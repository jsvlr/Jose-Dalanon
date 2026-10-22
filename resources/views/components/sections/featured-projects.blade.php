@props(['projects'])

<section {{ $attributes }}>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Selected work</p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">Featured projects</h2>
        </div>
        <a class="group inline-flex items-center gap-2 text-sm font-semibold text-gray-600 transition hover:text-gray-950 dark:text-gray-300 dark:hover:text-white"
            href="{{ route('projects.index') }}" wire:navigate>
            View all projects
            <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-1" aria-hidden="true"></i>
        </a>
    </div>

    @if ($projects->isEmpty())
        <div class="mt-6 rounded-2xl border border-dashed border-gray-300 px-6 py-10 text-center dark:border-gray-800">
            <p class="font-medium text-gray-700 dark:text-gray-300">Featured projects are on the way.</p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Check back soon to see what I’ve been building.</p>
        </div>
    @else
        <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($projects as $project)
                <article wire:key="featured-project-{{ $project->slug }}"
                    class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-950/5 dark:border-gray-800 dark:bg-gray-950 dark:hover:shadow-black/20">
                    <a href="{{ route('projects.show', $project->slug) }}" wire:navigate
                        aria-label="View {{ $project->title }} project">
                        <div class="relative aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                            @if ($project->featured_image)
                                <img src="{{ Storage::url($project->featured_image) }}"
                                    alt="{{ $project->title }} preview"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div class="flex h-full items-center justify-center bg-gradient-to-br from-gray-200 via-gray-100 to-white dark:from-gray-800 dark:via-gray-900 dark:to-black">
                                    <i class="fa-solid fa-layer-group text-4xl text-gray-400 dark:text-gray-600" aria-hidden="true"></i>
                                </div>
                            @endif

                            @if ($project->project_logo)
                                <span class="absolute bottom-3 left-3 flex h-11 w-11 items-center justify-center overflow-hidden rounded-xl border border-gray-200 bg-white p-1.5 shadow-md dark:border-gray-700 dark:bg-gray-950">
                                    <img src="{{ Storage::url($project->project_logo) }}" alt=""
                                        class="max-h-full max-w-full object-contain">
                                </span>
                            @endif
                        </div>

                        <div class="p-5">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-lg font-semibold text-gray-950 dark:text-white">{{ $project->title }}</h3>
                                <i class="fa-solid fa-arrow-up-right-from-square mt-1 text-xs text-gray-400 transition group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true"></i>
                            </div>
                            @if ($project->start_date || $project->end_date)
                                <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                                    {{ $project->start_date?->format('M Y') ?? 'Project' }}
                                    @if ($project->end_date)
                                        <span aria-hidden="true">—</span> {{ $project->end_date->format('M Y') }}
                                    @endif
                                </p>
                            @endif
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    @endif
</section>
