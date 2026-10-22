@props(['blogs', 'categories'])

<section {{ $attributes }}>
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Notes & ideas
            </p>
            <h2 class="mt-2 text-2xl font-bold tracking-tight text-gray-950 dark:text-white sm:text-3xl">From the blog
            </h2>
        </div>
        <a class="group inline-flex items-center gap-2 text-sm font-semibold text-gray-600 transition hover:text-gray-950 dark:text-gray-300 dark:hover:text-white"
            href="{{ route('blogs.index') }}" wire:navigate>
            Read all posts
            <i class="fa-solid fa-arrow-right text-xs transition-transform group-hover:translate-x-1"
                aria-hidden="true"></i>
        </a>
    </div>

    @if ($categories->isNotEmpty())
        <ul class="mt-4 flex flex-wrap gap-2" aria-label="Featured post categories">
            @foreach ($categories as $category)
                <li
                    class="inline-flex items-center gap-2 rounded-full border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-600 dark:border-gray-800 dark:text-gray-300">
                    <span class="h-2 w-2 rounded-full" style="background-color: {{ $category->color }}"
                        aria-hidden="true"></span>
                    {{ $category->name }}
                </li>
            @endforeach
        </ul>
    @endif

    @if ($blogs->isEmpty())
        <div class="mt-6 rounded-2xl border border-dashed border-gray-300 px-6 py-10 text-center dark:border-gray-800">
            <p class="font-medium text-gray-700 dark:text-gray-300">New writing is on the way.</p>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Articles and notes will show up here.</p>
        </div>
    @else
        <div class="mt-6 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($blogs as $blog)
                <article wire:key="featured-blog-{{ $blog->slug }}"
                    class="group overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:-translate-y-1 hover:shadow-xl hover:shadow-gray-950/5 dark:border-gray-800 dark:bg-gray-950 dark:hover:shadow-black/20">
                    <a href="{{ route('blogs.show', $blog->slug) }}" wire:navigate
                        aria-label="Read {{ $blog->title }}">
                        <div class="aspect-[16/10] overflow-hidden bg-gray-100 dark:bg-gray-900">
                            @if ($blog->thumbnail)
                                <img src="{{ Storage::url($blog->thumbnail) }}" alt="{{ $blog->title }} thumbnail"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-105">
                            @else
                                <div
                                    class="flex h-full items-center justify-center bg-gradient-to-br from-gray-200 via-gray-100 to-white dark:from-gray-800 dark:via-gray-900 dark:to-black">
                                    <i class="fa-regular fa-file-lines text-4xl text-gray-400 dark:text-gray-600"
                                        aria-hidden="true"></i>
                                </div>
                            @endif
                        </div>

                        <div class="p-5">
                            <div
                                class="flex flex-wrap items-center gap-x-3 gap-y-1 text-xs text-gray-500 dark:text-gray-400">
                                @if ($blog->postCategory)
                                    <span
                                        class="font-semibold text-gray-700 dark:text-gray-300">{{ $blog->postCategory->name }}</span>
                                @endif
                                @if ($blog->created_at)
                                    <time
                                        datetime="{{ $blog->created_at->toDateString() }}">{{ $blog->created_at->format('M j, Y') }}</time>
                                @endif
                            </div>

                            <h3 class="mt-3 text-lg font-semibold leading-snug text-gray-950 dark:text-white">
                                {{ $blog->title }}</h3>
                            @if ($blog->excerpt)
                                <p class="mt-2 line-clamp-3 text-sm leading-6 text-gray-600 dark:text-gray-400">
                                    {{ $blog->excerpt }}</p>
                            @endif

                            @if (!empty($blog->tags))
                                <ul class="mt-4 flex flex-wrap gap-2" aria-label="Post tags">
                                    @foreach (explode(',', $blog->tags) as $tag)
                                        <li
                                            class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-600 dark:bg-gray-900 dark:text-gray-400">
                                            #{{ $tag }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
    @endif
</section>
