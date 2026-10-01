@props(['projects'])

<div {{ $attributes }}>
    <div class="flex items-center justify-between">
        <div>
            <h1 class="inline text-2xl font-bold">02</h1>
            <small class="opacity-50">Projects</small>
        </div>
        <a class="text-sm opacity-50" href="{{ route('projects.index') }}">
            View all projects <i class="fa-solid fa-arrow-right-long"></i>
        </a>
    </div>
    <br>
    <div class="flex justify-between items-center gap-2">
        @foreach ($projects as $project)
            <a class="flex flex-col" href="{{ route('projects.show', $project->slug) }}">
                <div class="">
                    <img class="object-cover h-80 w-auto" src="{{ Storage::url($project->featured_image) }}"
                        alt="{{ $project->slug }}-featured-image.jpeg">
                </div>
                <div class="flex mt-2">
                    <div class="rounded-sm ">
                        <img class="object-contain w-24" src="{{ Storage::url($project->project_logo) }}"
                            alt="{{ $project->slug }}-logo.jpeg">
                    </div>
                    <div class="flex flex-1 flex-col ">
                        <p class="font-bold text-2xl m-0 p-0">
                            {{ $project->title }}
                        </p>
                        <div class="float-end opacity-50">
                            <small>
                                {{ $project->start_date->format('M - Y') }}
                            </small>
                            <i class="fa-solid fa-arrow-right-long"></i>
                            <small>
                                {{ $project->end_date->format('M - Y') }}
                            </small>
                        </div>
                    </div>

                </div>
            </a>
        @endforeach
    </div>
</div>
