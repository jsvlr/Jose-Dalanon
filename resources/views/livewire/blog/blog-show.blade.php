<div>
    <div class="flex flex-col justify-stretch gap-3">
        <div class="flex-1 py-40" id="header-thumbnail"
            style="
             background-image: url('{{ Storage::url($post->thumbnail) }}');
             background-repeat: no-repeat;
             background-position: center;
             background-cover: cover">
        </div>
        <div id="body-context">
            <div class="text-center">
                <h1 class="text-2xl font-semibold">
                    {{ $post->title }}
                </h1>
                <small class="py-2 px-3 rounded-md mt-4" style="background-color: {{ $post->postCategory->color }}">
                    {{ $post->postCategory->name }}
                </small>
                <br>
                <small>
                    {{ $post->created_at }}
                </small>
            </div>
        </div>
    </div>
</div>
