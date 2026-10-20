<div>
    <div class="mt-10">
        <p class="font-semibold opacity-50 uppercase">
            Selected Work
        </p>
        <h1 class="text-5xl font-bold">
            Projects I've built and shipped
        </h1>
        <p class="opacity-50 mt-4">
            Web apps, admin panels and tools built with Laravel, Livewire and Filament. Open any project for the full
            write-up.
        </p>
    </div>

    {{-- Filter Section by Role --}}
    <div class="my-10 mx-5 filters flex items-stretch justify-end gap-3 ">
        <div class="relative w-full sm:w-64">
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-400"></i>
            <input
                class="w-full rounded-lg border border-gray-200 bg-white py-2 pl-9 pr-3 text-sm text-gray-900 placeholder-gray-400 focus:border-gray-400 focus:outline-none dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:placeholder-gray-500"
                type="text" wire:model.live.debounce.300ms="search" placeholder="Search projects...">
        </div>
        <div class="relative">
            <label for="filter-by-category" class="sr-only">Filter projects by role</label>
            <select name="roleId" id="filter-by-role" wire:model.live="roleId"
                class="w-full appearance-none rounded-lg border border-gray-200 bg-white py-2 pl-3 pr-9 text-sm text-gray-900 transition focus:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:focus:border-gray-600 dark:focus:ring-gray-700 sm:w-48">
                <option value="">All roles</option>
                @foreach ($this->roles as $role)
                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                @endforeach
            </select>
            <i aria-hidden="true"
                class="fa-solid fa-chevron-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
        </div>

        {{-- Filter Section by Status --}}
        <div class="relative">
            <label for="filter-by-category" class="sr-only">Filter projects by status</label>
            <select name="status" id="filter-by-status" wire:model.live="status"
                class="w-full appearance-none rounded-lg border border-gray-200 bg-white py-2 pl-3 pr-9 text-sm text-gray-900 transition focus:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:focus:border-gray-600 dark:focus:ring-gray-700 sm:w-48">
                <option value="">All status</option>
                @foreach ($this->projectStatusCases as $case)
                    <option value="{{ $case->value }}">{{ $case->getLabel() }}</option>
                @endforeach
            </select>
            <i aria-hidden="true"
                class="fa-solid fa-chevron-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
        </div>
    </div>

    {{-- Skeleton grid: shown only while a request is in flight --}}
    <div wire:loading.grid wire:target="search, roleId, status, gotoPage, previousPage, nextPage"
        class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
        @for ($i = 0; $i < $this->perPage; $i++)
            <div class="animate-pulse overflow-hidden rounded-2xl bg-gray-50 dark:bg-gray-950">
                <div class="h-44 w-full bg-gray-200 dark:bg-gray-800"></div>
                <div class="space-y-3 p-4">
                    <div class="h-5 w-3/4 rounded bg-gray-200 dark:bg-gray-800"></div>
                    <div class="h-4 w-full rounded bg-gray-200 dark:bg-gray-800"></div>
                    <div class="h-4 w-2/3 rounded bg-gray-200 dark:bg-gray-800"></div>
                </div>
            </div>
        @endfor
    </div>

    <div wire:loading.remove wire:target="search, roleId, status, gotoPage, previousPage, nextPage">
        @if ($this->projects->isEmpty())
            <div
                class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-gray-200 py-16 text-center dark:border-gray-800">
                <i class="fa-regular fa-file-lines mb-3 text-3xl text-gray-300 dark:text-gray-700"></i>
                <p class="text-gray-500 dark:text-gray-400">No projects created yet — check back soon.</p>
                @if ($search)
                    No projects match "{{ $search }}"
                @else
                    No projects existed yet. Check back soon.
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->projects as $project)
                    <div wire:key="project-{{ $project->slug }}"
                        class="relative group flex flex-col overflow-hidden rounded-lg bg-gray-50 transition-colors hover:bg-gray-100 dark:bg-gray-950 dark:hover:bg-gray-900">

                        <div class=" overflow-hidden">
                            <img class="h-56 w-full object-cover transition-transform duration-300 ease-out group-hover:scale-105"
                                src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->slug }} thumbnail">
                        </div>

                        <div class="flex flex-1 flex-col p-4">
                            @if ($project->role)
                                <small class="text-xs opacity-50 font-semibold py-2">
                                    {{ strtoupper($project->role->title) }}
                                </small>
                            @endif

                            <p class="line-clamp-2 text-lg font-bold text-gray-900 dark:text-white">
                                <a href="{{ route('projects.show', $project->slug) }}"
                                    class="after:absolute after:inset-0 after:content-['']">
                                    {{ $project->title }}
                                </a>
                            </p>

                            @if ($project->excerpt)
                                <p class="mt-2 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $project->excerpt }}
                                </p>
                            @endif

                            <div class="">
                                @if ($project->skills->isNotEmpty())
                                    <ul class="mt-3 flex flex-wrap gap-2">
                                        @foreach ($project->skills as $skill)
                                            <li wire:key="project-{{ $project->id }}-skill-{{ $skill->id }}"
                                                class="rounded-sm bg-gray-20 p-2 text-xs dark:bg-gray-800">
                                                <i class="fa-solid fa-tag"></i> {{ $skill->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            {{-- URL and Code Source --}}
                            <div class="absolute left-0 top-10">
                                <div class="flex flex-col gap-1">
                                    <a class="text-xs p-3 bg-gray-800 rounded-r-full" href="{{ $project->github_url }}"
                                        target="_blank">
                                        <i class="fa-solid fa-code"></i>
                                    </a>
                                    <a class="text-xs p-3 bg-gray-800 rounded-r-full" href="{{ $project->live_url }}"
                                        target="_blank">
                                        <i class="fa-regular fa-share-from-square"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
