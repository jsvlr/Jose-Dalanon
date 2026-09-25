@props(['blogs', 'categories'])


<div {{ $attributes }}>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="inline text-2xl font-bold">01</h1>
            <small class="opacity-50">Blog</small>
        </div>
        <a class="text-sm opacity-50" href="{{ route('blogs') }}">
            View all posts <i class="fa-solid fa-arrow-right-long"></i>
        </a>
    </div>

    <div class="my-4 flex items-center justify-center gap-2">
        @foreach ($categories as $category)
            <div class="flex items-center justify-center gap-3">
                <div class="p-2" style="background-color: {{ $category->color }}"></div>
                <small>{{ $category->name }}</small>
            </div>
        @endforeach
    </div>

    <div class="flex flex-col gap-3">
        @foreach ($blogs as $blog)
            <a class="mb-5 px-2 py-3 hover:bg-gray-50 dark:hover:bg-gray-800" href="{{ route('blogs', $blog->slug) }}">
                <div class="flex flex-col items-center gap-3 sm:flex-row sm:items-start lg:flex-row lg:items-start">
                    <div>
                        <img class="h-28 lg:w-52 sm:w-full rounded-sm object-cover"
                            src="{{ Storage::url($blog->thumbnail) }}" alt="{{ $blog->thumbnail }}-thumbnail.png">
                        <div class="float-start mt-2 rounded-sm p-2"
                            style="background-color: {{ $blog->postCategory->color }}"></div>
                    </div>
                    <div class="flex-1">
                        <div class="float-end">
                            <small class="opacity-50">
                                {{ $blog->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <div class="flex flex-col items-start justify-start">
                            <div class="flex items-center justify-between">
                                <h1 class="text-2xl font-bold">
                                    {{ $blog->title }}
                                </h1>
                            </div>
                            <p class="opacity-50">{{ $blog->excerpt }}</p>
                        </div>
                        <div class="mt-2 flex gap-x-3">
                            @foreach (explode(',', $blog->tags) as $tag)
                                <small class="rounded-sm bg-gray-100 px-2 py-2 text-blue-600 dark:bg-gray-900">
                                    <i class="fa-solid fa-hashtag"></i> {{ $tag }}
                                </small>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
