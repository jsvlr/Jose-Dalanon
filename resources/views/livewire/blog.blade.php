<div>
    @foreach ($this->posts as $post)
        <div>
            {{ $post->title }}
        </div>
    @endforeach
</div>
