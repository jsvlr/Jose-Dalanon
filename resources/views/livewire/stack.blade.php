<div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8">
    <header class="relative overflow-hidden rounded-3xl bg-gray-950 px-6 py-10 text-white dark:bg-gray-900 sm:px-10 sm:py-14">
        <div class="pointer-events-none absolute -right-16 -top-24 h-72 w-72 rounded-full border border-white/10 sm:-right-8 sm:-top-32 sm:h-96 sm:w-96" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-4 -top-12 h-52 w-52 rounded-full border border-white/10 sm:right-10 sm:-top-20 sm:h-72 sm:w-72" aria-hidden="true"></div>

        <div class="relative max-w-3xl">
            <p class="inline-flex items-center gap-2 rounded-full border border-white/15 bg-white/5 px-3 py-1.5 text-xs font-semibold uppercase tracking-[0.18em] text-gray-300">
                <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
                My toolkit
            </p>
            <h1 class="mt-5 text-4xl font-bold tracking-tight sm:text-5xl lg:text-6xl">The stack behind the work.</h1>
            <p class="mt-5 max-w-2xl text-base leading-7 text-gray-300 sm:text-lg">
                Tools and technologies I use to design, build, and ship dependable web applications.
            </p>

            <div class="mt-8 flex flex-wrap gap-3 text-sm">
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-gray-200">
                    <i class="fa-solid fa-cubes" aria-hidden="true"></i>
                    {{ $this->skillGroups->flatten()->count() }} skills
                </span>
                <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-gray-200">
                    <i class="fa-solid fa-folder-tree" aria-hidden="true"></i>
                    {{ $this->skillGroups->count() }} categories
                </span>
            </div>
        </div>
    </header>

    @if ($this->skillGroups->isEmpty())
        <section class="mt-10 rounded-3xl border border-dashed border-gray-300 px-6 py-16 text-center dark:border-gray-800">
            <span class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-xl text-gray-500 dark:bg-gray-900 dark:text-gray-400">
                <i class="fa-solid fa-layer-group" aria-hidden="true"></i>
            </span>
            <h2 class="mt-5 text-lg font-semibold text-gray-900 dark:text-white">My toolkit is taking shape</h2>
            <p class="mx-auto mt-2 max-w-md text-sm leading-6 text-gray-500 dark:text-gray-400">
                Skills and technologies will appear here as they are added.
            </p>
        </section>
    @else
        <div class="mt-10 space-y-12 sm:mt-14 sm:space-y-16">
            @foreach ($this->skillGroups as $category => $skills)
                <section aria-labelledby="skill-category-{{ \Illuminate\Support\Str::slug($category) }}">
                    <div class="mb-5 flex items-end justify-between gap-4">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">
                                Category {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </p>
                            <h2 id="skill-category-{{ \Illuminate\Support\Str::slug($category) }}"
                                class="mt-2 text-2xl font-bold tracking-tight text-gray-950 dark:text-white">
                                {{ $category }}
                            </h2>
                        </div>
                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                            {{ $skills->count() }} {{ \Illuminate\Support\Str::plural('skill', $skills->count()) }}
                        </span>
                    </div>

                    <ul class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ($skills as $skill)
                            @php
                                $proficiency = min(100, max(0, (float) $skill->level));
                            @endphp
                            <li wire:key="stack-skill-{{ $skill->id }}"
                                class="group rounded-2xl border border-gray-200 bg-white p-5 transition hover:-translate-y-0.5 hover:border-gray-300 hover:shadow-lg hover:shadow-gray-950/5 dark:border-gray-800 dark:bg-gray-950 dark:hover:border-gray-700 dark:hover:shadow-black/20 sm:p-6">
                                <div class="flex items-center gap-4">
                                    <span class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded-xl bg-gray-100 text-gray-600 dark:bg-gray-900 dark:text-gray-300">
                                        @if ($skill->icon)
                                            <img src="{{ Storage::url($skill->icon) }}" alt=""
                                                class="h-full w-full object-contain p-2">
                                        @else
                                            <i class="fa-solid fa-code text-lg" aria-hidden="true"></i>
                                        @endif
                                    </span>
                                    <div class="min-w-0">
                                        <h3 class="truncate font-semibold text-gray-900 dark:text-white">
                                            {{ $skill->name }}
                                        </h3>
                                        <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $category }}</p>
                                    </div>
                                </div>

                                <div class="mt-6">
                                    <div class="mb-2 flex items-center justify-between gap-3 text-xs">
                                        <span class="font-medium text-gray-500 dark:text-gray-400">Proficiency</span>
                                        <span class="font-semibold tabular-nums text-gray-700 dark:text-gray-300">{{ number_format($proficiency, 0) }}%</span>
                                    </div>
                                    <div class="h-1.5 overflow-hidden rounded-full bg-gray-100 dark:bg-gray-800"
                                        role="progressbar" aria-label="{{ $skill->name }} proficiency"
                                        aria-valuenow="{{ number_format($proficiency, 0) }}" aria-valuemin="0" aria-valuemax="100">
                                        <div class="h-full rounded-full bg-gray-900 transition-[width] duration-500 dark:bg-white"
                                            style="width: {{ $proficiency }}%"></div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </section>
            @endforeach
        </div>
    @endif

    <section class="mt-16 flex flex-col gap-5 rounded-3xl border border-gray-200 p-6 dark:border-gray-800 sm:mt-20 sm:flex-row sm:items-center sm:justify-between sm:p-8">
        <div>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">Want to see these tools in action?</p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Explore the projects I’ve built with this stack.</p>
        </div>
        <a href="{{ route('projects.index') }}" wire:navigate
            class="inline-flex shrink-0 items-center justify-center gap-2 rounded-full bg-gray-950 px-5 py-3 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200 dark:focus:ring-offset-black">
            Browse projects
            <i class="fa-solid fa-arrow-right text-xs" aria-hidden="true"></i>
        </a>
    </section>
</div>
