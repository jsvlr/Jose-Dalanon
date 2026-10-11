<div class="mx-auto max-w-3xl px-4 pb-16 sm:px-0">
    {{-- Back link --}}
    <a href="{{ route('blogs.index') }}" wire:navigate
        class="mb-4 inline-flex items-center gap-2 text-sm text-gray-500 transition hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
        <i class="fa-solid fa-arrow-left text-xs"></i> Back to articles
    </a>

    <article class="flex flex-col gap-6">
        {{-- Header image --}}
        @if ($post->thumbnail)
            <div class="overflow-hidden rounded-2xl">
                <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }} thumbnail"
                    class="h-64 w-full object-cover sm:h-96">
            </div>
        @endif

        {{-- Title block --}}
        <header class="flex flex-col items-center gap-3 text-center">

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white sm:text-4xl">
                {{ $post->title }}
            </h1>

            @if ($post->postCategory)
                <span class="rounded-full px-3 py-1 text-xs font-semibold text-white shadow"
                    style="background-color: {{ $post->postCategory->color }}">
                    {{ $post->postCategory->name }}
                </span>
            @endif

            @if ($post->excerpt)
                <p class="max-w-2xl text-base text-gray-500 dark:text-gray-400">
                    {{ $post->excerpt }}
                </p>
            @endif

            <div class="flex flex-wrap items-center justify-center gap-4 text-xs text-gray-400 dark:text-gray-500">
                <span>
                    <i class="fa-regular fa-calendar"></i>
                    <time datetime="{{ $post->created_at->toIso8601String() }}">
                        {{ $post->created_at->format('F j, Y') }}
                    </time>
                </span>
                <span>
                    <i class="fa-regular fa-eye"></i>
                    {{ number_format($post->views) }} {{ Str::plural('view', $post->views) }}
                </span>
            </div>
        </header>

        <hr class="border-gray-200 dark:border-gray-800">

        {{-- Body --}}
        <div
            class="prose max-w-none dark:prose-invert
            prose-pre:rounded-xl prose-pre:border prose-pre:border-gray-800 prose-pre:bg-gray-900 prose-pre:p-4
            prose-code:before:content-none prose-code:after:content-none
            prose-th:border prose-th:border-gray-700 prose-th:px-3 prose-th:py-2
            prose-td:border prose-td:border-gray-800 prose-td:px-3 prose-td:py-2">
            {!! $this->content !!}
        </div>

        {{-- Tags (JSON array) --}}
        @if (!empty($post->tags))
            <footer class="flex flex-wrap items-center gap-2 border-t border-gray-200 pt-6 dark:border-gray-800">
                <span class="text-sm text-gray-500 dark:text-gray-400">
                    <i class="fa-solid fa-tags"></i> Tags:
                </span>
                @foreach (explode(',', $post->tags) as $tag)
                    <span wire:key="tag-{{ $loop->index }}-{{ $tag }}"
                        class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700 dark:bg-gray-900 dark:text-gray-300">
                        #{{ $tag }}
                    </span>
                @endforeach
            </footer>
        @endif
    </article>

    {{-- Comments here... --}}
</div>
