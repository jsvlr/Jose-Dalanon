<div>
    <div class="mt-10">
        <div class="">
            <p class="font-semibold opacity-50 uppercase">
                Latest Posts
            </p>
            <h1 class="text-5xl font-bold">
                Notes from what I'm building
            </h1>
            <p class="opacity-50 mt-4">
                Short write-ups on Laravel, Livewire and Filament, plus lessons learned along the way.
            </p>
        </div>

        {{-- Filter Section --}}
        <div class="my-10 mx-5 filters flex items-stretch justify-end gap-3 ">
            <div class="relative w-full sm:w-64">
                <i
                    class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-sm text-gray-400"></i>
                <input
                    class="w-full rounded-lg border border-gray-200 bg-white py-2 pl-9 pr-3 text-sm text-gray-900 placeholder-gray-400 focus:border-gray-400 focus:outline-none dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:placeholder-gray-500"
                    type="text" wire:model.live.debounce.300ms="search" placeholder="Search articles...">
            </div>
            <div class="relative">
                <label for="filter-by-category" class="sr-only">Filter articles by category</label>
                <select name="categoryId" id="filter-by-category" wire:model.live="categoryId"
                    class="w-full appearance-none rounded-lg border border-gray-200 bg-white py-2 pl-3 pr-9 text-sm text-gray-900 transition focus:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:border-gray-800 dark:bg-gray-950 dark:text-white dark:focus:border-gray-600 dark:focus:ring-gray-700 sm:w-48">
                    <option value="">All categories</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <i aria-hidden="true"
                    class="fa-solid fa-chevron-down pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 text-xs text-gray-400"></i>
            </div>
        </div>
    </div>

    {{-- Skeleton grid: shown only while a request is in flight --}}
    <div wire:loading.grid wire:target="search, categoryId, gotoPage, previousPage, nextPage,"
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

    <div wire:loading.remove wire:target="search, categoryId, gotoPage, previousPage, nextPage">
        @if ($this->posts->isEmpty())
            <div
                class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-gray-200 py-16 text-center dark:border-gray-800">
                <i class="fa-regular fa-file-lines mb-3 text-3xl text-gray-300 dark:text-gray-700"></i>
                <p class="text-gray-500 dark:text-gray-400">No articles published yet — check back soon.</p>
                @if ($search)
                    No articles match "{{ $search }}"
                @else
                    No articles published yet. Check back soon.
                @endif
            </div>
        @else
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->posts as $post)
                    <a href="{{ route('blogs.show', $post->slug) }}" wire:key="post-{{ $post->slug }}"
                        class="group flex flex-col overflow-hidden rounded-lg bg-gray-50 transition-colors hover:bg-gray-100 dark:bg-gray-950 dark:hover:bg-gray-900">

                        <div class="relative overflow-hidden">
                            <img class="h-56 w-full object-cover transition-transform duration-300 ease-out group-hover:scale-105"
                                src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }} thumbnail">

                            @if ($post->postCategory)
                                <span
                                    class="absolute left-3 top-3 rounded-lg px-3 py-1 text-xs font-semibold text-white shadow"
                                    style="background-color: {{ $post->postCategory->color }}">
                                    {{ $post->postCategory->name }}
                                </span>
                            @endif
                        </div>

                        <div class="flex flex-1 flex-col p-4 ">
                            <p class="line-clamp-2 text-lg font-bold text-gray-900 dark:text-white">
                                {{ $post->title }}
                            </p>

                            @if ($post->excerpt)
                                <p class="mt-2 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $post->excerpt }}
                                </p>
                            @endif

                            <div class="flex gap-2 items-center my-3">
                                @foreach (explode(',', $post->tags) as $tag)
                                    <small class="px-3 py-2 rounded-sm dark:bg-gray-800 bg-gray-300">
                                        <i class="fa-solid fa-hashtag"></i> {{ $tag }}
                                    </small>
                                @endforeach
                            </div>
                        </div>

                        <div
                            class="mt-4 flex items-center justify-between text-xs text-gray-400 dark:text-gray-500 p-4">
                            <span>
                                <i class="fa-solid fa-calendar-days"></i>
                                {{ $post->created_at->format('j M, Y') }}
                            </span>
                            <span
                                class="font-medium text-gray-700 opacity-0 transition-opacity group-hover:opacity-100 dark:text-gray-200">
                                Read more <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $this->posts->links() }}
            </div>
        @endif
    </div>

</div>
